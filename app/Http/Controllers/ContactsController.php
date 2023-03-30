<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Handlers\Error;
use App\Models\Contacts;

class ContactsController extends Controller
{
        const ControllerCode = 'C_';

        public $outputData = [];
    
        public function getContactsData(Request $request){

            $contacts = Contacts::order()->take(10)->get();
            $this->outputData = [
                'contacts' => $contacts,
            ];

            return view('contacts',$this->outputData);
            
        }
    
        public function createPage(Request $request){
    
                return view('create');
    
        }

        public function createContacts(Request $request){
            try {
    
                $validator = Validator::make($request->all(), [
                    'first_name' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                    'last_name' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                    'phone' => 'string|min:10|max:12',
                    'email' => 'max:100|email:rfc,dns|unique:contacts',
                   
                ]);
    
                if ($validator->fails()) {
                    throw new \Exception($validator->errors(),1);
                }
    
                $validated = $validator->validated();
    
                $objContacts = Contacts::create($validated);
                
                return response()->json([
                    "status"=>true,
                    "message"=> "Contacts created successfully."
                ]);
    
            } catch (\Exception $e) {
    
                return Error::Handle($e, self::ControllerCode, '02');
            }
    
        }
    
        public function contactInfo(Request $request, $id){
            try { 
                $Info =  Contacts::find($id);
                $this->outputData = [
                    'objData' => $Info,
                ];
                if (!$Info) {
                    throw new \Exception("contact Not Found");
                }
                return view('edit',$this->outputData);
            } catch (\Exception $e) {
    
                return Error::Handle($e, self::ControllerCode, '03');
            }
        }
        
        public function updateContacts(Request  $request){

                     $id = $request->id;
            try {
                $validator = Validator::make($request->all(), [
                    'id' => 'required|exists:contacts',
                    'first_name' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                    'last_name' => 'required|regex:/^[a-zA-Z0-9_\- ]*$/|max:50',
                    'phone' => 'string|min:10|max:12',
                    'email' => 'required|max:100|email:rfc,dns|unique:contacts,email,'.$id,
                ]);
                if ($validator->fails()) {
                    throw new \Exception($validator->errors(),1);
                }
    
                $validated = $validator->validated();
                $objContacts = Contacts::find($validated['id'])->update($validated);
                
                return response()->json([
                    "status"=>true,
                    "message"=> "Contacts updated successfully."
                ]);
    
    
            } catch (\Exception $e) {
    
                return Error::Handle($e, self::ControllerCode, '04');
            }
    
        }
    
        public function deleteContacts($id){
            try {
    
                $contacts = Contacts::find($id);
    
                if (!$contacts) {
                    throw new \Exception("Contacts Not Found");
                }
    
                $contacts = $contacts->delete();
    
                return response()->json([
                    'success' => true,
                    'message' => "Contacts deleted successfully."
                ]);
            } catch (\Throwable $e) {
                return Error::Handle($e, self::ControllerCode, '04');
            }
        }
    }
