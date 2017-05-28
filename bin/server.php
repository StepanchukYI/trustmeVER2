<?php
/**
 * Created by PhpStorm.
 * User: Illya
 * Date: 21.05.2017
 * Time: 18:33
 */
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MySock\Push;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/cboden/ratchet/src/MySock/Push.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Push()
        )
    ),
    8080
);

$server->run();