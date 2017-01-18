# PHP wrapper over LibreOffice converter
Simple way for documents conversion into various formats.

For example: html -> docx, html -> pdf, docx -> html and many more.

## Usage

```
use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\LowrapperParameters;
use Mnvx\Lowrapper\Format;

// Create converter
$converter = new Converter();

// Describe parameters for converter
$parameters = (new LowrapperParameters())
    // HTML document as string on input
    ->setInputStream('<!DOCTYPE html><html>Example of HTML document</html>')
    // Result file name
    ->setOutputFile('path-to-result-docx.docx')
    // Format of result document is docx
    ->setOutputFormat(Format::FORMAT_TEXT_DOCX);

// Run converter
$converter->convert($parameters);
```

## Install

```
sudo apt-get install libreoffice
composer require mnvx/lowrapper
```

## License

Released under the MIT license