<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2023-02-03 18:21
 */

namespace Yannoff\YamlTools\Exception;

use RuntimeException as BaseRuntimeException;

/**
 * Class RuntimeException
 * Base for all application runtime exceptions
 *
 * @package Yannoff\YamlTools\Exception
 */
class RuntimeException extends BaseRuntimeException
{
    /**
     * @var string
     */
    protected $severity = 'error';

    /**
     * Internal string representation of the exception
     *
     * @return string
     */
    protected function stringify()
    {
        return \sprintf('%s. (code: %s)', \rtrim($this->message, '.'),  $this->code);
    }

    /**
     * String representation that will be used for error message display
     *
     * @return string
     */
    public function __toString()
    {
        return \sprintf('%s: %s', \ucfirst($this->severity), $this->stringify());
    }
}
