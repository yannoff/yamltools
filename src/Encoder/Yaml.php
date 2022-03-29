<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2021-06-19 19:34
 */

namespace Yannoff\YamlTools\Encoder;

use Symfony\Component\Yaml\Exception\DumpException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as BaseYaml;
use Yannoff\YamlTools\Exception\YamlException;

/**
 * Class Yaml
 * Wrapper class for the yaml encoding library
 *
 * @package Yannoff\YamlTools\Encoder
 */
class Yaml extends Encoder
{
    /**
     * Default indent for the encoded YAML
     *
     * @var int
     */
    const DEFAULT_INDENT = 4;

    /**
     * Default max expand level for the encoded YAML
     *
     * @var int
     */
    const DEFAULT_EXPAND_MAX_LEVEL = 6;
    
    /**
     * Decode the given YAML formatted input data into an object
     *
     * @param string $contents The YAML formatted contents
     * @param array  $options  An associative array of options for the decoding process
     * @param int    $flags    A bitwise combination of Yaml::PARSE_* flags - defaults to self::getDefaultDecodeFlags()
     *
     * @return mixed
     * @throws YamlException
     */
    public static function decode($contents, $options = [], $flags = null)
    {
        $flags = $flags ?: self::getDefaultDecodeFlags();

        try {
            return BaseYaml::parse($contents, $flags);
        } catch (ParseException $e) {
            throw new YamlException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    /**
     * Encode the given input object to a YAML formatted string
     *
     * @param mixed $object  The input object
     * @param array $options An associative array of options for the encoding process:
     *    - 'inline' : override the $inline argument passed to Yaml::dump() - defaults to self::DEFAULT_INLINE
     *    - 'indent' : override the $indent argument passed to Yaml::dump() - defaults to self::DEFAULT_INDENT
     *@param int   $flags   A bitwise combination of Yaml::DUMP_* constants - defaults to self::getDefaultEncodeFlags()
     *
     * @return string
     * @throws YamlException
     */
    public static function encode($object, $options = [], $flags = null)
    {
        $inline = self::get($options, 'inline', self::DEFAULT_EXPAND_MAX_LEVEL);
        $indent = self::get($options, 'indent', self::DEFAULT_INDENT);
        $flags = $flags ?: self::getDefaultEncodeFlags();

        try {
            return BaseYaml::dump($object, $inline, $indent, $flags);
        } catch (DumpException $e) {
            throw new YamlException($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDefaultDecodeFlags()
    {
        return BaseYaml::PARSE_OBJECT_FOR_MAP;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDefaultEncodeFlags()
    {
        return BaseYaml::DUMP_OBJECT_AS_MAP | BaseYaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE;
    }
}
