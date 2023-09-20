<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Common\ResponseError;
use Ossycodes\Nigeriabulksms\Exceptions\ServerException;
use Ossycodes\Nigeriabulksms\Exceptions\RequestException;

/**
 * Class Base
 */
class Base
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string The action name as it is known at the server
     */
    protected $actionName;

    /**
     * @var Objects\Hlr|Objects\Message|Objects\Balance|Objects\Verify|Objects\Lookup|Objects\VoiceMessage|Objects\Conversation\Conversation
     */
    protected $object;

    /**
     * @var Objects\MessageResponse
     */
    protected $responseObject;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName): void
    {
        $this->actionName = $actionName;
    }

    /**
     * @return Objects\Balance|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @deprecated
     *
     * @param mixed $object
     */
    public function setObject($object): void
    {
        $this->object = $object;
    }

    // public function getResponseObject(): Objects\MessageResponse
    // {
    //     return $this->responseObject;
    // }

    /**
     * @param mixed $responseObject
     */
    public function setResponseObject($responseObject): void
    {
        $this->responseObject = $responseObject;
    }

    /**
     * @return Objects\Balance|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|null
     *
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\BalanceException
     * @throws Exceptions\HttpException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     */
    public function read()
    {
        [, , $body] = $this->httpClient->performHttpRequest(['action' => $this->actionName]);

        return $this->processRequest($body);
    }

    /**
     * @param string|null $body
     * @return Objects\Balance|Objects\Conversation\Conversation|Objects\Hlr|Objects\Lookup|Objects\Message|Objects\Verify|Objects\VoiceMessage|Objects\MessageResponse|null
     *
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\BalanceException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     */
    public function processRequest(?string $body)
    {
        if ($body === null) {
            throw new ServerException('Got an invalid JSON response from the server.');
        }

        try {
            $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new ServerException('Got an invalid JSON response from the server.');
        }

        if (!empty($body->error)) {
            $responseError = new ResponseError($body);
            throw new RequestException($responseError->getErrorDescriptionWithCode());
        }

        // if ($this->responseObject) {
        //     return $this->responseObject->loadFromStdclass($body);
        // }

        // if (is_array($body)) {
        //     $parsed = [];
        //     foreach ($body as $b) {
        //         $parsed[] = $this->object->loadFromStdclass($b);
        //     }
        //     return $parsed;
        // }

        // return $this->object->loadFromStdclass($body);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
