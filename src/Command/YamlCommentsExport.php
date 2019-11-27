<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Symfony\Component\Yaml\Yaml;
use Yannoff\Component\Console\Definition\Argument;
use Yannoff\Component\YAML\Contents;

/**
 * TODO
 *  [ ] Handle blank line comments
 */

/**
 * Class YamlCommentsExport
 * Export comments from YAML input file
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
class YamlCommentsExport extends CommentsCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $help = 'Export comments found in the given YAML file';

        $this
            ->setHelp($help)
            ->setDescription($help)
            ->addArgument(
                'original',
                Argument::REQUIRED,
                'Original YAML file with comments'
            )
            ->addArgument(
                'output',
                Argument::OPTIONAL,
                'Destination file comments will be exported to. If none provided, use standard output'
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
            $outfile = $this->getArgument('output');

            $analyzer = new Contents($infile);

            $comments = $analyzer->collectComments();

            $yaml = Yaml::dump($comments, 6, 4, Yaml::DUMP_OBJECT | Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);

            if (null == $outfile || '-' === $outfile) {
                $this->writeln($yaml);
                return 0;
            }

            file_put_contents($outfile, $yaml);

        } catch (\Exception $e) {

            $this->errorln($e->getMessage());
            return 1;

        }

        return 0;
    }
}
