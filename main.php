<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/servers.php';

//API Client
use TruckersMP\API\APIClient;
use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

$guzzle = new GuzzleClient([]);
$adapter = new GuzzleAdapter($guzzle);
$client = new APIClient($adapter);

//Load servers data
$servers = new Servers($client);

$s = $servers->fetchAsObject();

//Load script rendering the dynamic parts.
require __DIR__ . '/render.php';