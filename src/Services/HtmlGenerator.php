<?php

namespace Fungku\SpamGuard\Services;

use Fungku\SpamGuard\Config;
use Fungku\SpamGuard\Exceptions\SpamGuardException;

class HtmlGenerator
{
    /**
     * @param  array $elements
     * @return string
     * @throws SpamGuardException
     */
    public static function generate($elements = [])
    {
        $elements = $elements ?: Config::$elements;

        $html = [];

        foreach ($elements as $element) {
            $generator = '\\Fungku\\SpamGuard\\Html\\' . ucfirst(camel_case($element));

            if (! (new \ReflectionClass($generator))->isInstantiable()) {
                throw new SpamGuardException("Target class [$generator] is not instantiable.");
            }

            $html[] = app($generator)->html();
        }

        return implode("\r\n", $html);
    }
}
