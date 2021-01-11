<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Json2Yaml
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class Json2Yaml extends ConverterCommand
{
    /** @var int */
    const YAML_INDENT = 4;
    /** @var int */
    const YAML_EXPAND_MAXLEVEL = 6;

    /**
     * {@inheritdoc}
     */
    protected function load($json)
    {
        return json_decode($json, false, JSON_FORCE_OBJECT);
    }

    /**
     * {@inheritdoc}
     */
    protected function dump($object)
    {
        return Yaml::dump($object, self::YAML_EXPAND_MAXLEVEL, self::YAML_INDENT, Yaml::DUMP_OBJECT_AS_MAP|Yaml::DUMP_EMPTY_ARRAY_AS_SEQUENCE);
    }
}
