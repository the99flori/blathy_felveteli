<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class AuthController extends Controller
{
    //

    public function oauth(){
        return Socialite::driver('azure')->redirect();
    }

    public function callback(){
        $oauth = Socialite::driver('azure')->user();

        echo $oauth->getName();
        echo $oauth->getId();
        echo $oauth->getEmail();
        echo time();
        dd(Carbon::createFromTimestamp($oauth->accessTokenResponseBody['expires_on'], 'Europe/Budapest')->toDateTimeString());


        /*if(User::where('email', $oauth->getEmail())->count() == 1){

            $user = User::where('email', $oauth->getEmail())->first();
            if($user->name == ""){
                $user->name = $ouath->getName();
                $user->accessToken = $oauth->getToken();
                $user->refreshToken = $oauth->getRefreshToken();
                $user->tokenExpires = $oauth->getExpires();
            }
            $user->token = $ouath->user['token'];
            $user->save();
        }*/
    }
}
