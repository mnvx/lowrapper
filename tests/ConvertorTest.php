<?php

use Mnvx\Lowrapper\Converter;
use Mnvx\Lowrapper\DocumentType;
use Mnvx\Lowrapper\Format;
use Mnvx\Lowrapper\LowrapperParameters;
use Symfony\Component\Process\Process;

class ConvertorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider converterProvider
     */
    public function testConvert(LowrapperParameters $parameters, string $command, string $binary = null)
    {
        $processStub = $this->getMockBuilder(Process::class)
            ->disableOriginalConstructor()
            ->getMock();
        $processStub->method('run')->willReturn(0);

        $mockBuilder = $this->getMockBuilder(Converter::class);
        if ($binary) {
            $mockBuilder->setConstructorArgs([$binary]);
        }
        $converterStub = $mockBuilder->setMethods(['createProcess'])
            ->getMock();

        $converterStub->expects($this->once())
            ->method('createProcess')
            ->with($this->equalTo($command));

        $converterStub->convert($parameters);
    }

    public function converterProvider()
    {
        return [
            'From HTML file to HTML stdout' => [
                (new LowrapperParameters())
                    ->setDocumentType(DocumentType::WEB)
                    ->setOutputFormat(Format::WEB_HTML)
                    ->setInputFile('test.html'),
                'libreoffice --headless --web --convert-to html "test.html"',
                null,
            ],
            'From HTML file to docx file' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentType::WRITER)
                    ->setOutputFormat(Format::TEXT_DOCX)
                    ->setOutputFile('test.docx'),
                'libreoffice --headless --writer --convert-to docx "test.html"',
                null,
            ],
            'Binary' => [
                (new LowrapperParameters())
                    ->setInputFile('test.html')
                    ->setDocumentType(DocumentType::WRITER)
                    ->setOutputFormat(Format::TEXT_DOCX)
                    ->setOutputFile('test.docx'),
                '/test/path --headless --writer --convert-to docx "test.html"',
                '/test/path',
            ],
        ];
    }

}