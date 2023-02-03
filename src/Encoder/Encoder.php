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
     * Transform the given string to an object or array
     *
     * @param string $contents The formatted text to be decoded
     * @param array  $options  Extra decoding options
     * @param int    $flags    Optional bitwise combination of decoding flags
     *
     * @return mixed The decoded object/array representation
     * @throws EncoderException
     */
    abstract public static function decode($contents, $options = [], $flags = null);

    /**
     * Transform the given object/array to its string representation
     *
     * @param mixed $object  The object/array to be encoded
     * @param array $options Extra encoding options
     * @param int   $flags   Optional bitwise combination of encoding flags
     *
     * @return string The string representation of the encoded object/array
     * @throws EncoderException
     */
    abstract public static function encode($object, $options = [], $flags = null);

    /**
     * Return the default value for the decode() method $flag argument
     *
     * @return int A bitwise flags combination (zero if none)
     */
    abstract public static function getDefaultDecodeFlags();

    /**
     * Return the default value for the encode() method $flag argument
     *
     * @return int A bitwise flags combination (zero if none)
     */
    abstract public static function getDefaultEncodeFlags();

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
        if (\array_key_exists($name, $options)) {
            return $options[$name];
        }

        return $default;
    }
}
