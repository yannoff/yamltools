<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2021-06-19 19:21
 */

namespace Yannoff\YamlTools\Encoder;

use Yannoff\YamlTools\Exception\JsonException;

/**
 * Class Json
 *
 * @package Yannoff\YamlTools\Encoder
 */
class Json extends Encoder
{
    /**
     * Keep BC with PHP < 7.3
     *
     * @var int
     */
    const JSON_THROW_ON_ERROR = 4194304;

    /**
     * Default max-depth for when decoding JSON
     *
     * @var int
     */
    const DEFAULT_MAX_DEPTH = 512;

    /**
     * Decode the given JSON formatted data into an object
     *
     * @param string $contents The input data
     * @param array  $options  An associative array of options for the decoding process:
     *    - 'depth' : override the $depth argument passed to json_encode - defaults to self::DEFAULT_MAX_DEPTH
     * @param int    $flags    A bitwise combination of JSON_* constants - defaults to self::getDefaultDecodeFlags()
     *
     * @return mixed
     * @throws JsonException
     */
    public static function decode($contents, $options = [], $flags = null)
    {
        $depth = self::get($options, 'depth', self::DEFAULT_MAX_DEPTH);
        $flags = $flags ?: self::getDefaultDecodeFlags();

        try {
            $data = \json_decode($contents, false, $depth, self::JSON_THROW_ON_ERROR | $flags);
        } catch (\Exception $e) {
            throw new JsonException($e->getCode());
        }

        if (($code = \json_last_error()) !== JSON_ERROR_NONE) {
            throw new JsonException($code);
        }

        return $data;
    }

    /**
     * Encode the given input object to a JSON formatted string
     *
     * @param mixed $object  The input object
     * @param array $options An associative array of options for encoding process
     * @param int   $flags   A bitwise combination of JSON_* constants - defaults to self::getDefaultEncodeFlags()
     *
     * @return string
     * @throws JsonException
     */
    public static function encode($object, $options = [], $flags = null)
    {
        $flags = $flags ?: self::getDefaultEncodeFlags();

        try {
            $json = \json_encode($object, self::JSON_THROW_ON_ERROR | $flags);
        } catch (\Exception $e) {
            throw new JsonException($e->getCode());
        }

        if (($code = \json_last_error()) !== JSON_ERROR_NONE) {
            throw new JsonException($code);
        }

        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDefaultDecodeFlags()
    {
        return \JSON_FORCE_OBJECT;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDefaultEncodeFlags()
    {
        return \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_PRETTY_PRINT;
    }
}
