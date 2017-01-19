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
     * Converter constructor.
     * @param string $binaryPath
     * @param string $tempDir
     * @param int $timeout
     * @param LoggerInterface|null $logger
     * @param string $tempPrefix
     */
    public function __construct(
        string $binaryPath = self::BINARY_DEFAULT,
        string $tempDir = null,
        int $timeout = null,
        LoggerInterface $logger = null,
        string $tempPrefix = 'lowrapper_'
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
        if (!$parameters->getInputFile()) {
            throw new LowrapperException('Input file must be specified');
        }
        if (!$parameters->getOutputFile()) {
            throw new LowrapperException('Output file must be specified');
        }

        if ($parameters->getDocumentType() && !in_array($parameters->getDocumentType(), DocumentType::getAvailableValues(), true)) {
            throw new LowrapperException(sprintf('Unknown document type: ', $parameters->getDocumentType()));
        }

        if ($parameters->getOutputFormat() && !in_array($parameters->getOutputFormat(), Format::getAvailableValues(), true)) {
            throw new LowrapperException(sprintf('Unknown output format: ', $parameters->getOutputFormat()));
        }

        $inputFile = $this->createTemporaryFile($parameters->getInputFile());

        $documentType = $parameters->getDocumentType() ? '--' . $parameters->getDocumentType() : '';
        $outputFormat = $parameters->getOutputFormat();
        $command = $this->binaryPath . sprintf(' --headless %s --convert-to %s "%s"', $documentType, $outputFormat, $inputFile);

        echo $command;
        $process = $this->createProcess($command);

        if ($this->timeout) {
            $process->setTimeout($this->timeout);
        }

        // Convert from stdin
        if (!$parameters->getInputFile()) {
            $process->setInput($parameters->getInputStream());
        }

        $this->logger->info(sprintf('Start: %s', $command));

        $result = null;
        $errors = null;
        $self = $this;
        $resultCode = $process->run(function ($type, $buffer) use (&$result, &$errors, $self) {
            if (Process::ERR === $type) {
                $self->logger->warning($buffer);
            }
            else {
                $result .= $buffer;
            }
        });

        $this->createOutputFile($inputFile . '.' . $parameters->getOutputFormat(), $parameters->getOutputFile());

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
    protected function createProcess(string $command): Process
    {
        return new Process($command, $this->tempDir);
    }

    /**
     * @param string $inputFile
     * @return string
     */
    protected function createTemporaryFile(string $inputFile): string
    {
        $temporaryFile = $this->tempDir . '/' . uniqid($this->tempPrefix);
        copy($inputFile, $temporaryFile);
        return $temporaryFile;
    }

    /**
     * @param string $inputFile
     * @param string $outputFile
     * @return bool
     */
    protected function createOutputFile(string $inputFile, string $outputFile): bool
    {
        return rename($inputFile, $outputFile);
    }

}