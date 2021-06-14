<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index (Request $request){

        return view('auth.login');
    }

    public function store (Request $request){

        //**  valid login information  */
        $this->validate($request ,
            [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);

        //** check a user . */
        if (!auth()->attempt([
            'email' => $request->email ,
            'password' => $request->password
        ])) {
            return back()->with('status' , 'Invalid login details');
        }
        return redirect()->route('dashboard');

    }

    public function edit (){
        $profile=Auth()->user();
        return view('auth.update_user_information' , [ 'profile' => $profile]);
    }

    public function update (Request $request){

        //**  valid user information  */
        $this->validate($request ,
            [
                'name' => 'required|max:255' ,
                'username' => 'required|max:255' ,
                'email' => 'required|email|max:255',
            ]);

        //** update information user */
        $status=Auth()->user()->fill($request->all())->save();

        if($status){
            return redirect()->route('dashboard')->with('success' , 'User successfully updated');

        }
        else{
            return redirect()->route('dashboard')->with('error' , 'Error occurred while updating User');
        }
    }
}
