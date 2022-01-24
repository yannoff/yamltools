<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\Component\Console\Command;

/**
 * Class BaseCommand
 * Base class for YAML Comments manipulation commands
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
abstract class BaseCommand extends Command
{
    /**
     * Print message on standard output, prefixed by the application name
     *
     * @param string $message
     */
    protected function debug($message)
    {
        $message = sprintf("%s: %s", $this->application->getName(), $message);
        $this->errorln($message);
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
            return $this->ioread();
        }

        return file_get_contents($filename);
    }
}
