<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactsController extends Controller
{
	// list all contacts
    public function index()
    {
    	$contactsData = Contacts::paginate(10);
    	return view('contacts.index', compact('contactsData'));
    }

    //create contact form
    public function create() {
        return view('contacts.create');
    }

    //store contact data
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        
        Contacts::create($request->post());

        return redirect()->route('index')->with('success','Contact created successfully.');
    }

	//update contact form
    public function edit($id) {
    	$contact = Contacts::find($id);
        return view('contacts.edit',compact('contact'));
    }

    // update contact
    public function update(Request $request,$id) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);
        
        Contacts::find($id)->update($request->post());
        return redirect()->route('index')->with('success','Contact updated successfully');
    }

    // destroy contact
    public function destroy($id) {
        $contact = Contacts::find($id)->delete();
        return redirect()->route('index')->with('success','Contact deleted successfully');
    }

}
