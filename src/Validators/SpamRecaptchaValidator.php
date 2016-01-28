<?php

namespace Fungku\SpamGuard\Validators;

use ReCaptcha\ReCaptcha;

class SpamRecaptchaValidator extends Validator
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
        $recaptcha = new ReCaptcha($this->config->getRecaptchaSecret());

        $response = $recaptcha->verify(
            $request->get('g-recaptcha-response'),
            $this->getIPFromRequest($request)
        );

        return $response->isSuccess();
    }

    /**
     * Get the client's IP address.
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    private function getIPFromRequest($request)
    {
        return $request->server('HTTP_X_FORWARDED_FOR')
            ?: $request->server('REMOTE_ADDR');
    }
}
