<?php

namespace App\Http\Controllers\Services\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function authRedirect () {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function authHandler () {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                $user->update([
                    'password' => bcrypt($googleUser->token),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt($googleUser->token),
                ]);
            }
            Auth::login($user);
            // cookie('__apiToken', $user->createToken('auth_token')->plainTextToken);
            return redirect('dashboard');
        }catch (\Exception $e){
            return abort(500);
        }
    }
}
