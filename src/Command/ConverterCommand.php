<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

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
        $inputFormat  = mb_convert_case($this->in, MB_CASE_UPPER);
        $outputFormat = mb_convert_case($this->out, MB_CASE_UPPER);
        $helpText     = sprintf('Convert a %s file to %s format', $inputFormat, $outputFormat);

        $this
            ->setHelp($helpText)
            ->setDescription($helpText)
            ->addArgument(
                'infile',
                InputArgument::REQUIRED,
                sprintf('Input file (%s). If `-` provided, use standard input', $inputFormat)
            )
            ->addArgument(
                'outfile',
                InputArgument::OPTIONAL,
                sprintf('Output file (%s). If none provided, use standard output', $outputFormat)
            );
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setIO($input, $output);

        try {
            $infile = $input->getArgument('infile');
            $outfile = $input->getArgument('outfile');

            $contents = $this->getContents($infile);

            $data = $this->load($contents);

            $out = $this->dump($data);

            // In case the dump() result is 'null', don't write to file
            if ('null' == $out) {
                echo '(null)';
                $this->debug("No content generated, so file $outfile wasn't written.");
                exit(0);
            }

            if ($outfile) {
                file_put_contents($outfile, $out);
                $this->debug("Written file $outfile.");
                exit(0);
            }

            echo $out;
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }
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
