<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    //
    public function register(registerRequest $request)
    {
        // Create the user
        $data = [];
        $data['password'] = bcrypt($request->password);
        $data['email'] = $request->email;
        $data['name'] = $request->name;

        $user = User::create($data);
        $accessToken = $user->createToken('authToken')->plainTextToken;
        $user->access_token = $accessToken;

        $data = [
            'accessToken' => $accessToken,
        ];

        return $this->response(Response::HTTP_CREATED, 'Successfully created user!', $data);
    }

    public function login(loginRequest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->failureResponse([], 'Invalid Credentials');
        }

        $accessToken = auth()->user()->createToken('authToken')->plainTextToken;

        $user = auth()->user();
        $user->access_token = $accessToken;

        $data = [
            'accessToken' => $accessToken,
        ];

        return $this->response(Response::HTTP_OK, 'User login successfully', $data);
    }
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->response(Response::HTTP_OK, 'User logout successfully');
    }
}
