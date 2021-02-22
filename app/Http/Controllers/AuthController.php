<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    //

    public function oauth(){
        return Socialite::driver('azure')->redirect();
    }

    public function callback(){
        $oauth = Socialite::driver('azure')->user();

        //dd($oauth);

        if(User::where('email', $oauth->email)->count() == 1){

            $user = User::where('email', $oauth->email)->first();
            $user->name = $oauth->name;
            $user->accessToken = $oauth->accessTokenResponseBody['access_token'];
            $user->refreshToken = $oauth->accessTokenResponseBody['refresh_token'];
            $user->tokenExpires = Carbon::createFromTimestamp($oauth->accessTokenResponseBody['expires_on'], 'Europe/Budapest')->toDateTimeString();

            $user->save();

            Auth::loginUsingId($user->id);

            echo Auth::user()->name;
        }
        else abort(403);
    }
}
