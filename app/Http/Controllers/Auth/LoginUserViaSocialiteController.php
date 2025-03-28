<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginUserViaSocialiteController extends Controller
{
    public function create($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function store(Request $request, $provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();

        // Check if user is already authenticated (JWT)
        if (Auth::check()) {
            $user = Auth::user();
            $user->update([
                "oauth_{$provider}_id" => $socialiteUser->getId(),
            ]);

            return redirect()->route('profile.edit')->with('status', 'oath-connection');
        }

        // Check if the user exists (by email or provider ID)
        $user = User::where('email', $socialiteUser->getEmail())
                    ->orWhere("oauth_{$provider}_id", $socialiteUser->getId())
                    ->first();

        if (!$user) {
            $user = User::create([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'password' => bcrypt($socialiteUser->getName() . $socialiteUser->getId()),
                "oauth_{$provider}_id" => $socialiteUser->getId(),
                'avatar' => $socialiteUser->getAvatar(),
            ]);
        } else {
            $user->update([
                "oauth_{$provider}_id" => $socialiteUser->getId(),
            ]);
        }
        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
