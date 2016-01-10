<?php
namespace tzfrs\URLPruner\Pruners;

/**
 * This class handles string manipulation for pruning an URL
 *
 * Class StringPruner
 * @package tzfrs\URLPruner\Pruners
 * @author Theo Tzaferis <theo.tzaferis@active-value.de>
 * @license MIT
 *
 */
class StringPruner
{
    /**
     * This method removes everything after a specific character from an URL
     *
     * @param $string
     * @param $wildcard
     * @return string
     */
    public static function anythingAfter($string, $wildcard)
    {
        $pos = stripos($string, $wildcard);
        if ($pos === false) {
            return $string;
        }
        return substr($string, 0, $pos + strlen($wildcard));
    }

}