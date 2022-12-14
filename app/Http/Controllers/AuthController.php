<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.verify-email', ['title' => 'Verify Email']);
    }
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return view('auth.verify-email-success', ['title' => 'Verify Email Success']);
    }
    public function resend_token(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
