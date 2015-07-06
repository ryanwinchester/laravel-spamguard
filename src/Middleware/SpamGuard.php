<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;
use Fungku\SpamGuard\Config;
use Illuminate\Routing\Redirector;

class SpamGuard
{
    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @param Redirector $redirector
     */
    public function __construct(Redirector $redirector)
    {
        $this->redirector = $redirector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Fungku\SpamGuard\Exceptions\SpamException
     */
    public function handle($request, Closure $next)
    {
        $validators = $this->makeValidators();

        foreach ($validators as $validator) {
            if (! $validator->validate($request)) {
                return $this->redirector
                    ->back()
                    ->withInput()
                    ->withError("You're looking a little spammy");
            }
        }

        return $next($request);
    }

    /**
     * Get all the validators.
     *
     * @return array
     */
    private function makeValidators()
    {
        $validators = [];

        foreach (Config::$elements as $element) {
            $validator = '\\Fungku\\SpamGuard\\Validators\\' . camel_case($element) . 'Validator';
            $validators[] = app($validator);
        }

        return $validators;
    }
}
