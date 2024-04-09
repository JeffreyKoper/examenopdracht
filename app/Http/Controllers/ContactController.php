<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();

        $contact = new contact();
        $contact->user_id = $user->id;
        $contact->title = $request->title;
        $contact->description = $request->description;

        $contact->save();

        return redirect()->route('dashboard');
    }
}
