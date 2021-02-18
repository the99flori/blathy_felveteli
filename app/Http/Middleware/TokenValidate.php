<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && ($user = Auth::user())->tokenExpires <= time() + 300) {
            // Check User and Token is expired (or very close to it /5 min/)

            $client = new GuzzleHttp\Client();
            try{
                $json = $client->request('POST', 'https://login.microsoftonline.com/common/oauth2/token', [
                    'form_params' => [
                        'grant_type' => 'refresh_token',
                        'client_id' => config('services.azure.client_id'),
                        'client_secret' => config('services.azure.client_secret'),
                        'refresh_token' => $user->refreshToken,
                    ]
                ]);

                if ($json->getStatusCode() != 200) throw new Exception;

                $response = json_decode($json->getBody(), true);

                // Store the new values
                $user->accessToken = $response['access_token'];
                $user->refreshToken = $response['refresh_token'];
                $user->tokenExpires = Carbon::createFromTimestamp($response['expires_on'], 'Europe/Budapest')->toDateTimeString();

                $user->save();

            }

            catch(Exception $e) {
                Auth::logout();
            }
        }

        return $next($request);
    }
}
