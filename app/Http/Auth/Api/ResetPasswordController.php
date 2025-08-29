<?php

namespace App\Http\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
   use ResetsPasswords;
}
