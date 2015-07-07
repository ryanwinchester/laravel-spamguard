<?php

namespace Fungku\SpamGuard\Validators;

use Illuminate\Contracts\Encryption\DecryptException;

class SpamTimerValidator extends Validator
{
    /**
     * @var array
     */
    protected $params;

    /**
     * Validate the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $params
     * @return bool
     */
    public function validate($request, $params = [])
    {
        $this->params = $params;

        try {
            $timeOpened = $this->encrypter->decrypt($request->get('_guard_opened'));
        } catch (DecryptException $e) {
            return false;
        }

        if (! is_numeric($timeOpened)) {
            return false;
        }

        $timeElapsed = time() - $timeOpened;

        $tooFast = $timeElapsed < $this->getMinTime();
        $tooSlow = $timeElapsed > $this->getMaxTime();

        return  !$tooFast && !$tooSlow;
    }

    /**
     * Get the min time to use.
     *
     * @return int
     */
    private function getMinTime()
    {
        if (isset($this->params['min_time'])) {
            return $this->params['min_time'];
        }

        return $this->config->getDefaultMinTime();
    }

    /**
     * Get the max time to use.
     *
     * @return int
     */
    private function getMaxTime()
    {
        if (isset($this->params['max_time'])) {
            return $this->params['max_time'];
        }

        return $this->config->getDefaultMaxTime();
    }
}
