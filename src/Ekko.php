<?php

namespace Laravelista\Ekko;

use Laravelista\Ekko\Url\UrlProviderInterface;
use Laravelista\Ekko\Url\StandardUrlProvider;

class Ekko
{
    protected $defaultOutput = 'active';

    protected $url;

    static public function enableGlobalHelpers()
    {
        require_once(__DIR__.'/Helpers.php');
    }

    public function setDefaultOutput($value)
    {
        $this->defaultOutput = $value;
    }

    public function getOutput($output)
    {
        return $output ?? $this->defaultOutput;
    }

    public function setUrlProvider(UrlProviderInterface $urlProvider)
    {
        $this->url = $urlProvider;
    }

    public function getCurrentUrl()
    {
        if (!isset($this->url)) {
            $this->url = new StandardUrlProvider;
        }

        return $this->url->current();
    }

    protected function inArray(array $input, string $methodName): bool
    {
        foreach($input as $url) {
            if ($this->$methodName($url, true)) {
                return true;
            }
        }

        return false;
    }

    public function displayOutput(bool $result, $output)
    {
        return $result ? $this->getOutput($output) : null;
    }

    public function isActive($input, $output = null)
    {
        if (is_array($input)) {
            return $this->displayOutput($this->inArray($input, __FUNCTION__), $output);
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '$/';

        return $this->displayOutput(preg_match($regex, $this->getCurrentUrl()), $output);
    }
}
