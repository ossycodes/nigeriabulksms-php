<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\NumbersResponse;

class ListNumbersTest extends \PHPUnit\Framework\TestCase
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

    public function testListNumbers(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '[{"id":44281,"name":"fam","count":1,"description":null}]',
        ]);

        $numbers = $this->client->numbers->getList();

        foreach ($numbers->items as $numbers) {
            self::assertInstanceOf(NumbersResponse::class, $numbers);
        }
    }
}
