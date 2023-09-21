<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\ReportsResponse;

class ListReportsTest extends \PHPUnit\Framework\TestCase
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

    public function testListReports(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '[
                {"service":"text","reference":"ce14f9917e16cd28d0ae741754302175","status":"DELIVERED","sender":"test","mobile":2348025092679,"message":"another test","data":null,"price":"3.0000","units":1,"length":"12c\/1p","send_date":"2023-09-21 15:22:07","date":"2023-09-21 15:22:07"},
                {"service":"text","reference":"f95789e519b6656920028d77d59b0a08","status":"DELIVERED","sender":"OsaigbovoE","mobile":2349023802591,"message":"body of text message goes in here","data":null,"price":"3.0000","units":1,"length":"33c\/1p","send_date":"2023-09-21 15:02:52","date":"2023-09-21 15:02:52"}
            ]',
        ]);

        $reports = $this->client->reports->getList();

        foreach ($reports->items as $reports) {
            self::assertInstanceOf(ReportsResponse::class, $reports);
        }
    }
}
