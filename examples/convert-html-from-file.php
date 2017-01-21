<?php

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




// Example start

use Mnvx\Lowrapper\Converter;
//use Mnvx\Lowrapper\DocumentType;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

$outputFile = __DIR__ . '/output/html-to-text.text';

$converter = new Converter();
$parameters = (new LowrapperParameters())
//    ->setDocumentType(DocumentType::WRITER)
    ->setInputFile(__DIR__ . '/data/html.html')
//    ->addOutputFilter('Text (encoded)')
//    ->addOutputFilter('UTF8')
    ->setOutputFormat(Format::TEXT_TEXT)
    ->setOutputFile($outputFile);

$converter->convert($parameters);

// Example finish


$result = file_get_contents($outputFile);
unlink($outputFile);
$html = '<pre>' . $result . '</pre>';
include __DIR__ . '/layout/layout.html';