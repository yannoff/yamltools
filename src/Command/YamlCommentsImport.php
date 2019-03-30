<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
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
                InputArgument::REQUIRED,
                'File where comments are stored'
            )
            ->addArgument(
                'destination',
                InputArgument::REQUIRED,
                'Destination file comments will be incorporated to'
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

            $infile = $input->getArgument('input');
            $outfile = $input->getArgument('destination');

            $comments = Yaml::parseFile($infile, Yaml::PARSE_OBJECT | Yaml::PARSE_CUSTOM_TAGS);

            $outStream = (new Contents($outfile))->injectComments($comments);

            if (null == $input->getOption('write')) {
                $output->writeln((string) $outStream);
                exit(0);
            }

            file_put_contents($outfile, $outStream);
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
            exit(1);
        }
    }
}
