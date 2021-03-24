<?php

namespace Laravelista\Ekko;

use Laravelista\Ekko\Url\GenericUrlProvider;
use Laravelista\Ekko\Url\UrlProviderInterface;

/**
 * This is the main (core) class of Ekko.
 * Extend this class to customize for specific framework.
 *
 * See Frameworks/Laravel/Ekko.php for details.
 */
class Ekko
{
    /**
     * This value gets returned if the
     * given output equals null.
     *
     * @var mixed $defaultOutput Can be anything.
     */
    protected $defaultOutput = 'active';

    /**
     * Holds the Url provider.
     *
     * @var UrlProviderInterface $url
     */
    protected UrlProviderInterface $url;

    public function __construct()
    {
        $this->url = new GenericUrlProvider();
    }

    /**
     * This static method uses `require_once` to
     * include global helper functions. By default
     * global functions are not enabled.
     *
     * @return void
     */
    public static function enableGlobalHelpers()
    {
        require_once(__DIR__.'/Helpers.php');
    }

    /**
     * Use this to change the default output value.
     *
     * @param mixed $value This can be anything
     *
     * @return void
     */
    public function setDefaultOutput($value): void
    {
        $this->defaultOutput = $value;
    }

    /**
     * Used internally to determine what needs
     * to be returned as output, user given output or
     * the default output.
     *
     * @param mixed $output Can be null or user given output.
     * @return mixed
     */
    public function getOutput($output)
    {
        return $output ?? $this->defaultOutput;
    }

    /**
     * It sets the Url provider. If none is set,
     * then it uses the GenericUrlProvider.
     *
     * @param UrlProviderInterface $urlProvider
     *
     * @return void
     */
    public function setUrlProvider(UrlProviderInterface $urlProvider): void
    {
        $this->url = $urlProvider;
    }

    /**
     * It returns the Url provider instance.
     *
     * @return UrlProviderInterface
     */
    public function getUrlProvider()
    {
        return $this->url;
    }

    /**
     * It uses the Url provider `current()` method
     * to get the current Url. If no Url provider is set,
     * it uses the GenericUrlProvider.
     *
     * @return string
     */
    public function getCurrentUrl(): string
    {
        return $this->url->current();
    }

    /**
     * This is a special internal method which loops
     * through the given input array, applies given method
     * to the single element in the array and returns true
     * immediately if there is a match, otherwise it returns false
     * at the end.
     *
     * @param array $input Array of URLs.
     * @param string $methodName The name of the method.
     * @return boolean
     */
    protected function inArray(array $input, string $methodName): bool
    {
        foreach ($input as $url) {
            if ($this->$methodName($url, true)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Depending on the result it returns the user given output
     * or the default output value or if the result is false,
     * then it returns null.
     *
     * @param boolean $result The result of the match.
     * @param mixed $output User given output.
     * @return mixed|null Is either user given output or the default output value or null
     */
    public function displayOutput(bool $result, $output)
    {
        return $result ? $this->getOutput($output) : null;
    }

    /**
     * It accepts input as a string or an array of strings.
     * Output is optional, but it defaults to the default output value.
     *
     * eg. `/user*` becomes `/^\/user.*?(\?.*?)*?&/ and if the current Url is `/user`
     * it returns output or the default output if user given output is null.
     *
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    public function isActive(array|string $input, $output = null)
    {
        if (is_array($input)) {
            return $this->displayOutput($this->inArray($input, __FUNCTION__), $output);
        }

        $regex = '/^' . str_replace(preg_quote('*'), '.*?', preg_quote($input, '/')) . '(\?.*?)*?$/';

        return $this->displayOutput((bool) preg_match($regex, $this->getCurrentUrl()), $output);
    }
}
