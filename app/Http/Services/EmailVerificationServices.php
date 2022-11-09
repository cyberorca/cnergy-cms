<?php

namespace App\Http\Services;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Interface EmailVerificationServices
{
    public function verify(EmailVerificationRequest $request);
}