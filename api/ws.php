<?php

use Kudosgen\Base64Encoder;
use Kudosgen\Generator\ImageGenerator;
use Kudosgen\WebSocket\RatcherWebSocketHandler;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require_once 'vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new RatcherWebSocketHandler(new ImageGenerator(), new Base64Encoder())
        )
    ),
    8080
);

$server->run();
