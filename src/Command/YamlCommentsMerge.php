<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-02-01 19:44
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
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
                InputArgument::REQUIRED,
                'Original YAML file with comments'
            )
            ->addArgument(
                'filtered',
                InputArgument::REQUIRED,
                'Destination file (containing YAML without comments)'
            )
            ->addOption(
                'write',
                'w',
                InputOption::VALUE_NONE,
                'Write merged YAML contents to destination file'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setIO($input, $output);

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
                exit(0);
            }

            file_put_contents($outfile, $outStream);

        } catch (\Exception $e) {
            $this->writeln($e->getMessage());
        }
    }
}
