Master Status: [![Build Status](https://travis-ci.org/mnvx/lowrapper.png?branch=master)](https://travis-ci.org/mnvx/lowrapper) 

# PHP wrapper over LibreOffice converter
Simple way for documents conversion into various formats.

For example: html -> docx, html -> pdf, docx -> html and many more.

![Formats](examples/formats.jpg "Formats")

## Usage

```php
use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

// Create converter
$converter = new Converter();

// Describe parameters for converter
$parameters = (new LowrapperParameters())
    // HTML document
    ->setInputFile('test.html')
    // Format of result document is docx
    ->setOutputFormat(Format::TEXT_DOCX)
    // Result file name
    ->setOutputFile('path-to-result-docx.docx');

// Run converter
$converter->convert($parameters);
```

More [examples](/examples)

## Requirements

- PHP 5.5+
- libreoffice-core

## Installation

```bash
sudo add-apt-repository ppa:libreoffice/ppa
sudo apt-get update
sudo apt-get install default-jdk -y
sudo apt-get install python-software-properties  -y
sudo apt-get install software-properties-common -y
sudo apt-get install libreoffice-core --no-install-recommends
sudo apt-get install libreoffice-writer
composer require mnvx/lowrapper
```

## Run tests

```bash
./vendor/bin/phpunit
```

## License

Released under the MIT license
