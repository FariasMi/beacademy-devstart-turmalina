<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller {
    protected $address;
    protected $user;

    public function __construct(Address $address, User $user) {
        $this->address = $address;
        $this->user = $user;
    }

    public function create($id) {
        return view('add-address', compact('id'));
    }

    public function store(Request $request, $id) {
        if (!Auth::user()->is_admin && Auth::user()->id != $id) {
            abort(404);
        }

        $data = $request->all();
        $data['user_id'] = $id;
        $user = $this->user->find($id);

        $this->address->create($data);

        return redirect()->route('user.show', $user->id);
    }
}
