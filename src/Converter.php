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
     * Timeout
     * @var int
     */
    protected $timeout;

    /**
     * Converter constructor.
     * @param string $binaryPath
     * @param int $timeout
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        string $binaryPath = self::BINARY_DEFAULT,
        int $timeout = null,
        LoggerInterface $logger = null
    ) {
        if (!$logger) {
            $logger = new NullLogger();
        }
        $this->setLogger($logger);
        $this->binaryPath = $binaryPath;
        $this->timeout = $timeout;
    }

    /**
     * @inheritdoc
     */
    public function convert(LowrapperParameters $parameters)
    {
        if (!$parameters->getInputFile()) {
            throw new LowrapperException('Input file must be specified');
        }

        if ($parameters->getDocumentType() && !in_array($parameters->getDocumentType(), DocumentType::getAvailableValues(), true)) {
            throw new LowrapperException(sprintf('Unknown document type: ', $parameters->getDocumentType()));
        }

        if ($parameters->getOutputFormat() && !in_array($parameters->getOutputFormat(), Format::getAvailableValues(), true)) {
            throw new LowrapperException(sprintf('Unknown output format: ', $parameters->getOutputFormat()));
        }

        // @todo: temporary files

        $inputFile = $parameters->getInputFile() ? '"' . $parameters->getInputFile() . '"' : '';
        $documentType = $parameters->getDocumentType() ? '--' . $parameters->getDocumentType() : '';
        $outputFormat = $parameters->getOutputFormat();
        $command = $this->binaryPath . sprintf(' --headless %s --convert-to %s %s', $documentType, $outputFormat, $inputFile);

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
        return new Process($command);
    }

}