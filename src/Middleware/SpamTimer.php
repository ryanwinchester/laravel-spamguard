<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;

class SpamTimer extends Middleware
{
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
        $validator = $this->makeValidator('spam_timer');

        $params = [
            'min_time' => $minTime,
            'max_time' => $maxTime,
        ];

        if (! $validator->validate($request, $params)) {
            return $this->failedResponse('spam_timer');
        }

        return $next($request);
    }
}
