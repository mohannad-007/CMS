<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\RespondsWithStatus;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use RespondsWithStatus;

    public function getMyProfile(){
        $profile = User::get();
        return $this->successResponse($profile, 'Profile fetched successfully');
    }
}

