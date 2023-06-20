<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * This function handles user login authentication and generates a personal access token for the
     * user.
     * 
     * @param LoginRequest request  is an instance of the LoginRequest class, which is a custom
     * request class that validates the incoming login request data. It contains the email and password
     * fields that are required for authentication.
     * 
     * @return This function returns a JSON response containing an access token, token type, expiration
     * time, and expiration date. The access token is generated using Laravel's Passport package and is
     * used for authentication and authorization in subsequent API requests.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credencials',
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addMinutes(30);

        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'expiration_time' => Carbon::parse($token->expires_at)->diffInSeconds(Carbon::now()),
        ]);
    }

    /**
     * This function creates a new user with the provided name, email, and password, and returns a JSON
     * response with a success message and the created user data, or an error message and code if an
     * exception occurs.
     * 
     * @param RegisterRequest request The  parameter is an instance of the RegisterRequest
     * class, which is a custom request class that contains validation rules and messages for the user
     * registration form data. It is used to validate the incoming request data before creating a new
     * user.
     * 
     * @return This function is returning a JSON response with a message and either the newly created
     * user or an error message and status code. If the user is successfully created, the response will
     * have a status code of 201 (created) and include the message "User successfully created!" along
     * with the user object. If there is an error creating the user, the response will have a status
     * code of 500 (internal
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return response()->json([
                'message' => 'User successfully created!',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json([
                'message' => 'Error creating user',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * This function logs out a user by revoking their token and returns a JSON response with a success
     * message or an error message if an exception occurs.
     * 
     * @param Request request  is an instance of the Illuminate\Http\Request class, which
     * represents an HTTP request. It contains information about the request such as the HTTP method,
     * headers, and parameters. In this case, it is used to retrieve the authenticated user's token and
     * revoke it to log them out.
     * 
     * @return This function returns a JSON response with a message indicating whether the user was
     * successfully logged out or if an error occurred while logging out. If the user was successfully
     * logged out, the response will have a status code of 200. If an error occurred, the response will
     * have a status code of 500 and will include an error message.
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
    
            return response()->json([
                'ok' => true,
                'message' => 'Successfully logged out',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Error occurred while logging out',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
