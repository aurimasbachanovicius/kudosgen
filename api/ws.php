<?php

use Kudosgen\Generator\ImageGenerator;
use Kudosgen\WebSocket\RatcherWebSocketHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Kudosgen\Base64Encoder;

require_once 'vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new RatcherWebSocketHandler(new ImageGenerator(), new Base64Encoder())
        )
    ),
    8080,
);

$server->run();
