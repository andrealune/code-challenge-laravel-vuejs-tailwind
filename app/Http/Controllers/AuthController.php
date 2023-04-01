<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param AuthRequest $request
     *
     * @return mixed
     */
    public function login(AuthRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'errors' => ['email' => [__('auth.failed')]]
                ], 422);
            }
            return $this->sendSuccessResponse(['token' => $user->createToken('test')->plainTextToken], 'Logged in successfully.');
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }
    }
}
