<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2021-06-19 19:21
 */

namespace Yannoff\YamlTools\Encoder;

use Yannoff\YamlTools\Exception\EncoderException;

/**
 * Class Encoder
 * Base class for encoders
 *
 * @package Yannoff\YamlTools\Encoder
 */
abstract class Encoder
{
    /**
     * @param string $contents
     * @param array  $options
     *
     * @return mixed
     * @throws EncoderException
     */
    abstract public static function decode($contents, $options = []);

    /**
     * @param mixed $object
     * @param array $options
     *
     * @return string
     * @throws EncoderException
     */
    abstract public static function encode($object, $options = []);


    /**
     * Extract the given queried option, falling back to the provided defaults
     *
     * @param array      $options The option array
     * @param string     $name    The option name
     * @param mixed|null $default Optional fallback value (defaults to null)
     *
     * @return mixed|null
     */
    protected static function get($options, $name, $default = null)
    {
        if (array_key_exists($name, $options)) {
            return $options[$name];
        }

        return $default;
    }
}
