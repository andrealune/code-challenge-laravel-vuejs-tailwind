<?php namespace App\Services;

use App\Models\User;
use App\Repository\{ContactRepository};
use App\Mail\{NewUserMail};
use Illuminate\Support\Facades\{DB, Mail};
use Illuminate\Support\{Collection, Str};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\{Response};

class ContactService extends ContactRepository
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Model|null
     * @throws \Exception
     */
    public function store(): ?Model
    {
        DB::beginTransaction();
        try {
            $response = $this->saveRepository(\request()->except("_token"));

            $admin = User::where(["role_id" => 1])->get();

            Mail::to($admin[0]->email)->send(new NewUserMail($response));

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return Model
     * @throws \Exception
     */
    public function update(string $id): ?Model
    {
        DB::beginTransaction();
        try {
             $response = $this->updateRepository(
                \request()->except("id"),
                $id
            );

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

}
