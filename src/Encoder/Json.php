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
     * Default bitwise flags combination for JSON decoding
     *
     * @var int
     */
    const DEFAULT_DECODE_FLAGS = JSON_FORCE_OBJECT;

    /**
     * Default bitwise flags combination for JSON encoding
     *
     * @var int
     */
    const DEFAULT_ENCODE_FLAGS = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT;

    /**
     * Decode the given JSON formatted data into an object
     *
     * @param string $json    The input data
     * @param array  $options An associative array of options for the decoding process:
     *    - 'flags' : a bitwise combination of JSON_* constants (defaults to self::DEFAULT_DECODE_FLAGS)
     *    - 'depth' : override the $depth argument passed to json_encode (defaults to self::DEFAULT_MAX_DEPTH)
     *
     * @return mixed
     * @throws JsonException
     */
    public static function decode($json, $options = [])
    {
        $depth = self::get($options, 'depth', self::DEFAULT_MAX_DEPTH);
        $flags = self::get($options, 'flags', self::DEFAULT_DECODE_FLAGS);

        try {
            $data = \json_decode($json, false, $depth, self::JSON_THROW_ON_ERROR | $flags);
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
     * @param array $options An associative array of options for encoding process:
     *    - 'flags' : a bitwise combination of JSON_* constants (defaults to self::DEFAULT_ENCODE_FLAGS)
     *
     * @return string
     * @throws JsonException
     */
    public static function encode($object, $options = [])
    {
        $flags = self::get($options, 'flags', self::DEFAULT_ENCODE_FLAGS);

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
}
