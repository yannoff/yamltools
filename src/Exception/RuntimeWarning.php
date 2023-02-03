<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2023-02-03 18:21
 */

namespace Yannoff\YamlTools\Exception;

/**
 * Class RuntimeWarning
 * Raised in case of non-blocking runtime errors
 *
 * @package Yannoff\YamlTools\Exception
 */
class RuntimeWarning extends RuntimeException
{
    /**
     * @var string
     */
    protected $severity = 'warning';

    /**
     * {@inheritdoc}
     */
    protected function stringify()
    {
        return \rtrim($this->message, '.') . '.';
    }
}
