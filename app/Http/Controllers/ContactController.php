<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContactRequest;
use App\Http\Requests\EditContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddContactRequest $request)
    {
        try {
            Contact::create(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]
            );

        } catch (\Exception $exception) {
            flash()->addError('Something Went Wrong. Please Try Again.');
            return back();
        }
        flash()->addSucess('Contact Added Successfully!!');
        return redirect()->route('contact.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $contact = Contact::findorfail($id);
        return view('contact.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditContactRequest $request, $id)
    {
        try {
            Contact::find($id)->update(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                ]
            );

        } catch (\Exception $exception) {
            flash()->addError('Something Went Wrong. Please Try Again.');
            return back();
        }
        flash()->addSucess('Contact Updated Successfully!!');
        return redirect()->route('contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contact $contact
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->middleware('admin');
        try {
            Contact::destroy($id);

        } catch (\Exception $exception) {
            flash()->addError('Something Went Wrong. Please Try Again.');
            return back();
        }
        flash()->addSuccess('Contact Deleted Successfully!!.');
        return back();

    }
}
