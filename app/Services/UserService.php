<?php

namespace App\Services;

use Illuminate\Http\Request;
use Image;

class UserService
{
    /**
     * @param Request $request
     * @return null|string
     */
    public function storeImage(Request $request): ?string
    {
        if ($request->image) {
            $timestamp = date('YmdHis');
            $image = $request->file('image');
            $fileName = $request->name . $timestamp . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads\\' . $fileName);
            Image::make($image)->fit(config(config('image.small_size')))->save($location);
        } else {
            $fileName = NULL;
        }

        return $fileName;
    }
}