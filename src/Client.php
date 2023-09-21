<?php

namespace Ossycodes\Nigeriabulksms;

use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Actions\Audios;
use Ossycodes\Nigeriabulksms\Actions\Groups;
use Ossycodes\Nigeriabulksms\Actions\Balance;
use Ossycodes\Nigeriabulksms\Actions\Message;
use Ossycodes\Nigeriabulksms\Actions\History;
use Ossycodes\Nigeriabulksms\Actions\Numbers;
use Ossycodes\Nigeriabulksms\Actions\Profile;
use Ossycodes\Nigeriabulksms\Actions\Reports;
use Ossycodes\Nigeriabulksms\Actions\Contacts;
use Ossycodes\Nigeriabulksms\Actions\Payments;
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
     * @var Payments
     */
    public $payments;

    /**
     * @var Profile
     */
    public $profile;

    /**
     * @var Contacts
     */
    public $contacts;

    /**
     * @var History
     */
    public $history;

    /**
     * @var Numbers
     */
    public $numbers;

    /**
     * @var Reports
     */
    public $reports;

    /**
     * @var Audios
     */
    public $audios;

    /**
     * @var Groups
     */
    public $groups;

    /**
     * @var Message
     */
    public $message;

    public function __construct(Configuration $config, ?HttpClient $httpClient = null)
    {
        $this->config = $config;

        if (empty($this->config->getUsername()) || empty($this->config->getPassword())) {
            throw new AuthenticateException('Cannot perform API Requests without username and password set');
        }

        if ($httpClient === null) {
            $this->httpClient = new HttpClient(self::ENDPOINT, $this->config);
        } else {
            $this->httpClient = $httpClient;
        }

        $this->httpClient->addUserAgentString('Ossycodes/Nigeriabulksms/ApiClient/' . self::CLIENT_VERSION);
        $this->httpClient->addUserAgentString($this->getPhpVersion());

        $this->message  = new Message($this->httpClient);
        $this->balance  = new Balance($this->httpClient);
        $this->payments = new Payments($this->httpClient);
        $this->profile  = new Profile($this->httpClient);
        $this->contacts = new Contacts($this->httpClient);
        $this->history  = new History($this->httpClient);
        $this->numbers  = new Numbers($this->httpClient);
        $this->reports  = new Reports($this->httpClient);
        $this->audios   = new Audios($this->httpClient);
        $this->groups   = new Groups($this->httpClient);
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
