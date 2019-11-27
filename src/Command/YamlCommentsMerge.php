<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\Component\Console\Definition\Argument;
use Yannoff\Component\Console\Definition\Option;
use Yannoff\Component\YAML\Contents;

/**
 * TODO
 *  [x] Handle multi-line comments
 *  [ ] Handle blank line comments
 *  [x] Don't restore comments if the key is not found in the new YAML
 */

/**
 * Class YamlCommentsMerge
 * Restore comments from YAML input file
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class YamlCommentsMerge extends CommentsCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $help = 'Incorporate comments from the 1st YAML file into the second YAML file';

        $this
            ->setHelp($help)
            ->setDescription($help)
            ->addArgument(
                'original',
                Argument::REQUIRED,
                'Original YAML file with comments'
            )
            ->addArgument(
                'filtered',
                Argument::REQUIRED,
                'Destination file (containing YAML without comments)'
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

            $infile = $this->getArgument('original');
            $outfile = $this->getArgument('filtered');

            $inContents = new Contents($infile);
            $comments = $inContents->collectComments();

            $outContents = new Contents($outfile);
            $outContents->injectComments($comments);

            $outStream = (string) $outContents;

            if (null == $this->getOption('write')) {
                $this->writeln($outStream);
                return 0;
            }

            file_put_contents($outfile, $outStream);

        } catch (\Exception $e) {

            $this->writeln($e->getMessage());
            return 1;

        }

        return 0;
    }
}
