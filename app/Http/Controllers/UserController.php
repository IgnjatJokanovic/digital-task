<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use App\User;

class UserController extends Controller
{
    public function login()
    {
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->errors()->all() as $error) {
                array_push($errors, $error);
            }
            return response()->json(["messages" => $errors], 422);
        } else {
            $credentials = request()->only(['email', 'password']);
            $token = auth()->attempt($credentials);
            if ($token) {
                return response()->json(['token' => $token]);
            } else {
                return response()->json(['messages' => ['Invalid username or password']], 401);
            }
        }
    }

    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            $errors = array();
            foreach ($validator->errors()->all() as $error) {
                array_push($errors, $error);
            }
            return response()->json(["messages" => $errors], 422);
        } else {
            User::create(["name" => request()->name, "email" => request()->email, "password" => bcrypt(request()->password)]);
            return response()->json("Thank you for registering", 201);
        }
    }
}
