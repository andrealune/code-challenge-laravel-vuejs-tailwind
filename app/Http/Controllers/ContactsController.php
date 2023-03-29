<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contacts;
use App\Services\ContactListService;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(Request $request, ContactListService $service)
    {
        return $service->paginate($request);
    }

    public function store(ContactRequest $request, ContactService $service)
    {
        $contact = $service->create($request);
        return $this->success([
            'message' => 'Contact created.',
            'contact' => new ContactResource($contact)
        ]);
    }

    public function show(Contacts $contact) : ContactResource
    {
        return new ContactResource($contact);
    }

    public function update(ContactRequest $request, Contacts $contact, ContactService $service)
    {
        $service->update($contact, $request);

        return $this->success(['message' => 'Contact updated.']);
    }

    public function destroy(Contacts $contact, ContactService $service)
    {
        $service->delete($contact);

        return $this->success(['message' => 'Contact deleted.']);
    }
}
