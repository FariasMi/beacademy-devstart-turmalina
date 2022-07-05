<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\User;


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
}
