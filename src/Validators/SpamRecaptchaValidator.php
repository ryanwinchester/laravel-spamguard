<?php

namespace Fungku\SpamGuard\Validators;

use ReCaptcha\ReCaptcha;

class SpamRecaptchaValidator extends Validator
{
    /**
     * @var \ReCaptcha\ReCaptcha
     */
    protected $recaptcha;

    /**
     * @param ReCaptcha $recaptcha
     */
    public function __construct(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
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
        $response = $this->recaptcha->verify(
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
