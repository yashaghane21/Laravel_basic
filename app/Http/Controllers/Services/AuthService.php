<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthService extends Controller
{
    public function reg($data)
    {


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

    public function checkUserExist($email)
    {

        return User::where('email', $email)->exists();
    }

    public function signin($data)
    {
        $isuser = User::where('email', $data['email']);
        dd($isuser);
        if (!$isuser) {
            return response()->json("user not exist");
        }
        if (password_verify($data['password'], $isuser->password)) {
            return response()->json(['user' => $isuser, 'message' => 'User signed in successfully'], 200);
        } else {
            return response()->json(['error' => 'Incorrect password'], 401);
        }
    }


    public function allusers()
    {
        $response = User::all();
        return response()->json($response);
    }

    public function getbyid($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['user' => $user], 200);
    }
}
