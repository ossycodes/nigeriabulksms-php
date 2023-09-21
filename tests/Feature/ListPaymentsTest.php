<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\PaymentsResponse;

class ListPaymentsTest extends \PHPUnit\Framework\TestCase
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

    public function testListPayments(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '[{"amount":"200.00","reference":null,"date":"2020-08-15 11:01:35"}]',
        ]);

        $payments = $this->client->payments->getList();

        foreach ($payments->items as $payments) {
            self::assertInstanceOf(PaymentsResponse::class, $payments);
        }
    }
}
