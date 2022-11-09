<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\EmailVerificationServices;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller implements EmailVerificationServices
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return 'success'; // <-- change this to whatever you want
    }
}
