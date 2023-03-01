<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function destroy(){
        //dd('saiu');

        //dar logout do utilizador
        auth()->logout();

        return redirect('/')->with('success','Goodbye');
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function login()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($attributes)){

            //para seguranca... para assegurar que nao ha roubo de sessao
            session()->regenerate();

            //redirect normal
            return redirect('/')->with('success','Welcome');
        }


        //muito semelhante ao de baixo.. mas nao esta a dar e nao sei pq
        // throw ValidationException::withMessages([
        //     'email' => 'Your provided credentials could not be verified.'
        // ]);

        //auth falhou
        return back()
            ->withInput()
            ->withErrors(['email' => 'Your provided credentials could not be verified.']);

    }
}
