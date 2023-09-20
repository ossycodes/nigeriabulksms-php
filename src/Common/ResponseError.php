<?php

namespace Ossycodes\Nigeriabulksms\Common;

use Ossycodes\Nigeriabulksms\Exceptions\BalanceException;
use Ossycodes\Nigeriabulksms\Exceptions\AuthenticateException;


/**
 * Class ResponseError
 */
class ResponseError
{
    public const EXCEPTION_MESSAGE = 'Got error response from the server, error description: %s error code: %s';

    public const INTERNAL_ERROR_MESSAGE = 'internal error';

    public const SUCCESS = 1;

    public const INSUFFICIENT_FUNDS = 150;

    public const LOGIN_FAILED = 110;

    public const LOGIN_STATUS_FAILED = 111;

    public const INTERNAL_ERROR = 191;

    public $errors = [];

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $code;

    /**
     * @param mixed $body
     *
     * @throws Exceptions\AuthenticateException
     * @throws Exceptions\BalanceException
     */
    public function __construct($body)
    {
        $this->description  = $body->error ?? self::INTERNAL_ERROR_MESSAGE;
        $this->code         = $body->errno ?? self::INTERNAL_ERROR;

        if($this->code === self::INSUFFICIENT_FUNDS) {
            throw new BalanceException($this->getExceptionMessage());
        }

        if(in_array($this->code, [self::LOGIN_FAILED, self::LOGIN_STATUS_FAILED])) {
            throw new AuthenticateException($this->getExceptionMessage());
        }
    }

    /**
     * Get the exception message for the provided error.
     *
     * @param mixed $error
     *
     * @return string
     */
    public function getExceptionMessage()
    {
        return sprintf(self::EXCEPTION_MESSAGE , $this->description, $this->code);
    }

    /**
     * Get the error description
     *
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->description;
    }

    /**
     * Get the error code
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->code;
    }

    /**
     * Get the error description and code
     *
     * @return string
     */
    public function getErrorDescriptionWithCode()
    {
        return sprintf("error description: %s error code: %s", $this->getErrorDescription(), $this->getErrorCode());
    }
}
