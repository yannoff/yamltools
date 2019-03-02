<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Json2YamlCommand
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class Json2YamlCommand extends ConverterCommand
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
        return json_decode($json, false);
    }

    /**
     * {@inheritdoc}
     */
    protected function dump($object)
    {
        return Yaml::dump($object, self::YAML_EXPAND_MAXLEVEL, self::YAML_INDENT, Yaml::DUMP_OBJECT_AS_MAP);
    }
}
