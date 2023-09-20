<?php

namespace Ossycodes\Nigeriabulksms;

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
    public function setUsername($username)
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
    public function setPassword($password)
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
}
