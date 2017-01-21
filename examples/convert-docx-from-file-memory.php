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

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters())
    ->setInputFile(__DIR__ . '/data/docx.docx')
    ->setOutputFormat(Format::WEB_HTML);

$result = $converter->convert($parameters);

// Example finish


echo $result;