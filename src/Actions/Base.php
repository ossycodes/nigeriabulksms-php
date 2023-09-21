<?php

namespace Ossycodes\Nigeriabulksms\Actions;

use Ossycodes\Nigeriabulksms\Objects\Balance;
use Ossycodes\Nigeriabulksms\Objects\History;
use Ossycodes\Nigeriabulksms\Objects\Numbers;
use Ossycodes\Nigeriabulksms\Objects\Profile;
use Ossycodes\Nigeriabulksms\Objects\Reports;
use Ossycodes\Nigeriabulksms\Objects\BaseList;
use Ossycodes\Nigeriabulksms\Objects\Contacts;
use Ossycodes\Nigeriabulksms\Objects\Payments;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Common\ResponseError;
use Ossycodes\Nigeriabulksms\Objects\BalanceResponse;
use Ossycodes\Nigeriabulksms\Objects\HistoryResponse;
use Ossycodes\Nigeriabulksms\Objects\ProfileResponse;
use Ossycodes\Nigeriabulksms\Objects\ReportsResponse;
use Ossycodes\Nigeriabulksms\Objects\ContactsResponse;
use Ossycodes\Nigeriabulksms\Objects\PaymentsResponse;
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
     * @var Balance|Contacts|History|Numbers|Payments|Profile|Reports
     */
    protected $object;

    /**
     * @var BalanceResponse|ContactsResponse|HistoryResponse|PaymentsResponse|ProfileResponse|ReportsResponse
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
     * @return Balance|Contacts|History|Numbers|Payments|Profile|Reports
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $object
     */
    public function setObject($object): void
    {
        $this->object = $object;
    }

    public function getResponseObject(): BalanceResponse
    {
        return $this->responseObject;
    }

    /**
     * @param mixed $responseObject
     */
    public function setResponseObject($responseObject): void
    {
        $this->responseObject = $responseObject;
    }

    /**
     * @return \Ossycodes\Nigeriabulksms\Objects\Balance|\Ossycodes\Nigeriabulksms\Objects\BalanceResponse|null
     *
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\BalanceException
     * @throws Exceptions\HttpException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     */
    public function read()
    {
        [,, $body] = $this->httpClient->performHttpRequest($this->actionName);

        return $this->processRequest($body);
    }

    /**
     * @param array|null $parameters
     * @return \Ossycodes\Nigeriabulksms\Objects\Payment|\Ossycodes\Nigeriabulksms\Objects\PaymentResponse|null
     *
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\BalanceException
     * @throws Exceptions\HttpException
     * @throws Exceptions\RequestException
     * @throws Exceptions\ServerException
     * @throws \JsonException
     */
    public function getList(?array $parameters = [])
    {
        [,, $body] = $this->httpClient->performHttpRequest($this->actionName);

        if (strpos($body, '"error"') !== false) {
            return $this->processRequest($body);
        }

        $body = json_decode($body, null, 512, \JSON_THROW_ON_ERROR);

        $baseList = new BaseList();

        $objectName = $this->object;

        $baseList->items = [];

        foreach ($body as $item) {

            if ($this->responseObject) {
                $responseObject = clone $this->responseObject;
                $baseList->items[] =  $responseObject->loadFromStdclass($item);
            } else {
                $object = new $objectName($this->httpClient);
                $message = $object->loadFromArray($item);
                $baseList->items[] = $message;
            }
        }

        return $baseList;
    }

    /**
     * @param string|null $body
     * @return \Ossycodes\Nigeriabulksms\Objects\Balance|\Ossycodes\Nigeriabulksms\Objects\BalanceResponse|null
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
            throw new RequestException($responseError->getExceptionMessage());
        }

        if ($this->responseObject) {
            return $this->responseObject->loadFromStdclass($body);
        }

        return $this->object->loadFromStdclass($body);
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
