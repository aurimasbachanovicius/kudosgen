<?php

namespace Kudosgen\WebSocket;

use Kudosgen\Generator\GenerateRequest;
use Kudosgen\Generator\ImageGeneratorInterface;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use Kudosgen\EncoderInterface;

class RatcherWebSocketHandler implements MessageComponentInterface
{
    public function __construct(
        private readonly ImageGeneratorInterface $imageGenerator,
        private readonly EncoderInterface $encoder
    ) {
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg): void
    {
        try {
            $msg = json_decode($msg, true, 512, JSON_THROW_ON_ERROR);
            $im = $this->imageGenerator->generate(new GenerateRequest('test from', 'test to', $msg['message']));

            $conn->send($this->encoder->encode($im));
        } catch (\Exception $e) {
            echo "failed to handle message " . $e->getMessage();
        }
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        // TODO: Implement onOpen() method.
    }

    public function onClose(ConnectionInterface $conn): void
    {
        // TODO: Implement onClose() method.
    }

    public function onError(ConnectionInterface $conn, \Exception $e): void
    {
        // TODO: Implement onError() method.
    }
}