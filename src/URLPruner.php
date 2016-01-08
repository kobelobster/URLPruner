<?php
namespace tzfrs\URLPruner;

use tzfrs\URLPruner\Pruners\ParamPruner;
use tzfrs\URLPruner\Pruners\StringPruner;
use tzfrs\URLPruner\Pruners\RegexPruner;

/**
 * This is the class to handle all prunings. It acts like a wrapper for the pruner classes
 *
 * Class URLPruner
 * @package tzfrs\URLPruner
 * @author Theo Tzaferis <theo.tzaferis@active-value.de>
 * @license MIT
 *
 */
class URLPruner
{
    /**
     * Array containing all options used to prune an URL
     *
     * @var null|array
     */
    protected $options = null;

    /**
     * Sets the option to remove anything after a specific letter/word in the URL
     *
     * @param $wildcard
     * @return $this
     */
    public function anythingAfter($wildcard)
    {
        $this->options['anythingAfter'] = $wildcard;

        return $this;
    }

    /**
     * Sets the option to remove a string in the URL based on a Regex
     *
     * @param $regex
     * @return $this
     */
    public function regex($regex)
    {
        $this->options['regex'] = $regex;

        return $this;
    }

    /**
     * Sets the option to remove parameters with a specific name
     *
     * @param $params
     * @return $this
     */
    public function parameters($params)
    {
        $this->options['params'] = $params;

        return $this;
    }

    /**
     * Sets the option to remove ALL parameters from the URL
     *
     * @return $this
     */
    public function allParameters()
    {
        $this->options['params_all'] = true;

        return $this;
    }

    /**
     * Sets the option to remove all parameters that have a specific value
     *
     * @param $paramValues
     * @return $this
     */
    public function parameterValues($paramValues)
    {
        $this->options['params_values'] = $paramValues;

        return $this;
    }

    /**
     * This method prunes the URL by applying all options that have been set previously.
     *
     * If the user didn't set any options we can simply return the URL. Otherwise we iterate over each option the user
     * "activated" and call the respective class with the function.
     * After all options have been applied we can return the URL
     *
     * @param $url
     * @return string
     */
    public function prune($url)
    {
        if ($this->options === null) {
            return $url;
        }

        foreach ($this->options as $option => $value) {
            switch ($option) {
                case 'anythingAfter':
                    $url = StringPruner::anythingAfter($url, $value);
                    break;
                case 'regex':
                    $url = RegexPruner::replace($url, $value);
                    break;
                case 'params_all':
                    $url = ParamPruner::all($url);
                    break;
                case 'params':
                    $url = ParamPruner::keys($url, $value);
                    break;
                case 'params_values':
                    $url = ParamPruner::values($url, $value);
                    break;

            }
        }

        // Reset
        $this->options = null;

        return $url;
    }

}