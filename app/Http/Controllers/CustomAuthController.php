<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:login,0.5'
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('user-dashboard'))
                        ->withSuccess('Signed in');
        }
  
        return redirect()->route("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function registrationPost(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|recaptchav3:signup,0.5'
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
        $user->assignRole('Registered');
        
        \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\RegistrationConfirm($user));
        \Illuminate\Support\Facades\Session::flash("success","You are registered now, please login") ;
        return redirect()->route("login");
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    
    

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
