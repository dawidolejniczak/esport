<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {

        /** @var Authenticatable $user */
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/');
    }
}
