<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;
use Fungku\SpamGuard\Validators\SpamTimerValidator;
use Illuminate\Routing\Redirector;

class SpamTimer
{
    /**
     * @var Redirector
     */
    protected $redirector;

    /**
     * @var SpamTimerValidator
     */
    protected $validator;

    /**
     * @param Redirector $redirector
     * @param SpamTimerValidator $validator
     */
    public function __construct(Redirector $redirector, SpamTimerValidator $validator)
    {
        $this->validator = $validator;
        $this->redirector = $redirector;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  int $minTime
     * @param  int $maxTime
     * @return mixed
     */
    public function handle($request, Closure $next, $minTime = 0, $maxTime = 0) {
        $params = [
            'min_time' => $minTime,
            'max_time' => $maxTime,
        ];

        if ($this->validator->validate($request, $params)) {
            return $next($request);
        }

        return $this->redirector
            ->back()
            ->withInput()
            ->withError("You're looking a little spammy");
    }
}
