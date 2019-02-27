<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;

class Json2YamlCommand extends ConverterCommand
{
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
        return Yaml::dump($object, 4, 4, Yaml::DUMP_OBJECT_AS_MAP);
    }
}
