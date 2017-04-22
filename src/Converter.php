<?php

namespace Mnvx\Lowrapper;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Symfony\Component\Process\Process;

class Converter implements ConverterInterface
{
    use LoggerAwareTrait;

    const BINARY_DEFAULT = 'libreoffice';

    /**
     * Path to binary
     * @var string
     */
    protected $binaryPath;

    /**
     * Temporary path (by defaults is equal to sys_get_temp_dir())
     * @var string
     */
    protected $tempDir;

    /**
     * Timeout
     * @var int
     */
    protected $timeout;

    /**
     * Prefix for temporary file names
     * @var string
     */
    protected $tempPrefix;

    /**
     * Defailt options for libreoffice
     * @var array
     */
    protected $defaultOptions = [
        '--headless',
        '--invisible',
        '--nocrashreport',
        '--nodefault',
        '--nofirststartwizard',
        '--nologo',
        '--norestore',
    ];

    /**
     * Converter constructor.
     * @param string $binaryPath
     * @param string $tempDir
     * @param int $timeout
     * @param LoggerInterface|null $logger
     * @param string $tempPrefix
     */
    public function __construct(
        /*string*/ $binaryPath = self::BINARY_DEFAULT,
        /*string*/ $tempDir = null,
        /*int*/ $timeout = null,
        LoggerInterface $logger = null,
        /*string*/ $tempPrefix = 'lowrapper_'
    ) {
        if (!$logger) {
            $logger = new NullLogger();
        }
        $this->setLogger($logger);
        $this->binaryPath = $binaryPath;

        $this->tempDir = $tempDir ?: sys_get_temp_dir();
        if (substr($this->tempDir, -1, 1) === '/') {
            $this->tempDir = substr($this->tempDir, 0, -1);
        }

        $this->timeout = $timeout;
        $this->tempPrefix = $tempPrefix;
    }

    /**
     * @inheritdoc
     */
    public function convert(LowrapperParameters $parameters)
    {
        $documentType = $parameters->getDocumentType();
        if ($documentType && !in_array($documentType, DocumentType::getAvailableValues(), true)) {
            throw new LowrapperException('Unknown document type: ' . $documentType);
        }
        $documentType = $documentType ?: DocumentType::getDefault($parameters->getOutputFormat());

        if ($parameters->getOutputFormat() && !in_array($parameters->getOutputFormat(), Format::getAvailableValues(), true)) {
            throw new LowrapperException('Unknown output format: ' . $parameters->getOutputFormat());
        }

        $inputFile = $this->getInputFile($parameters);
        $outputFilters = implode('', array_map(function ($item) {
            return ':' . $item;
        }, $this->getOutputFilters($parameters)));

        $options = array_merge($this->defaultOptions, [
            $documentType ? '--' . $documentType : '',
            '--convert-to "' . $parameters->getOutputFormat() . $outputFilters . '"',
            '"' . $inputFile . '"',
        ]);
        $command = $this->binaryPath . ' ' . implode(' ', $options);

        $process = $this->createProcess($command);

        if ($this->timeout) {
            $process->setTimeout($this->timeout);
        }

        $this->logger->info(sprintf('Start: %s', $command));

        $self = $this;
        $resultCode = $process->run(function ($type, $buffer) use ($self) {
            if (Process::ERR === $type) {
                $self->logger->warning($buffer);
            }
            else {
                $self->logger->info($buffer);
            }
        });

        $result = $this->createOutput($inputFile, $parameters->getOutputFile());
        $this->deleteInput($parameters, $inputFile);

        if ($resultCode != 0) {
            $this->logger->error(sprintf('Failed with result code %d: %s', $resultCode, $command));
            throw new LowrapperException('Error on converting data with LibreOffice: ' . $resultCode, $resultCode);
        }
        else {
            $this->logger->info(sprintf('Finished: %s', $command));
        }

        return $result;
    }

    /**
     * @param $command
     * @return Process
     */
    protected function createProcess(/*string*/ $command)//: Process
    {
        return new Process($command, $this->tempDir);
    }

    /**
     * @param string $inputFile
     * @return string
     */
    protected function createTemporaryFile(/*string*/ $inputFile)//: string
    {
        $temporaryFile = $this->genTemporaryFileName();
        copy($inputFile, $temporaryFile);
        return $temporaryFile;
    }

    /**
     * Generate unique name for temporary file
     * @return string
     */
    protected function genTemporaryFileName()
    {
        return $this->tempDir . '/' . uniqid($this->tempPrefix);
    }

    /**
     * @param string $inputFile
     * @param string $outputFile
     * @return string|null
     */
    protected function createOutput(/*string*/ $inputFile, /*string*/ $outputFile = null)
    {
        if ($outputFile) {
            if (file_exists($outputFile)) {
                unlink($outputFile);
            }
            rename($inputFile, $outputFile);
            return null;
        }

        $result = file_get_contents($inputFile);
        unlink($inputFile);
        return $result;
    }

    /**
     * Get output filters
     * @param LowrapperParameters $parameters
     * @return string[]
     */
    protected function getOutputFilters(LowrapperParameters $parameters)
    {
        if (empty($parameters->getOutputFilters())) {
            return OutputFilters::getDefault($parameters->getOutputFormat());
        }
        return $parameters->getOutputFilters();
    }

    /**
     * Get input file - return existed or create from input data
     * @param LowrapperParameters $parameters
     * @return string
     */
    protected function getInputFile(LowrapperParameters $parameters)
    {
        if ($parameters->getInputFile()) {
            return $this->createTemporaryFile($parameters->getInputFile());
        }

        $temporaryFile = $this->genTemporaryFileName();
        file_put_contents($temporaryFile, $parameters->getInputData());
        return $temporaryFile;
    }

    /**
     * Delete input file if it was created in process of conversion
     * @param LowrapperParameters $parameters
     * @param string $inputFile
     */
    protected function deleteInput(LowrapperParameters $parameters, /*string*/ $inputFile)
    {
        unlink($inputFile);
    }

}
