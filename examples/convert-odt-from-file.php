<?php

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Example start

use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

$outputFile = __DIR__ . '/output/odt-to-html.html';

$converter = new Converter();
$parameters = (new LowrapperParameters())
    ->setInputFile(__DIR__ . '/data/odt.odt')
    ->setOutputFormat(Format::WEB_HTML);

$result = $converter->convert($parameters);

// Example finish


echo $result;
