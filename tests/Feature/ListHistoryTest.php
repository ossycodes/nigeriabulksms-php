<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\HistoryResponse;

class ListHistoryTest extends \PHPUnit\Framework\TestCase
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

    public function testListHistory(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '[
  {"message":"body of text message goes in here","sender":"test","price":"3.0000","units":1,"length":"12c\/1p","send_date":"2023-09-21 15:22:07","class":"text","date":"2023-09-21 15:22:07"},
  {"message":"body of text message goes in here","sender":"test","price":"3.0000","units":1,"length":"33c\/1p","send_date":"2023-09-21 15:02:52","class":"text","date":"2023-09-21 15:02:52"}
            ]',
        ]);

        $history = $this->client->history->getList();

        foreach ($history->items as $history) {
            self::assertInstanceOf(HistoryResponse::class, $history);
        }
    }
}
