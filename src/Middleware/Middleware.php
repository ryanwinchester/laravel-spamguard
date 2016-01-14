<?php

namespace Fungku\SpamGuard\Middleware;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Redirector;

abstract class Middleware
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var ResponseFactory
     */
    var $response;

    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @param Repository      $config
     * @param ResponseFactory $response
     * @param Redirector      $redirector
     */
    public function __construct(Repository $config, ResponseFactory $response, Redirector $redirector)
    {
        $this->config = $config;
        $this->response = $response;
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
        $validator = '\\Fungku\\SpamGuard\\Validators\\' . ucfirst(camel_case($middleware)) . 'Validator';

        return app($validator);
    }

    /**
     * @param  string $middleware
     * @param  bool   $isAjax
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function failedResponse($middleware, $isAjax = false)
    {
        if ($isAjax) {
            return $this->response->make($this->getErrorMessage($middleware), 403);
        }

        return $this->redirector
            ->back()
            ->exceptInput('_guard_pot', '_guard_opened')
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
