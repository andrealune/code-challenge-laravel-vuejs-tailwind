<?php

namespace App\Http\Controllers;

use App\Events\ContactCreated;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Response};

class ContactController extends Controller
{
    
    protected ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {   
        $data = $this->contactRepository->getAllContact();

        return response()->json([
            'ok'   => true,
            'data' => $data
        ]);
    }

    public function show(Request $request)
    {   
        $id      = $request->id;
        $contact = $this->contactRepository->getContactById($id);

        return response()->json([
            'ok' => true,
            'data' => $contact,
        ]);
    }

    public function store(CreateContactRequest $request)
    {
        $data = $request->all();

        //$contact = $this->contactRepository->createContact($data);
        //event(new ContactCreated($contact));

        DB::beginTransaction();
        try {
            
            $contact = $this->contactRepository->createContact($data);
            event(new ContactCreated($contact));

            DB::commit();

            return response()->json([
                'ok' => true,
                'data' => $contact,
                'message' => 'Contact created successfully',
            ], 201);

        } catch (\Throwable $e) {
            $error = $e->getMessage();
            \Log::error($error);
            DB::rollback();
            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }

        /* return response()->json([
            'ok' => true,
            'data' => $contact,
            'message' => 'Contact created successfully',
        ], 201); */
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $data = $request->all();

        $contact = $this->contactRepository->updateContact($id, $data);

        if (!$contact) {
            return response()->json([
                'ok' => false,
                'message' => 'Contact not found',
            ], 404);
        }

        return response()->json([
            'ok' => true,
            'data' => $contact,
            'message' => 'Contact updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $constact_deleted = $this->contactRepository->deleteContact($id);

        if (!$constact_deleted) {
            return response()->json([
                'ok' => false,
                'message' => 'Contact not found',
            ], 404);
        }

        return response()->json([
            'ok' => true,
            'message' => 'Contact deleted successfully',
        ]);
    }
}
