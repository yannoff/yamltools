<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\Component\Console\Definition\Argument;

/**
 * Class ConverterCommand
 * Base command for both JSON & YAML converters
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
abstract class ConverterCommand extends BaseCommand
{
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

        $name = sprintf('%s:%s:%s', $ns, $in, $out);

        parent::__construct($name);
    }

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $inputFormat  = strtoupper($this->in);
        $outputFormat = strtoupper($this->out);
        $helpText     = sprintf('Convert a %s file to %s format', $inputFormat, $outputFormat);

        $this
            ->setHelp($helpText)
            ->setDescription($helpText)
            ->addArgument(
                'infile',
                Argument::REQUIRED,
                sprintf('Input file (%s). If `-` provided, use standard input', $inputFormat)
            )
            ->addArgument(
                'outfile',
                Argument::OPTIONAL,
                sprintf('Output file (%s). If none provided, use standard output', $outputFormat)
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

            $data = $this->load($contents);

            $out = $this->dump($data);

            // In case the dump() result is 'null', don't write to file
            if ('null' == $out) {
                echo '(null)';
                $this->debug("No content generated, so file $outfile wasn't written.");
                return 0;
            }

            if ($outfile) {
                file_put_contents($outfile, $out);
                $this->errorln("Written file $outfile.");
                return 0;
            }

            $this->iowrite($out);

        } catch (\Exception $e) {

            $this->errorln($e->getMessage());
            return 1;

        }

        return 0;
    }

    /**
     * Convert JSON or YAML contents as an object
     *
     * @param string $contents The YAML or JSON data to be loaded as an object
     *
     * @return mixed An object representation of the loaded data
     */
    abstract protected function load($contents);

    /**
     * Dump object to output format
     *
     * @param mixed $object
     *
     * @return string
     */
    abstract protected function dump($object);
}
