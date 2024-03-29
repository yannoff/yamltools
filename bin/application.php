<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:51
 */

error_reporting(E_ALL);

// Redirect error messages to standard error output
ini_set('display_errors', 'stderr');

require 'vendor/autoload.php';

use Yannoff\Component\Console\Application;
use Yannoff\YamlTools\Command\Json2Yaml;
use Yannoff\YamlTools\Command\Yaml2Json;
use Yannoff\YamlTools\Command\YamlCommentsMerge;
use Yannoff\YamlTools\Command\YamlCommentsExport;
use Yannoff\YamlTools\Command\YamlCommentsImport;

$application = new Application('yamltools', '@@version@@');

$application->addCommands([
    new Json2Yaml('convert', 'json', 'yaml'),
    new Yaml2Json('convert', 'yaml', 'json'),
    new YamlCommentsMerge('yaml:comments:merge'),
    new YamlCommentsExport('yaml:comments:export'),
    new YamlCommentsImport('yaml:comments:import'),
]);

$application->run();
