<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use StdClass;
use Yannoff\Component\Console\Definition\Argument;
use Yannoff\YamlTools\Exception\RuntimeWarning;

/**
 * Class ConverterCommand
 * Base command for both JSON & YAML converters
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
abstract class ConverterCommand extends BaseCommand
{
    /** @var string The line-ending char */
    const LF = "\n";

    /** @var string The command global namespace */
    protected $ns;
    /** @var string The converter input format */
    protected $in;
    /** @var string The converter output format */
    protected $out;

    /**
     * ConverterCommand constructor.
     *
     * @param string $ns  Command global namespace
     * @param string $in  Input format (to import from)
     * @param string $out Output format (to export to)
     */
    public function __construct($ns, $in, $out)
    {
        $this->ns  = $ns;
        $this->in  = $in;
        $this->out = $out;

        $name = \sprintf('%s:%s:%s', $ns, $in, $out);

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $inputFormat  = \strtoupper($this->in);
        $outputFormat = \strtoupper($this->out);
        $helpText     = \sprintf('Convert a %s file to %s format', $inputFormat, $outputFormat);

        $this
            ->setHelp($helpText)
            ->setDescription($helpText)
            ->addArgument(
                'infile',
                Argument::OPTIONAL,
                \sprintf('Input file (%s). If none provided (or `-` is used), use standard input', $inputFormat)
            )
            ->addArgument(
                'outfile',
                Argument::OPTIONAL,
                \sprintf('Output file (%s). If none provided, use standard output', $outputFormat)
            );
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {

            $infile = $this->getArgument('infile');
            $outfile = $this->getArgument('outfile');

            $contents = $this->getContents($infile);

            $data = $this->doLoad($contents);

            $out = $this->doDump($data);

            // In case the dump() result is 'null', don't write to file
            if ('null' == \trim($out)) {
                throw new RuntimeWarning('No contents generated');
            }

            if ($outfile) {
                \file_put_contents($outfile, $out);
                $this->debug("Written file $outfile.");
                return 0;
            }

            $this->iowrite($out, null);

        } catch (\Exception $e) {
            $this->debug($e);
            return $e->getCode();
        }

        return 0;
    }

    /**
     * Wrapper method for the load() child method
     *
     * @param string $contents The YAML or JSON data to be loaded as an object
     *
     * @return StdClass An object representation of the loaded data
     */
    protected function doLoad($contents)
    {
        return $this->load($contents);
    }

    /**
     * Wrapper method for the dump() child method
     * Append a new line to the converted contents
     *
     * @param StdClass $object Object representation of the data to be dumped
     *
     * @return string The JSON or YAML formatted contents
     */
    protected function doDump($object)
    {
        return \rtrim($this->dump($object), self::LF) . self::LF;
    }

    /**
     * Convert JSON or YAML contents as an object
     *
     * @param string $contents The YAML or JSON data to be loaded as an object
     *
     * @return StdClass An object representation of the loaded data
     */
    abstract protected function load($contents);

    /**
     * Dump object to output format
     *
     * @param StdClass $object Object representation of the data to be dumped
     *
     * @return string The JSON or YAML formatted contents
     */
    abstract protected function dump($object);
}
