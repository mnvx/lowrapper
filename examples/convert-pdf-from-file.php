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

$outputFile = __DIR__ . '/output/pdf-to-png.png';

$converter = new Converter();
$converter->setLogger(new Logger());

$parameters = (new LowrapperParameters())
    ->setInputFile(__DIR__ . '/data/pdf.pdf')
    ->setOutputFormat(Format::GRAPHICS_PNG)
    ->setOutputFile($outputFile);

$converter->convert($parameters);

// Example finish


$html = '<img src="output/pdf-to-png.png"/>';
include __DIR__ . '/layout/layout.html';
