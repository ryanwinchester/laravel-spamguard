<?php

namespace Fungku\SpamGuard\Validators;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\DecryptException;

class SpamTimerValidator extends Validator
{
    /**
     * Validate the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $params
     * @return bool
     */
    public function validate($request, $params = [])
    {
        try {
            $timeOpened = $this->encrypter->decrypt($request->get('_guard_opened'));
        } catch (DecryptException $e) {
            return false;
        }

        $timeNow = time();
        $timeElapsed = $timeNow - $timeOpened;

        if (! is_numeric($timeOpened) || strtotime($timeOpened) === false) {
            return false;
        }

        $minTime = $this->getMinTime($params);
        $maxTime = $this->getMaxTime($params);

        $tooFast = $timeElapsed < $minTime;
        $tooSlow = $timeElapsed > $maxTime;

        return  !$tooFast && !$tooSlow;
    }

    /**
     * Get the min time to use.
     *
     * @param array $params
     * @return int
     */
    private function getMinTime($params = [])
    {
        if (isset($params['min_time'])) {
            return $params['min_time'];
        }

        return $this->config->get('spamguard.default_min_time', Config::DEFAULT_MIN_TIME);
    }

    /**
     * Get the max time to use.
     *
     * @param array $params
     * @return int
     */
    private function getMaxTime($params = [])
    {
        if (isset($params['max_time'])) {
            return $params['max_time'];
        }

        return $this->config->get('spamguard.default_max_time', Config::DEFAULT_MAX_TIME);
    }
}
