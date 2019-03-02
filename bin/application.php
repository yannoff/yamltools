#!/usr/bin/env php
<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:51
 */

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Yannoff\YamlTools\Command\Json2YamlCommand;
use Yannoff\YamlTools\Command\Yaml2JsonCommand;

$application = new Application('yamltools', '@package_version@');

$application->addCommands([
    new Json2YamlCommand('convert', 'json', 'yaml'),
    new Yaml2JsonCommand('convert', 'yaml', 'json'),
]);

$application->run();
