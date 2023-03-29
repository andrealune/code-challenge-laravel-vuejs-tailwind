<?php

namespace App\Services;

use App\Http\Resources\ContactCollection;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactListService
{

    public function paginate(Request $request) : ContactCollection
    {
        return new ContactCollection(Contacts::query()
            ->orderBy('created_at', 'desc')
            ->paginate(20, ['*'], 'current_page'));
    }
}
