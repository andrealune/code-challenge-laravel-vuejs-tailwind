<?php

namespace App\Interfaces;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{
    public function getAllContact() : Collection;
    public function getContactById($id) : ?Contact;
    public function createContact(array $data) : Contact;
    public function updateContact($id, array $data) : ?Contact;
    public function deleteContact($id) : bool;

}