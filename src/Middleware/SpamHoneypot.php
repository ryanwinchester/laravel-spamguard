<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;
use Fungku\SpamGuard\Exceptions\SpamException;
use Fungku\SpamGuard\Validators\SpamHoneypotValidator;
use Illuminate\Routing\Redirector;

class SpamHoneypot
{
    /**
     * @var SpamHoneypotValidator
     */
    protected $validator;

    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @param Redirector $redirector
     * @param SpamHoneypotValidator $validator
     */
    public function __construct(Redirector $redirector, SpamHoneypotValidator $validator)
    {
        $this->validator = $validator;
        $this->redirector = $redirector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws SpamException
     */
    public function handle($request, Closure $next)
    {
        if (! $this->validator->validate($request)) {
            return $this->redirector
                ->back()
                ->withInput()
                ->withError("You're looking a little spammy");
        }

        return $next($request);
    }
}
