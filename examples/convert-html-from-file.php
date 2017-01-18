<?php

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Example start

use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

$converter = new Converter();
$parameters = (new LowrapperParameters())
    ->setInputFile(__DIR__ . '/data/html.html')
    ->setOutputFormat(Format::TEXT_TEXT);

$result = $converter->convert($parameters);

// Example finish


$html = '<pre>' . $result . '</pre>';
include __DIR__ . '/layout/layout.html';