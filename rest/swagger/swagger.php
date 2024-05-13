<?php

require __DIR__ . '/../../vendor/autoload.php';


define('BASE_URL', 'http://localhost:80/Web-Employee-Management-System/rest/');

error_reporting(0);

$openapi = \OpenApi\Generator::scan(['../routes', './']);
header('Content-Type: application/x-yaml');
echo $openapi->toYaml();
?>
