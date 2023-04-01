<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verifyIsAdmin'], ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contacts = Contact::all();
            return $this->sendSuccessResponse($contacts, 'List contacts successfully.');
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        try {
            $contact = Contact::create($request->validated());
            return $this->sendSuccessResponse($contact, 'Contact created successfully.');
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        try {
            $contact->update($request->validated());
            return $this->sendSuccessResponse($contact->fresh(), 'Contact updated successfully.');
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
            return $this->sendSuccessResponse([], 'Contact deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }
}
