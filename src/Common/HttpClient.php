<?php

namespace Ossycodes\Nigeriabulksms\Common;

use InvalidArgumentException;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Exceptions\HttpException;

/**
 * Class HttpClient
 */
class HttpClient
{
    public const REQUEST_POST = 'POST';

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var array
     */
    protected $userAgent = [];

    /**
     * @var int
     */
    private $timeout;

    /**
     * @var int
     */
    private $connectionTimeout;

    /**
     * @var array
     */
    private $httpOptions = [];

    public function __construct(string $endpoint, Configuration $config)
    {
        $this->endpoint = $endpoint;

        $this->config  = $config;

        $timeout = $this->config->getTimeout();

        if (!\is_int($timeout) || $timeout < 1) {
            throw new InvalidArgumentException(
                sprintf(
                    'Timeout must be an int > 0, got "%s".',
                    \is_object($timeout) ? \get_class($timeout) : \gettype($timeout) . ' ' . var_export($timeout, true)
                )
            );
        }

        $this->timeout = $timeout;

        $connectionTimeout = $this->config->getConnectionTimeout();

        if (!\is_int($connectionTimeout) || $connectionTimeout < 0) {
            throw new InvalidArgumentException(
                sprintf(
                    'Connection timeout must be an int >= 0, got "%s".',
                    \is_object($connectionTimeout) ? \get_class($connectionTimeout) : \gettype($connectionTimeout) . ' ' . var_export(
                        $connectionTimeout,
                        true
                    )
                )
            );
        }

        $this->connectionTimeout = $connectionTimeout;
    }

    public function addUserAgentString(string $userAgent): void
    {
        $this->userAgent[] = $userAgent;
    }

    /**
     * @param mixed $option
     * @param mixed $value
     */
    public function addHttpOption($option, $value): void
    {
        $this->httpOptions[$option] = $value;
    }

    /**
     * @param mixed $option
     * @return mixed|null
     */
    public function getHttpOption($option)
    {
        return $this->httpOptions[$option] ?? null;
    }

    /**
     * @param string $actionName
     * @param array $body
     *
     * @return array
     *
     * @throws AuthenticateException
     * @throws HttpException
     */
    public function performHttpRequest($actionName, $body = []): ?array
    {
        $curl = curl_init();

        $headers = [
            'User-agent: ' . implode(' ', $this->userAgent),
            'Accept: application/json',
            'Content-Type: application/json',
            'Accept-Charset: utf-8',
        ];

        curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, \CURLOPT_HEADER, true);
        curl_setopt($curl, \CURLOPT_POST, true);
        curl_setopt($curl, \CURLOPT_URL, $this->getRequestUrl($actionName, $body));
        curl_setopt($curl, \CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, \CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, \CURLOPT_CUSTOMREQUEST, self::REQUEST_POST);
        curl_setopt($curl, \CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, \CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

        foreach ($this->httpOptions as $option => $value) {
            curl_setopt($curl, $option, $value);
        }

        $caFile = dirname(__DIR__) . '/ca-bundle.crt';

        if (!file_exists($caFile)) {
            throw new HttpException(sprintf(
                'Unable to find CA-bundle file "%s".',
                __DIR__ . '/../ca-bundle.crt'
            ));
        }

        curl_setopt($curl, \CURLOPT_CAINFO, $caFile);

        $response = curl_exec($curl);

        if ($response === false) {
            throw new HttpException(curl_error($curl), curl_errno($curl));
        }

        $responseStatus = (int)curl_getinfo($curl, \CURLINFO_HTTP_CODE);

        // Split the header and body
        $parts = explode("\r\n\r\n", $response, 3);
        $isThreePartResponse = (strpos($parts[0], "\n") === false && strpos($parts[0], 'HTTP/1.') === 0);
        [$responseHeader, $responseBody] = $isThreePartResponse ? [$parts[1], $parts[2]] : [$parts[0], $parts[1]];

        curl_close($curl);

        return [$responseStatus, $responseHeader, $responseBody];
    }

    /**
     * @param string $actionName
     * @param array $body
     *
     * @return string
     */
    public function getRequestUrl($actionName, $body = []): string
    {
        $requestUrl = $this->endpoint;

        $query = ['action' => $actionName] + $body +  $this->config->getAuthenticationParameters();

        if($actionName == 'message') {
            unset($query['action']);
        }

        if ($query) {
            if (\is_array($query)) {
                $query = http_build_query($query);
            }
            $requestUrl .= '?' . $query;
        }

        return $requestUrl;
    }

    public function setTimeout(int $timeout): HttpClient
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function setConnectionTimeout(int $connectionTimeout): HttpClient
    {
        $this->connectionTimeout = $connectionTimeout;

        return $this;
    }
}
