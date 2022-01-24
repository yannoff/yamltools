<?php

/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;
use Yannoff\Component\Console\Definition\Argument;
use Yannoff\Component\Console\Definition\Option;
use Yannoff\Component\YAML\Contents;

/**
 * TODO
 *  [ ] Handle blank line comments
 */

/**
 * Class YamlCommentsImport
 * Import comments from YAML input file
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class YamlCommentsImport extends CommentsCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $help = 'Inject comments from the index file into the given YAML file';

        $this
            ->setHelp($help)
            ->setDescription($help)
            ->addArgument(
                'input',
                Argument::REQUIRED,
                'File where comments are stored'
            )
            ->addArgument(
                'destination',
                Argument::REQUIRED,
                'Destination file comments will be incorporated to'
            )
            ->addOption(
                'write',
                'w',
                Option::FLAG,
                'Write merged YAML contents to destination file'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {

            $infile = $this->getArgument('input');
            $outfile = $this->getArgument('destination');

            $comments = Yaml::parseFile($infile, Yaml::PARSE_OBJECT | Yaml::PARSE_CUSTOM_TAGS);

            $outStream = (new Contents($outfile))->injectComments($comments);

            if (null == $this->getOption('write')) {
                $this->iowrite((string) $outStream, null);
                return 0;
            }

            file_put_contents($outfile, $outStream);

        } catch (\Exception $e) {

            $this->errorln($e->getMessage());
            return 1;

        }

        return 0;
    }
}
