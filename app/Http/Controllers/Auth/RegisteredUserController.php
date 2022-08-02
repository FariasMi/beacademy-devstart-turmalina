<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller {
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        // Remove caracteres que não sejam números
        $request->merge([
            'phone' => preg_replace("/\D/", '', $request->phone),
        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => "required|string|max:255",
            'cpf' => "required|cpf|unique:users",
            'phone' => "required|phone_br_ddd|unique:users",
            'date_of_birth' => "required|date",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'is_admin' => $request->type_user == 'admin' ? true : false,
            'password' => Hash::make($request->password),
        ]);


        event(new Registered($user));

        if (!Auth::check()) {
            Auth::login($user);
        }else if (Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('success', 'Usuário cadastrado com sucesso!');
        }

        // return $request;
        return redirect(RouteServiceProvider::HOME);
    }
}