<?php

namespace Ossycodes\Nigeriabulksms;

/**
 * Class Configuration
 */
class Configuration
{
    private static $defaultConfiguration;

    /**
     * username for authentication
     *
     * @var string
     */
    protected $username = '';

    /**
     * password for authentication
     *
     * @var string
     */
    protected $password = '';

    /**
     * @var int
     */
    protected $timeout = 10;

    /**
     * @var int
     */
    protected $connectionTimeout = 10;

    /**
     * Gets the default configuration instance
     *
     * @return Configuration
     */
    public static function getDefaultConfiguration()
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }

        return self::$defaultConfiguration;
    }

    /**
     * Sets the username for authentication
     *
     * @param string
     *
     * @return $this
     */
    public function setUsername($username): Configuration
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Gets the username for authentication
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the password for authentication
     *
     * @param string
     *
     * @return $this
     */
    public function setPassword($password): Configuration
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the password for authentication
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function setTimeout(int $timeout): Configuration
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function setConnectionTimeout(int $connectionTimeout): Configuration
    {
        $this->connectionTimeout = $connectionTimeout;

        return $this;
    }

    /**
     * @return int
     */
    public function getConnectionTimeout(): int
    {
        return $this->connectionTimeout;
    }

    public function getAuthenticationParameters(): array
    {
        return [
            'username'  => $this->getUsername(),
            'password'  => $this->getPassword(),
        ];
    }
}
