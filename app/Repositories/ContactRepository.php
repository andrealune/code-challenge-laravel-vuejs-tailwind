<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAllContact() : Collection
    {
        return Contact::all();
    }

    public function getContactById($id) : ?Contact
    {
        return Contact::findOrFail($id);
    }

    public function createContact(array $data) : Contact
    {
        return Contact::create($data);
    }

    public function updateContact($id, array $data) : ?Contact
    {   
        $contact = Contact::find($id);
        if(!$contact) return null;
        $contact->update($data);
        return $contact;
    }


    public function deleteContact($id) : bool
    {
        $contact = Contact::find($id);
        if (!$contact) return false;
        
        $contact->delete();

        return true;
    }
}
