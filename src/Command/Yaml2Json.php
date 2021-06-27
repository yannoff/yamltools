<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\YamlTools\Encoder\Json;
use Yannoff\YamlTools\Encoder\Yaml;

/**
 * Class Yaml2Json
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class Yaml2Json extends ConverterCommand
{
    /**
     * {@inheritdoc}
     */
    protected function load($yaml)
    {
        return Yaml::decode($yaml);
    }

    /**
     * {@inheritdoc}
     */
    protected function dump($object)
    {
        return Json::encode($object);
    }
}
