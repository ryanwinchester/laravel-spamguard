<?php

namespace Fungku\SpamGuard\Middleware;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Redirector;

abstract class Middleware
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @param Repository $config
     * @param Redirector $redirector
     */
    public function __construct(Repository $config, Redirector $redirector)
    {
        $this->config = $config;
        $this->redirector = $redirector;
    }

    /**
     * Make the validator instance by middleware name.
     *
     * @param  string $middleware
     * @return \Fungku\SpamGuard\Validators\Validator
     */
    protected function makeValidator($middleware)
    {
        $validator = '\\Fungku\\SpamGuard\\Validators\\' . camel_case($middleware) . 'Validator';

        return app($validator);
    }

    /**
     * @param  string $middleware
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedResponse($middleware)
    {
        return $this->redirector
            ->back()
            ->withInput()
            ->withErrors($this->getErrorMessage($middleware));
    }

    /**
     * Get the error message for the associated middleware validation.
     *
     * @param  string $middleware
     * @return array
     */
    protected function getErrorMessage($middleware)
    {
        $message = $this->config->get("spam.messages.{$middleware}", Config::$messages[$middleware]);

        return ['spamguard' => $message];
    }
}
