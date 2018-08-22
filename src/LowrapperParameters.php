<?php

namespace Mnvx\Lowrapper;

class LowrapperParameters
{

    /**
     * Full path to output file. In case when output is stdout - null.
     */
    protected $outputFile = null;

    /**
     * Output format.
     */
    protected $outputFormat = null;

    /**
     * Document type
     *
     * information from `libreoffice --help`:
     * --writer       create new text document.
     * --calc         create new spreadsheet document.
     * --draw         create new drawing.
     * --impress      create new presentation.
     * --base         create new database.
     * --math         create new formula.
     * --global       create new global document.
     * --web          create new HTML document.
     *
     */
    protected $documentType = null;

    /**
     * Full path to input file. In case when input is stdin - null.
     */
    protected $inputFile = null;

    /**
     * Input data, eg. HTML as string
     * @var mixed
     */
    protected $inputData = null;

    /**
     * Output filters, eg.
     * - Text (encoded)
     * - UTF8
     * @var string[]
     */
    protected $outputFilters = [];

    /**
     * LowrapperParameters constructor.
     * @param $outputFormat
     * @param $outputFile
     * @param $inputFile
     * @throws LowrapperException
     */
    public function __construct(
        /*string*/ $outputFormat = null,
        /*string*/ $outputFile = null,
        /*string*/ $inputFile = null
    ) {
        $this->setOutputFormat($outputFormat);
        $this->setOutputFile($outputFile);
        $this->setInputFile($inputFile);
    }


    public function getInputFile()
    {
        return $this->inputFile;
    }

    /**
     * @param $inputFile
     * @return LowrapperParameters
     */
    public function setInputFile($inputFile)
    {
        $this->inputFile = $inputFile;
        return $this;
    }


    public function getOutputFile()
    {
        return $this->outputFile;
    }

    /**
     * @param  $outputFile
     * @return LowrapperParameters
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = $outputFile;
        return $this;
    }


    public function getOutputFormat()
    {
        return $this->outputFormat;
    }

    /**
     * @param $outputFormat
     * @return LowrapperParameters
     * @throws LowrapperException
     */
    public function setOutputFormat($outputFormat)
    {
        if ($outputFormat && !in_array($outputFormat, Format::getAvailableValues())) {
            throw new LowrapperException('Unknown output format: ' . $outputFormat);
        }
        $this->outputFormat = $outputFormat;
        return $this;
    }

    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param $documentType
     * @return LowrapperParameters
     * @throws LowrapperException
     */
    public function setDocumentType($documentType)
    {
        if ($documentType && !in_array($documentType, DocumentType::getAvailableValues())) {
            throw new LowrapperException('Unknown document type: ' . $documentType);
        }
        $this->documentType = $documentType;
        return $this;
    }

    /**
     * @param $outputFilter
     * @return LowrapperParameters
     */
    public function addOutputFilter(/*string*/ $outputFilter)
    {
        $this->outputFilters[] = $outputFilter;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getOutputFilters()//: array
    {
        return $this->outputFilters;
    }

    /**
     * @return mixed
     */
    public function getInputData()
    {
        return $this->inputData;
    }

    /**
     * @param mixed $inputData
     * @return LowrapperParameters
     */
    public function setInputData($inputData)
    {
        $this->inputData = $inputData;
        return $this;
    }



}