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
            $request->server('REMOTE_ADDR')
        );

        if (! $response->isSuccess()) {
            return false;
        }

        return true;
    }
}
