<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function create()
    {
        return view('contacts.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required'
        ]);

        $attributes = $request->merge(['user_id' => auth()->id()])->all();

        Contact::create($attributes);

        return redirect('/dashboard')->with('success', 'Le contact a été créé avec succès');
    }
}
