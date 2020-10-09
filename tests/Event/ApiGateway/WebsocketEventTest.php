<?php declare(strict_types=1);

namespace Bref\Test\Event\DynamoDb;

use Bref\Event\ApiGateway\WebsocketEvent;
use PHPUnit\Framework\TestCase;

class WebsocketEventTest extends TestCase
{
    public function test_connect()
    {
        // Arrange
        $event = json_decode(file_get_contents(__DIR__ . '/websocket-connect.json'), true);

        // Act
        $event = new WebsocketEvent($event);

        // Assert
        $this->assertSame(WebsocketEvent::EVENT_TYPE_CONNECT, $event->getEventType());
        $this->assertSame('xyz-apiId', $event->getApiId());
        $this->assertSame('xyz-connectionId', $event->getConnectionId());
        $this->assertSame('xyz-apiId.execute-api.eu-west-1.amazonaws.com', $event->getDomainName());
        $this->assertSame('$connect', $event->getRouteKey());
        $this->assertSame('dev', $event->getStage());
        $this->assertNull($event->getBody());
    }

    public function test_disconnect()
    {
        // Arrange
        $event = json_decode(file_get_contents(__DIR__ . '/websocket-disconnect.json'), true);

        // Act
        $event = new WebsocketEvent($event);

        // Assert
        $this->assertSame(WebsocketEvent::EVENT_TYPE_DISCONNECT, $event->getEventType());
        $this->assertSame('xyz-apiId', $event->getApiId());
        $this->assertSame('xyz-connectionId', $event->getConnectionId());
        $this->assertSame('xyz-apiId.execute-api.eu-west-1.amazonaws.com', $event->getDomainName());
        $this->assertSame('$disconnect', $event->getRouteKey());
        $this->assertSame('dev', $event->getStage());
        $this->assertNull($event->getBody());
    }

    public function test_message()
    {
        // Arrange
        $event = json_decode(file_get_contents(__DIR__ . '/websocket-message.json'), true);

        // Act
        $event = new WebsocketEvent($event);

        // Assert
        $this->assertSame(WebsocketEvent::EVENT_TYPE_MESSAGE, $event->getEventType());
        $this->assertSame('xyz-apiId', $event->getApiId());
        $this->assertSame('xyz-connectionId', $event->getConnectionId());
        $this->assertSame('xyz-apiId.execute-api.eu-west-1.amazonaws.com', $event->getDomainName());
        $this->assertSame('$default', $event->getRouteKey());
        $this->assertSame('dev', $event->getStage());
        $this->assertSame('Hello Server!', $event->getBody());
    }
}
