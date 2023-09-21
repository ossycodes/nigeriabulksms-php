<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\BalanceResponse;

class BalanceViewTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->config = Configuration::getDefaultConfiguration()
            ->setUsername('test@gmail.com')
            ->setPassword('000000000')
            ->setTimeout(10)
            ->setConnectionTimeout(2);

        $this->mockClient = $this->getMockBuilder(HttpClient::class)->setConstructorArgs(["fake.nigeriabulksms.api", $this->config])->getMock();
        $this->client = new Client($this->config, $this->mockClient);
    }

    public function testBalanceView(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{"balance":100.00,"currency":"NGN","symbol":"\u20a6","country":"NG"}',
        ]);

        $balance = $this->client->balance->read();

        self::assertInstanceOf(BalanceResponse::class, $balance);
    }
}
