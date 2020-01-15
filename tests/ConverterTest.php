<?php

use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\DocumentType;
use Mnvx\Lowrapper\Format;
use Mnvx\Lowrapper\LowrapperParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class ConverterTest extends TestCase
{
    /**
     * @dataProvider converterProvider
     */
    public function testConvert(LowrapperParameters $parameters, /*string*/ $command, /*string*/ $binary = null)
    {
        $processStub = $this->getMockBuilder(Process::class)
            ->disableOriginalConstructor()
            ->getMock();
        $processStub->method('run')->willReturn(0);

        $mockBuilder = $this->getMockBuilder(Converter::class);
        if ($binary) {
            $mockBuilder->setConstructorArgs([$binary]);
        }
        $converterStub = $mockBuilder->setMethods([
                'createProcess',
                'createTemporaryFile',
                'createOutput',
                'deleteInput',
                'genTemporaryFileName',
                'getInputFile',
            ])
            ->getMock();

        $converterStub->expects($this->once())
            ->method('createProcess')
            ->with($this->equalTo($command))
            ->willReturn($processStub);

        $converterStub
            ->method('createTemporaryFile')
            ->willReturn('some_temp_file');

        $converterStub->expects($this->once())
            ->method('createOutput')
            ->with($this->equalTo('some_temp_file.' . $parameters->getOutputFormat()));

        $converterStub
            ->method('genTemporaryFileName')
            ->willReturn('some_temp_file');

        $converterStub
            ->method('getInputFile')
            ->willReturn('some_temp_file');

        $converterStub->convert($parameters);
    }

    public function converterProvider()
    {
        $command = 'libreoffice --headless --invisible --nocrashreport --nodefault --nofirststartwizard --nologo --norestore ';
        return [
            'From HTML file to HTML stdout' => [
                (new LowrapperParameters())
                    ->setDocumentType(DocumentType::WEB)
                    ->setOutputFormat(Format::WEB_HTML)
                    ->setInputFile('test.html')
                    ->setOutputFile('test.docx'),
                $command .'--web --convert-to "html" "some_temp_file"',
                null,
            ],
            'From HTML file to docx file' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentType::WRITER)
                    ->setOutputFormat(Format::TEXT_DOCX)
                    ->setOutputFile('test.docx'),
                $command .'--writer --convert-to "docx" "some_temp_file"',
                null,
            ],
            'Default document type' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setOutputFormat(Format::TEXT_DOCX)
                    ->setOutputFile('test.docx'),
                $command .'--writer --convert-to "docx" "some_temp_file"',
                null,
            ],
            'Output filter' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setOutputFormat(Format::TEXT_TEXT)
                    ->setOutputFile('test.text')
                    ->addOutputFilter('some filter'),
                $command .'--web --convert-to "text:some filter" "some_temp_file"',
                null,
            ],
            'Default text filter' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setOutputFormat(Format::TEXT_TEXT)
                    ->setOutputFile('test.text'),
                $command .'--web --convert-to "text:Text (encoded):UTF8" "some_temp_file"',
                null,
            ],
            'Input string' => [
                (new LowrapperParameters())
                    ->setInputData('example html content')
                    ->setOutputFormat(Format::TEXT_TEXT)
                    ->setOutputFile('test.text'),
                $command .'--web --convert-to "text:Text (encoded):UTF8" "some_temp_file"',
                null,
            ],
            'Binary' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentType::WRITER)
                    ->setOutputFormat(Format::TEXT_DOCX)
                    ->setOutputFile('test.docx'),
                str_replace('libreoffice', '/test/path', $command) .'--writer --convert-to "docx" "some_temp_file"',
                '/test/path',
            ],
        ];
    }

}