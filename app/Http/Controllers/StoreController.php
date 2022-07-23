<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreController extends Controller {
    public function index($section) {
        if ($section === 'papelaria'){
            // Condição
        } else if ($section === 'cadernos'){
            // Condição
        } else if ($section === 'escrita'){
            // Condição
        } else if ($section === 'outros'){
            // Condição
        } else {
            // Condição
            abort(404);
        }
        return view('store', compact('section'));
    }
}
