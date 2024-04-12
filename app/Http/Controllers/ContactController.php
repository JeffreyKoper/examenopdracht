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
    public function showAdmin()
    {
        $contacts = contact::where('admin_reply', '=', NULL)->get();
        return view('contact.admin', ['contacts' => $contacts]);
    }
    public function showInfo($id)
    {
        $data = contact::find($id);
        return view('contact.info', ['info' => $data]);
    }
}
