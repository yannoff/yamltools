<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2021-06-19 19:21
 */

namespace Yannoff\YamlTools\Exception;

use RuntimeException;

/**
 * Class EncoderException
 * Base exception for Encoder classes
 *
 * @package Yannoff\YamlTools\Exception
 */
class EncoderException extends RuntimeException
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf('%s (code: %s)', $this->message,  $this->code);
    }
}
