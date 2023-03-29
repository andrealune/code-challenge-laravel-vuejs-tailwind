<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Http\Requests\ContactRequest;
use App\Notifications\NewContactNotification;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->all());

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            // TODO Uncomment the blow line to send notification. Make sure you setup environment in .env
            // $admin->notify(new NewContactNotification());
        }
        return response()->json($contact, 201);
    }

    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $contact->update($request->all());

        return response()->json($contact);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();

        return response()->json($contact);
    }
}
