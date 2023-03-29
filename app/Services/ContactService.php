<?php

namespace App\Services;

use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactService
{
    public function create(Request $request) : Contacts
    {
        return Contacts::forceCreate($this->formatParams($request));
    }

    private function formatParams(Request $request, ?Contacts $contact = null) : array
    {
        $formatted = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        return $formatted;
    }

    public function update(Contacts $contact, Request $request) : void
    {
        $contact->forceFill($this->formatParams($request, $contact))->save();
    }

    public function delete(Contacts $contact) : void
    {
        $contact->delete();
    }
}
