<?php

namespace Fungku\SpamGuard\Services;

use Fungku\SpamGuard\Exceptions\SpamGuardException;
use Fungku\SpamGuard\SpamGuard;

class HtmlGenerator
{
    /**
     * @param array $options
     * @return string
     * @throws SpamGuardException
     */
    public static function generate(array $options = [])
    {
        $availableElements = SpamGuard::filterElements($options);

        $elements = [];

        foreach ($availableElements as $element) {
            $generator = '\\Fungku\\SpamGuard\\Html\\' . camel_case($element);

            if (! (new \ReflectionClass($generator))->isInstantiable()) {
                throw new SpamGuardException("Target class [$generator] is not instantiable.");
            }

            $elements[] = app($generator)->html();
        }

        return implode("\r\n", $elements);
    }
}
