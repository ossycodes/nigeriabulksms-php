<?php

namespace Ossycodes\Nigeriabulksms\Tests\Feature;

use Ossycodes\Nigeriabulksms\Client;
use Ossycodes\Nigeriabulksms\Configuration;
use Ossycodes\Nigeriabulksms\Common\HttpClient;
use Ossycodes\Nigeriabulksms\Objects\ContactsResponse;

class ListContactsTest extends \PHPUnit\Framework\TestCase
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

    public function testListContacts(): void
    {
        $this->mockClient->expects(self::once())->method('performHttpRequest')->willReturn([
            200,
            '',
            '[{"id":1,"name":"TEST","mobile":"000000000000"}]',
        ]);

        $contacts = $this->client->contacts->getList();

        foreach ($contacts->items as $contact) {
            self::assertInstanceOf(ContactsResponse::class, $contact);
        }
    }
}
