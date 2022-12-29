<?php

require_once 'vendor/autoload.php';

use Kudosgen\Generator\GenerateRequest;
use Kudosgen\Generator\ImageGenerator;

$json = file_get_contents('php://input');
try {
    $json = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    $message = $json['message'];
} catch (JsonException $e) {
    $message = 'default';
}

$imageGenerator = new ImageGenerator();
$request = new GenerateRequest('', '', $message);
try {
    $imageGenerator->generate($request);
} catch (Exception $e) {
    echo $e->getMessage();
    die;
}
