<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user){

        return view('user.edit', compact('user'));

    }

    public function update(Request $request, User $user){
        $data = request()->validate([
            'type' => 'required',
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => 'required',
            'password_confirm' => ['same:new_password'],
            
        ]);
        
        // dd($data);

        // $confirm = User::find(auth()->user()->id)->update(['password' =>Hash::make(Input::get('new_password'))]);        

        auth()->user()->update(array_merge(
            $data,
             ['password' =>Hash::make($request->new_password)],
        ));


        return redirect("/profile/{$user->id}");
    }


}
