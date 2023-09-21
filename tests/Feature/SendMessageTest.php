<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use PHPUnit\Framework\MockObject\MockObject;
use Ossycodes\Nigeriabulksms\Objects\Message;
use Ossycodes\Nigeriabulksms\Common\HttpClient;

class SendMessageTest extends \PHPUnit\Framework\TestCase
{
    /** @var Client */
    protected $client;

    /** @var MockObject */
    protected $mockClient;

    public function testHttpClientMock(): void
    {
        $this->mockClient->expects($this->atLeastOnce())->method('addUserAgentString');
        new Client($this->config, $this->mockClient);
    }

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

    /**
     * @test
     */
    public function testSendMessage(): void
    {
        $message = new Message();
        $message->sender = 'Nigeriabulksms';
        $message->recipients = ['000000000'];
        $message->body = 'This is a test message.';

        $this->mockClient->expects(self::atLeastOnce())->method('performHttpRequest')->willReturn([
            200,
            '',
            '{"status":"OK","count":1,"price":3}',
        ]);

        $this->mockClient->expects(self::once())->method('performHttpRequest')->with(
            'message',
            [
                'sender'    => 'Nigeriabulksms',
                'message'   => 'This is a test message.',
                'mobiles'   => '000000000',
            ]
        );

        $this->client->message->send($message);
    }
}
