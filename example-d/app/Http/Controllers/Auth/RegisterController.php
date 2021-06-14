<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct (){

        $this->middleware(['guest']);
    }


    public function index (){
        return view('auth.register');
    }


    public function store (Request $request){

        //**  valid registration */
        $this->validate($request ,
            [
                'name' => 'required|max:255' ,
                'username' => 'required|max:255' ,
                'email' => 'required|email|max:255',
                'password' => 'required|confirmed',
            ]);

        //** Create a new user instance after a valid registration. */
        User::create([
            'name' => $request->name ,
            'username' => $request->username ,
            'email' => $request->email ,
            'password' => Hash:: make($request->password)
        ]);


        //** login a after a create new user  */
        auth()->attempt([
            'email' => $request->email ,
            'password' => $request->password
        ]);

        //** redirect to dashboard after login */
        return redirect()->route('dashboard');

    }


}
