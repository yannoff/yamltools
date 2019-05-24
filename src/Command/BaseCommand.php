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

    /**
     * Proxy to InputInterface::getArgument() method
     *
     * @param string $name The argument name
     *
     * @return mixed
     */
    protected function getArgument($name)
    {
        return $this->input->getArgument($name);
    }

    /**
     * Proxy to InputInterface::getOption() method
     *
     * @param string $name The option name
     *
     * @return mixed
     */
    protected function getOption($name)
    {
        return $this->input->getOption($name);
    }

    /**
     * Proxy to OutputInterface::writeln() method.
     *
     * @param string|array $messages The message as an array of strings or a single string
     * @param int          $options  A bitmask of options (one of the OUTPUT or VERBOSITY constants)
     */
    protected function writeln($messages, $options = 0)
    {
        $this->output->writeln($messages, $options);
    }
}
