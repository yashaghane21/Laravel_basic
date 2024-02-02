<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class Auth extends Controller

{
    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }


    public function Reg(Request $request)
    {
        if ($this->authService->checkUserExist($request['email'])) {
            return response()->json(['error' => 'User with this email already exists'], 422);
        }
        $response = $this->authService->reg($request);
        return response()->json(['message' => 'Signup successful', $response], 201);
    }


    public function login(Request $request)
    {
        $response = $this->authService->signin($request);
        return response()->json(['message' =>  $response]);
    }


    public function getallusers()
    {

        $response = $this->authService->allusers();
        return response()->json(['message' =>  $response]);
    }

    public function getuserbyid(Request $request)
    {

        $response =   $this->authService->getbyid($request->id);
    
        return response()->json(['message' =>  $response]);
    }
}
