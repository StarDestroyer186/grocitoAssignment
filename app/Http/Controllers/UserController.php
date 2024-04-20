<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|max:13', // to accomodate +91 in the input
            'password' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ];

        if(User::where('phone',$request->phone)->exists())
        {
            return redirect('login')->with('error', 'An Account with same phone number already exists.');
        }
        else
        {
            $user = User::create($data);
            return redirect('login')->with('success', 'Your Account Has Been Created Successfully!');
        }
    }

    public function authenticate(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->password;

        $user = User::where('phone',$phone)->first();

        if($user && Hash::check($password, $user->password)){

            Cache::put('phone',$phone);
            Cache::put('password',$password);
            Cache::put('user_id',$user->id);

            $randomNumber = random_int(100000, 999999);
            Otp::where('user_id',$user->id)->delete();

            $otp = new Otp(['otp' => $randomNumber]);
            $user->otp()->save($otp);

            echo '<script>console.log("OTP: ' . $randomNumber . '");</script>';

            return redirect('verify')->with('success', 'Enter OTP available in console to verify')->with('otp', $randomNumber);;
        }else{
            return redirect('login')->with('error','Incorrect phone or password');
        }
    }

    public function verify(Request $request)
    {
        $otp = $request->input('otp');
        $val = Otp::where('otp',$otp)->first();
        if($val){
            $phone = Cache::get('phone');
            $password = Cache::get('password');

            if(Auth::attempt(['phone' => $phone, 'password' => $password])){
                Cache::forget('phone');
                Cache::forget('password');

                Auth::login(Auth::user());

                return redirect('dashboard')->with('login-successful','Login successful and the OTP Generated is in console.');
            }else{
                return redirect('login')->with('error','Login failed due to some reason.');
            }
        }else{
            return redirect('verify')->with('error','OTP is invalid.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect to login page after logout
    }
}
