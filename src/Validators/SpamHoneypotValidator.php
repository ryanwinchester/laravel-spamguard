<?php

namespace Fungku\SpamGuard\Validators;

class SpamHoneypotValidator extends Validator
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
        return !$request->has('_guard_pot') || empty($request->get('_guard_pot'));
    }
}
