<?php

use Kudosgen\Base64Encoder;
use Kudosgen\Generator\ImageGenerator;
use Kudosgen\WebSocket\RatcherWebSocketHandler;

require_once 'vendor/autoload.php';

$app = new Ratchet\App('localhost', 8080);
$app->route('/image', new RatcherWebSocketHandler(new ImageGenerator(), new Base64Encoder()), ['*']);
$app->route('/echo', new Ratchet\Server\EchoServer, ['*']);
$app->run();


//
//$server = IoServer::factory(
//    new HttpServer(
//        new WsServer(
//            new RatcherWebSocketHandler(new ImageGenerator(), new Base64Encoder())
//        )
//    ),
//    8080
//);
//
//$server->run();
