<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function __construct(User $user) {
        $this->model = $user;
    }

    public function index() {
        return view('index');
    }

    public function show($id) {
        if (!$user = $this->model->find($id)) {
            abort(404);
        }

        $addresses = $user->addresses()->get();

        return view('show-user', compact('user', 'addresses'));
    }

    public function dashboard(Request $request) {

        $users = $this->model->getUsers(
            $request->search ?? ""
        );

        return view('admin.dashboard', compact('users'));
    }

    public function edit($id) {
        $user = User::find($id);
        return view('user-edit', compact('user'));
    }

    public function create() {
        return view('admin.create');
    }

    public function update(StoreUpdateUserFormRequest $request, $id) {
        $user = User::find($id);
        $data = $request->except("password", "password_confirmation");
        $data['is_admin'] = $request->type_user == 'admin' ? true : false;

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
