<?php

namespace Ossycodes\Nigeriabulksms;

use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Actions\Balance;
use Ossycodes\Nigeriabulksms\Actions\Payment;
use Ossycodes\Nigeriabulksms\Actions\Profile;
use Ossycodes\Nigeriabulksms\Common\HttpClient;

/**
 * Class Client
 */
class Client
{
    public const ENDPOINT = 'https://portal.nigeriabulksms.com/api/';

    public const CLIENT_VERSION = 1.0;

    /**
     * @var Configuration
     */
    public $config;

    /**
     * @var HttpClient
     */
    public $httpClient;

    /**
     * @var Balance
     */
    public $balance;

    /**
     * @var Payment
     */
    public $payments;

    /**
     * @var Profile
     */
    public $profile;

    public function __construct(Configuration $config, ?HttpClient $httpClient = null)
    {
        $this->config = $config;

        if ($this->config === null) {
            throw new AuthenticateException('Cannot perform API Request without username and password set as the default configuration');
        }

        if ($this->config->getUsername() === null) {
            throw new AuthenticateException('Cannot perform API Request without username set');
        }

        if ($this->config->getPassword() === null) {
            throw new AuthenticateException('Cannot perform API Request without password set');
        }

        $this->httpClient = new HttpClient(self::ENDPOINT, $this->config);

        $this->httpClient->addUserAgentString('Ossycodes/Nigeriabulksms/ApiClient/' . self::CLIENT_VERSION);
        $this->httpClient->addUserAgentString($this->getPhpVersion());

        $this->balance  = new Balance($this->httpClient);
        $this->payments = new Payment($this->httpClient);
        $this->profile  = new Profile($this->httpClient);

    }

    private function getPhpVersion(): string
    {
        if (!\defined('PHP_VERSION_ID')) {
            $version = array_map('intval', explode('.', \PHP_VERSION));
            \define('PHP_VERSION_ID', $version[0] * 10000 + $version[1] * 100 + $version[2]);
        }

        return 'PHP/' . \PHP_VERSION_ID;
    }
}
