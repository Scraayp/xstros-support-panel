<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Str;

class TwoFactorAuthController extends Controller
{
    /**
     * Show the 2FA setup page
     */
    public function index()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        
        // Generate a new secret key if the user doesn't have one
        if (!$user->google2fa_secret) {
            $secretKey = $google2fa->generateSecretKey();
            
            // Store the secret key temporarily in the session
            session(['2fa_secret' => $secretKey]);
            
            // Generate the QR code URL
            $qrCodeUrl = $google2fa->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $secretKey
            );
            
            return view('profile.two-factor-auth', compact('qrCodeUrl'));
        }
        
        return view('profile.two-factor-auth');
    }
    
    /**
     * Verify and enable 2FA
     */
    public function verify(Request $request)
    {
        $request->validate([
            '2fa_code' => 'required|numeric|digits:6',
        ]);

        $google2fa = new Google2FA();
        $user = Auth::user();
        $secretKey = session('2fa_secret');
        
        // Verify the 2FA code entered by the user
        $valid = $google2fa->verifyKey($secretKey, $request->input('2fa_code'));

        if ($valid) {
            // Save the secret key to the user's record
            $user->google2fa_secret = $secretKey;
            
            // Generate recovery codes
            $recoveryCodes = $this->generateRecoveryCodes();
            $user->recovery_codes = json_encode($recoveryCodes);
            
            $user->save();
            
            // Clear the temporary secret from session
            session()->forget('2fa_secret');
            
            // Flash recovery codes to the session for display
            session()->flash('recovery_codes', $recoveryCodes);
            
            return redirect()->route('profile.2fa')->with('status', 'Two-factor authentication has been enabled.');
        } else {
            return redirect()->back()->withErrors([
                'enableTwoFactor' => 'Invalid verification code. Please try again.',
            ]);
        }
    }
    
    /**
     * Disable 2FA
     */
    public function disable()
    {
        $user = Auth::user();
        $user->google2fa_secret = null;
        $user->recovery_codes = null;
        $user->save();
        
        return redirect()->route('profile.2fa')->with('status', 'Two-factor authentication has been disabled.');
    }
    
    /**
     * Regenerate recovery codes
     */
    public function regenerateRecoveryCodes()
    {
        $user = Auth::user();
        
        // Generate new recovery codes
        $recoveryCodes = $this->generateRecoveryCodes();
        $user->recovery_codes = json_encode($recoveryCodes);
        $user->save();
        
        // Flash recovery codes to the session for display
        session()->flash('recovery_codes', $recoveryCodes);
        
        return redirect()->route('profile.2fa')->with('status', 'Recovery codes have been regenerated.');
    }
    
    /**
     * Generate recovery codes
     */
    private function generateRecoveryCodes($count = 8)
    {
        $recoveryCodes = [];
        
        for ($i = 0; $i < $count; $i++) {
            $recoveryCodes[] = Str::random(10);
        }
        
        return $recoveryCodes;
    }
}

