<?php

namespace Laravelista\Ekko;

use Laravelista\Ekko\Url\UrlProviderInterface;
use Laravelista\Ekko\Url\StandardUrlProvider;

class Ekko
{
    protected $defaultOutput = 'active';

    protected $url;

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

    public function isActive($input, $output = null)
    {
        if (is_array($input)) {
            return count(array_filter($input, '__FUNCTION__')) > 0 ? $this->getOutput($output) : null;
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '$/';

        return preg_match($regex, $this->getCurrentUrl()) ? $this->getOutput($output) : null;
    }
}
