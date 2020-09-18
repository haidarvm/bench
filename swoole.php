<?php 
$http = new Swoole\HTTP\Server("127.0.0.1", 9501);

$http->on('request', function ($request, $response) {
    $response->end("Hello World");
});

$http->start();