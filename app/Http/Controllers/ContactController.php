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
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home');
        }
        $contacts = contact::where('admin_reply', '=', NULL)->get();
        return view('contact.admin', ['contacts' => $contacts]);
    }

    public function showAdminReply($id)
    {
        $data = contact::find($id);
        return view('contact.adminReply', ['info' => $data]);
    }

    public function showReply($id)
    {
        $data = contact::find($id);
        return view('contact.replied', ['info' => $data]);
    }

    public function updateAdminReply(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to perform this action.');
        }

        $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $contact = Contact::find($id);
        if (!$contact) {
            return redirect()->route('contact.admin')->with('error', 'Contact not found');
        }

        $contact->admin_reply = $request->admin_reply;
        $contact->save();

        return redirect()->route('contact.admin')->with('success', 'Admin reply updated successfully');
    }
}
