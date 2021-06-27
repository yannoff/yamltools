<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\YamlTools\Encoder\Yaml;
use Yannoff\YamlTools\Encoder\Json;

/**
 * Class Json2Yaml
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class Json2Yaml extends ConverterCommand
{
    /**
     * {@inheritdoc}
     */
    protected function load($json)
    {
        return Json::decode($json);
    }

    /**
     * {@inheritdoc}
     */
    protected function dump($object)
    {
        return Yaml::encode($object);
    }
}
