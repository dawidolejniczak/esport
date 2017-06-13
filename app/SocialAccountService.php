<?php

namespace App;

use Carbon\Carbon;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Image;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user)
            {
                $timestamp =  date('YmdHis');
                $image = $providerUser->getAvatar();
                $fileName = $providerUser->getName() . $timestamp. '.' . 'png';
                $location = public_path('uploads\\' . $fileName);
                Image::make($image)->fit(config('image.small_size'))->save($location);

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'image' => $fileName
                ]);

                $user->assignRole('user');
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}