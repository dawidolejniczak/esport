<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;

use App\Services\SocialAccountService;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * @return mixed
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * @param SocialAccountService $service
     * @return RedirectResponse
     */
    public function callback(SocialAccountService $service): RedirectResponse
    {

        /** @var Authenticatable $user */
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/');
    }
}
