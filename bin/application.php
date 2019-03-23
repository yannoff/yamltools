#!/usr/bin/env php
<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:51
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Yannoff\YamlTools\Command\Json2Yaml;
use Yannoff\YamlTools\Command\Yaml2Json;

$application = new Application('yamltools', '@package_version@');

$application->addCommands([
    new Json2Yaml('convert', 'json', 'yaml'),
    new Yaml2Json('convert', 'yaml', 'json'),
]);

$application->run();
