<?php
namespace tzfrs\URLPruner\Pruners;

/**
 * This class is used to handle pruning of an URL with regex
 *
 * Class RegexPruner
 * @package tzfrs\URLPruner\Pruners
 * @author Theo Tzaferis <theo.tzaferis@active-value.de>
 * @license MIT
 *
 */
class RegexPruner
{
    /**
     * This method removes a string based on a Regex from an URL
     *
     * @param string $url The URL that will be pruned
     * @param string $value The Regex
     * @return mixed
     */
    public static function replace($url, $value)
    {
        return preg_replace('#' . $value . '#', '', $url);
    }

}