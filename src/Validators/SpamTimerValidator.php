<?php

namespace Fungku\SpamGuard\Validators;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;

class SpamTimerValidator extends Validator
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @var array
     */
    protected $params;

    /**
     * @param Config $config
     * @param Encrypter $encrypter
     */
    public function __construct(Config $config, Encrypter $encrypter)
    {
        $this->config = $config;
        $this->encrypter = $encrypter;
    }

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
