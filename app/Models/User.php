<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Socialite\Facades\Socialite;
use PragmaRX\Google2FA\Google2FA;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'oauth_github_id',
        'oauth_discord_id',
        'avatar'
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function Staff($query)
    {
        return $query->where('role', 'Staff');
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isConnectedTo($provider)
    {
        return !is_null($this->{"oauth_{$provider}_id"});
    }


    public function enable2fa(Request $request)
    {
        $google2fa = new Google2FA();
        $user = Auth::user();

        // Generate a new secret key for the user
        $secret = $google2fa->generateSecretKey();

        // Store the secret key in the database
        $user->google2fa_secret = $secret;
        $user->save();

        // Generate a QR code that the user can scan with their Google Authenticator app
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'MyApp',  // Your app name
            $user->email, // The user's email (or any other unique identifier)
            $secret
        );

        return view('auth.2fa', compact('qrCodeUrl'));
    }
}
