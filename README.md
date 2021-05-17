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

##### On Linux-based systems

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

##### Inside a Docker container

Example of installation libreoffice into docker container:

```dockerfile
FROM php:7.2-fpm

WORKDIR /var/www/html

# Install libreoffice headless
RUN apt update -y \
    && mkdir -p /usr/share/man/man1 \
    && apt -y install default-jdk-headless libreoffice-core libreoffice-writer libreoffice-calc
RUN mkdir -p /var/www/.cache/dconf \
    && mkdir -p /var/www/.config/libreoffice \
    && chmod -R ugo+rwx /var/www/.cache \
    && chmod -R ugo+rwx /var/www/.config
```

##### On macOS

Watch out! For weird reasons, the LibreOffice command line binary has a non-obvious name on macOS:
`soffice`, probably because until 2010 the software was named StarOffice.
Install the necessary Java Development Kit (which is needed for LibreOffice to run) and LibreOffice
itself for example with the packet manager [brew](https://brew.sh):

```
brew install openjdk
brew install libreoffice
```
Check if LibreOffice is installed correctly:

```
soffice -v
# should show
# LibreOffice 7.0.x.x
```
And in your code tell the Converter the name of the binary:

```
$converter = new Converter('soffice');
```

## Run tests

```bash
./vendor/bin/phpunit
```

## License

Released under the MIT license
