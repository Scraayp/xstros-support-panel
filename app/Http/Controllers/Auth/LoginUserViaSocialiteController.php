<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginUserViaSocialiteController extends Controller
{
    public function create($provider)
    {
        // Redirect the user to the Google/Microsoft login page
        return Socialite::driver($provider)->redirect();
    }

    public function store($provider)
{
    $socialiteUser = Socialite::driver($provider)->user();

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
    }

    // Update the specific OAuth provider ID
    $user->update([
        "oauth_{$provider}_id" => $socialiteUser->getId(),
    ]);

    Auth::login($user);

    return redirect(route('dashboard'));
}

}