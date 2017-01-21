<?php

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/Logger.php';


// Example start

use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

$source = file_get_contents(__DIR__ . '/data/html.html');

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters())
    ->setInputData($source)
    ->setOutputFormat(Format::TEXT_TEXT);

$result = $converter->convert($parameters);

// Example finish


$html = '<pre>' . $result . '</pre>';
include __DIR__ . '/layout/layout.html';