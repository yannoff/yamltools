#!/usr/bin/env php
<?php

error_reporting(E_ALL);

$mode = 0755;
$version = $argv[1] ?? 'latest';
$main = "bin/app.php";
$alias = "yamltools.phar";
$output = "bin/yamltools.phar";
$banner = "/**
 *
 * YAML Tools Project - version: $version
 * Copyright (c) Yann Blacher (Yannoff) - MIT License
 * @link https://github.com/yannoff/yamltools
 *
 */";

$php = '/\.php$/';

$stub = <<<EOT
#!/usr/bin/env php
<?php
$banner
Phar::mapPhar('$alias');
require "phar://$alias/$main"; __HALT_COMPILER();
EOT;

$phar = new Phar($output);
$phar->startBuffering();

$phar->addFile($main);
$phar->buildFromDirectory('./src', $php);
$phar->buildFromDirectory('vendor', $php);
$phar->compressFiles(Phar::GZ);
$phar->setStub($stub);

$phar->stopBuffering();

chmod($output, $mode);
