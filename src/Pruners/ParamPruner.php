<?php
namespace tzfrs\URLPruner\Pruners;

/**
 * This class is used to handle pruning of the parameters of the URL
 *
 * Class ParamPruner
 * @package tzfrs\URLPruner\Pruners
 * @author Theo Tzaferis <theo.tzaferis@active-value.de>
 * @license MIT
 *
 */
class ParamPruner
{
    /**
     * Removes all query parameters from an URL
     *
     * @param string $url
     * @return string
     */
    public static function all($url)
    {
        return strtok($url, '?');
    }

    /**
     * Removes all parameters from an URL that have specific keys
     *
     * @param string $url The URL that will be pruned
     * @param array $keys The keys that will be removed
     * @return string
     */
    public static function keys($url, $keys)
    {
        return self::parse($url, $keys);
    }

    /**
     * This method removes parameters from the URL based on values
     *
     * @param string $url The URL that will be pruned
     * @param array $values The values
     * @return string
     */
    public static function values($url, $values)
    {
        return self::parse($url, $values, false);
    }

    /**
     * This URL actually parses the URL and removes the query parameters from the url.
     *
     * @param string $url The URL that will be pruned
     * @param array $params The keys/values that will be removed
     * @param bool $identifyByIndex Defines whether we will check an index for removing the parameter or the value
     * @return string
     */
    public static function parse($url, $params, $identifyByIndex = true)
    {
        $parsedURL = parse_url($url);

        if (!isset($parsedURL['query'])) {
            return $url;
        }

        $queryParameters = explode('&', $parsedURL['query']);
        $newQueryParams = [];
        foreach ($queryParameters as $pair) {
            if (strpos($pair, '=') !== false) {
                list($name,$value) = explode('=', $pair, 2);
                $matchAgainst = $identifyByIndex ? $name : $value;
                foreach ($params as $item) {
                    if ($item == $matchAgainst) {
                        continue 2;
                    }
                }
            }
            $newQueryParams[] = $pair;
        }
        $newQueryString = implode('&', $newQueryParams);

        $result = '';
        $result .= isset($parsedURL['scheme']) ? $parsedURL['scheme'] . '://' : '';
        $result .= isset($parsedURL['user']) ? $parsedURL['user'] : '';
        $result .= isset($parsedURL['pass']) ? ':' . $parsedURL['pass'] . '@' : (isset($parsedURL['user']) ? '@' : '');
        $result .= isset($parsedURL['host']) ? $parsedURL['host'] : '';
        $result .= isset($parsedURL['port']) ? ':' . $parsedURL['port'] : '';
        $result .= isset($parsedURL['path']) ? $parsedURL['path'] : '';
        $result .= '?' . $newQueryString;
        $result .= isset($parsedURL['fragment']) ? '#' . $parsedURL['fragment'] : '';

        return $result;
    }

}