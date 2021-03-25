<?php

namespace Laravelista\Ekko;

use Laravelista\Ekko\Url\GenericUrlProvider;
use Laravelista\Ekko\Url\UrlProviderInterface;

/**
 * This is the main (core) class of Ekko.
 * Extend this class to customize for specific framework.
 *
 * @see Laravelista\Ekko\Frameworks\Laravel\Ekko
 */
class Ekko
{
    protected UrlProviderInterface $url;

    /**
     * @param mixed $defaultOutput This value gets returned if
     * the given output equals null.
     */
    public function __construct(protected mixed $defaultOutput = 'active')
    {
        $this->url = new GenericUrlProvider();
    }

    /**
     * This static method uses `require_once` to
     * include global helper functions. By default
     * global functions are not enabled.
     */
    public static function enableGlobalHelpers(): void
    {
        require_once(__DIR__.'/Helpers.php');
    }

    /**
     * Use this to change the default output value.
     */
    public function setDefaultOutput(string $value): void
    {
        $this->defaultOutput = $value;
    }

    /**
     * Used internally to determine what needs
     * to be returned as output, user given output or
     * the default output.
     */
    public function getOutput(mixed $output): mixed
    {
        return $output ?? $this->defaultOutput;
    }

    /**
     * It sets the Url provider. If none is set,
     * then it uses the GenericUrlProvider.
     */
    public function setUrlProvider(UrlProviderInterface $urlProvider): void
    {
        $this->url = $urlProvider;
    }

    /**
     * It returns the Url provider instance.
     */
    public function getUrlProvider(): UrlProviderInterface
    {
        return $this->url;
    }

    /**
     * It uses the Url provider `current()` method
     * to get the current Url. If no Url provider is set,
     * it uses the GenericUrlProvider.
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
     */
    public function displayOutput(bool $result, mixed $output): mixed
    {
        return $result ? $this->getOutput(output: $output) : null;
    }

    /**
     * It accepts input as a string or an array of strings.
     * Output is optional, but it defaults to the default output value.
     *
     * eg. `/user*` becomes `/^\/user.*?(\?.*?)*?&/ and if the current Url is `/user`
     * it returns output or the default output if user given output is null.
     */
    public function isActive(array|string $input, mixed $output = null): mixed
    {
        if (is_array($input)) {
            return $this->displayOutput(
                result: $this->inArray(
                    input: $input,
                    methodName: __FUNCTION__
                ),
                output: $output
            );
        }

        $regex = '/^' .
            str_replace(
                search: preg_quote(str: '*'),
                replace: '.*?',
                subject: preg_quote(
                    str: $input,
                    delimiter: '/'
                )
            ) .
            '(\?.*?)*?$/';

        return $this->displayOutput(
            result: (bool) preg_match(
                pattern: $regex,
                subject: $this->getCurrentUrl()
            ),
            output: $output
        );
    }
}
