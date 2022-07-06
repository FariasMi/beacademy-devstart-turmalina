<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class UserController extends Controller {
    public function __construct(User $user) {
        $this->model = $user;
    }

    public function index() {
        return view('index');
    }

    public function dashboard() {
        $users = User::all();

        return view('adminDashboard', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('userEdit', compact('user'));
    }

    public function create() {
        return view('userCreate');
    }

    public function update(StoreUpdateUserFormRequest $request, $id) {
        $user = User::find($id);
        $data = $request->except("password", "password_confirmation");

        if ($request->has("password")) {
            $data['password'] = bcrypt($request->password);
            $data['password_confirmation'] = bcrypt($request->password_confirmation);
        }

        $user->update($data);

        return redirect()->route('dashboard');
    }

    public function delete($id) {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('dashboard');
    }
}
