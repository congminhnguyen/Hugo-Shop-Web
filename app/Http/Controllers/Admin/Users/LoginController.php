<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.users.login');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ], 
                $request->input('remember')
        )){
            return redirect()->route('admin');
        }
        return back()->withErrors([
            'message' => 'Incorrect username or password.'
        ]);
    }
}
