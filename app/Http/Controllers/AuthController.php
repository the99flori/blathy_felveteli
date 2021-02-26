<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\App;
use App\Http\Requests\LocalLoginRequest;

class AuthController extends Controller
{

    public function login(){
        return view('auth.login');
    }

    public function loginPost(LocalLoginRequest $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active_local'=>true], true)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login.local')->withErrors(['account'=>'Nincs engedélyezett felhasználó a megadott paraméterekkel']);

    }

    //

    public function oauth(){
        return Socialite::driver('azure')->redirect();
    }

    public function callback(){
        $oauth = Socialite::driver('azure')->stateless()->user();

        //dd($oauth);

        if(User::where('email', $oauth->email)->count() == 1){

            $user = User::where('email', $oauth->email)->first();
            $user->name = $oauth->name;
            $user->accessToken = $oauth->accessTokenResponseBody['access_token'];
            $user->refreshToken = $oauth->accessTokenResponseBody['refresh_token'];
            $user->tokenExpires = Carbon::createFromTimestamp($oauth->accessTokenResponseBody['expires_on'], 'Europe/Budapest')->toDateTimeString();

            $user->save();

            Auth::loginUsingId($user->id);

            return redirect('/');
        }
        else abort(403);
    }
}
