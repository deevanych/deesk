<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        try {
            Auth::user()->token()->revoke();
            return ['status' => true];
        } catch (\Exception $e) {
            return ['status' => false];
        }
    }
}
