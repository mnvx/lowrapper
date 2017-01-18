<?php

namespace Mnvx\Lowrapper;

class LowrapperParameters
{

    /**
     * Full path to output file. In case when output is stdout - null.
     * @var null|string
     */
    protected $outputFile = null;

    /**
     * Output format.
     *
     * @var null
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
     * @var null
     */
    protected $documentType = null;

    /**
     * Full path to input file. In case when input is stdin - null.
     * @var null|string
     */
    protected $inputFile = null;

    /**
     * Sttin data
     * @var mixed
     */
    protected $inputStream = null;

    public function __construct(
        string $outputFile = null,
        string $outputFormat = null,
        string $documentType = null,
        string $inputFile = null,
        string $inputStream = null
    ) {
        $this->setOutputFile($outputFile);
        $this->setOutputFormat($outputFormat);
        $this->setDocumentType($documentType);
        $this->setInputFile($inputFile);
        $this->setInputStream($inputStream);
    }

    /**
     * @return null|string
     */
    public function getInputFile()
    {
        return $this->inputFile;
    }

    /**
     * @param null|string $inputFile
     * @return LowrapperParameters
     */
    public function setInputFile($inputFile)
    {
        $this->inputFile = $inputFile;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getOutputFile()
    {
        return $this->outputFile;
    }

    /**
     * @param null|string $outputFile
     * @return LowrapperParameters
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = $outputFile;
        return $this;
    }

    /**
     * @return null
     */
    public function getOutputFormat()
    {
        return $this->outputFormat;
    }

    /**
     * @param null $outputFormat
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

    /**
     * @return mixed
     */
    public function getInputStream()
    {
        return $this->inputStream;
    }

    /**
     * @param mixed $inputStream
     * @return LowrapperParameters
     */
    public function setInputStream($inputStream)
    {
        $this->inputStream = $inputStream;
        return $this;
    }

    /**
     * @return null
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param null $documentType
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

}