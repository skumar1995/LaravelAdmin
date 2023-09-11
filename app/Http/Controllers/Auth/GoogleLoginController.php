<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
        
    public function callback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if ( $finduser ) {
       
                Auth::login($finduser);
      
                return redirect()->intended('/dashboard');
       
            } else {

                $checkUser = User::where('email', $user->email)->first();
                if ($checkUser) {
                    // The email address is already in the database.
                    return redirect()->route('login')->withErrors(['email' => 'The email address is already in use.',])->onlyInput('email');
                  }else{

                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id'=> $user->id,
                        'password' => 'dummypass'
                    ]);
          
                    Auth::login($newUser);
          
                    return redirect()->intended('/dashboard');
                  }
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
