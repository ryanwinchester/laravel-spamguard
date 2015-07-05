<?php

if (! function_exists('spamguard_middleware')) {
    /**
     * Register the spamguard middleware on a controller.
     *
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $options
     * @return void
     */
    function spamguard_middleware($controller, $options = [])
    {
        \Fungku\SpamGuard\Services\MiddlewareAssigner::assign($controller, $options);
    }
}

if (! function_exists('spamguard_html')) {
    /**
     * Get the form html to use with the spam guard middleware.
     *
     * @param  array $options
     * @return string
     */
    function spamguard_html($options = [])
    {
        return \Fungku\SpamGuard\Services\HtmlGenerator::generate($options);
    }
}

if (! function_exists('filter_elements')) {
    /**
     * Filter the spamguard elements by an options array.
     *
     * @param  array $options
     * @return string
     */
    function filter_elements($options = [])
    {
        $elements = \Fungku\SpamGuard\Config::$elements;

        if (isset($options['only'])) {
            return $options['only'];
        }

        if (isset($options['except'])) {
            array_forget($elements, $options['except']);
        }

        return $elements;
    }
}
