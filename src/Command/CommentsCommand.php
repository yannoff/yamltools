<?php
/**
 * @project yamltools
 * @author  yannoff
 * @created 2019-03-20 19:56
 */

namespace Yannoff\YamlTools\Command;

use Yannoff\Component\YAML\Contents;

/**
 * Class CommentsCommand
 * Base class for YAML Comments manipulation commands
 *
 * @author  Yannoff
 * @package Yannoff\YamlTools\Command
 */
abstract class CommentsCommand extends BaseCommand
{
    /**
     * @param Contents $analyzer
     */
    public function _debugAnalyzer(Contents $analyzer)
    {
        foreach ($analyzer->getRows() as $n => $row) {
            printf("%-2s: %s\n", $n, $row);
        }
    }
}
