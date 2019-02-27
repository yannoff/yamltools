<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;

class Yaml2JsonCommand extends ConverterCommand
{
    /**
     * {@inheritdoc}
     */
    protected function load($yaml)
    {
        return Yaml::parse($yaml, Yaml::PARSE_OBJECT_FOR_MAP);
    }

    /**
     * {@inheritdoc}
     */
    protected function dump($object)
    {
        return json_encode($object, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
