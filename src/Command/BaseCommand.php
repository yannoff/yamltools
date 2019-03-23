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
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function setIO(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @param $message
     */
    protected function debug($message)
    {
        $message = sprintf("%s: %s", $this->getApplication()->getName(), $message);
        $this->output->writeln($message, OutputInterface::VERBOSITY_VERBOSE);
    }
}
