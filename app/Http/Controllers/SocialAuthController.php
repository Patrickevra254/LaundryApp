<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class SocialAuthController extends Controller
{
    // Redirect to Provider
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback from Provider
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            // Check if user exists
            $user = User::where('email', $socialUser->getEmail())->first();

            // If not exist create new
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?? 'No Name',
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(uniqid()), // random password
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('admin');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed, please try again.');
        }
    }
}
