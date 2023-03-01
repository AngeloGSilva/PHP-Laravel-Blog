<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store()
    {
        //debug
        //var_dump(request()->all());
        //return request()->all();

        $attributes = request()->validate([
            'name' => 'required|max:255|min:2',
            'username' => 'required|max:255|min:4|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|max:255|min:8'
            //ou assim
            //'password' => ['required', 'min:7', 'max:255']
            //'name' => ['required', 'min:7', 'max:255', Rule::unique('users','username')]->ignore(etc para ignorar um user tp ele msm),
        ]);

        //$attributes['password'] = bcrypt($attributes['password']);



        $user = User::create($attributes);

        auth()->login($user);


        //mensagem de feedback
        //session()->flash('success','Your account has been created.');
        //mensagem de feedback
        return redirect('/')->with('success','Your account has been created.');

    }
}
