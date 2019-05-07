<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CommentsCommand
 * Base class for YAML Comments manipulation commands
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class BaseCommand extends Command
{
    /** @var InputInterface */
    protected $input;

    /** @var OutputInterface */
    protected $output;

    /**
     * Setter for input/output class properties
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function setIO(InputInterface $input, OutputInterface $output)
    {
        $this->input  = $input;
        $this->output = $output;
    }

    /**
     * Print message on standard output, prefixed by the application name
     *
     * @param string $message
     */
    protected function debug($message)
    {
        $message = sprintf("%s: %s", $this->getApplication()->getName(), $message);
        $this->output->writeln($message, OutputInterface::VERBOSITY_VERBOSE);
    }

    /**
     * Get contents from input file or stdin if file is null or "-"
     *
     * @param string|null $filename Relative or absolute path to the input file
     *
     * @return false|string
     */
    protected function getContents($filename = null)
    {
        if (null === $filename || '-' === $filename) {
            return stream_get_contents(STDIN);
        }

        return file_get_contents($filename);
    }
}
