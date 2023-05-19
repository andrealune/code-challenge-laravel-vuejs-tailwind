<?php

namespace App\Http\Controllers;

use App\Models\{Contact, User};
use Illuminate\Http\{Request, RedirectResponse};
use App\Services\{ContactService};
use App\Http\Requests\{StoreContactRequest, UpdateContactRequest};

class ContactController extends Controller
{
    /**
     * ContactController Constructor
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->contactService->all();

        return view('dashboard',[
            "responses" => $response
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $storeContactRequest)
    {
        $this->contactService->store();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $response = $this->contactService->getById($id);
        return view('contact.edit',[
            "response" => $response
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $updateContactRequest, string $id)
    {
        $this->contactService->update($id);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $this->contactService->delete($id);

        return \redirect()->route('dashboard');
    }
}
