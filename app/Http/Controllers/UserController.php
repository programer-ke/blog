<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller // Ensure it extends the base Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['register', 'login']);
        $this->middleware('auth')->only('logout');
    }

    public function register(Request $request){
        $incommingFields = $request->validate([
            'name' => ['required','max:255', Rule::unique('users','name')],
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'password' => ['required','min:8']
        ]);

        $incommingFields['password'] = bcrypt($incommingFields['password']);
        $user = User::create($incommingFields);

        auth()->login($user);

        return redirect ('/');
    }

    public function login(Request $request){
        $incommingFields = $request->validate([
            'loginname'=> ['required'],
            'loginpassword'=> ['required']
        ]);

        if (auth()->attempt(['name' => $incommingFields['loginname'], 'password' => $incommingFields['loginpassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }

    public function logout(Request $request) {
        auth()->logout();

        return redirect('/');
    }
}