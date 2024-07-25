<?php

namespace App\Http\Controllers;

use App\Models\Lieu;
use App\Models\Sport;
use App\Models\Spectateur;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function register(Request $request) {
        $data=$request->validate([
            'nom' => 'required|string|max:30',
            'prenom' => 'required|string|max:30',
            'email' => 'required|email',
            'password' => 'required|string|max:60'
        ]);
        $users = User::all();
        foreach ($users as $user) {
            if ($user->email == $request->email) {
                return back()->withErrors([
                    'email' => 'Cet email est déjà utilisé.',
                ]);
            }
        }
        $user = User::create($data);

        return redirect()->intended(route('/user/main'))->with('success', 'L\'utilisateur a bien été créé.');
    }

    public function login(Request $request){
        $data=$request->validate([
            'email' => 'required|email',
            'password' => 'required|string|max:60'
        ]);
        if (auth()->attempt(['email'=>$data['email'],'password'=>$data['password']]))
            $request->session()->regenerate();
        return redirect()->intended(route('/user/main'))->with('success', 'Connexion établie');
    }

    public function logout(){
        auth()->logout();
        return redirect()->intended(route('/user/main'))->with('success', 'Déconnexion établie');
    }
}


