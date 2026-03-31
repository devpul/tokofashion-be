<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $aa = User::all();
        return response()->json($aa);
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name'          =>  'required|string|unique:users,name',
            'email'         =>  'required|email|unique:users,email',
            'password'      =>  'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name'          =>      $validated['name'],
            'email'         =>      $validated['email'],
            'password'      =>      Hash::make($validated['password']),
        ]);


        return response()->json([
            'status'    =>  true,
            'data'      =>  $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Maaf email atau password salah'
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Berhasil',
            'token'     =>  $token
        ], 200);
    }
}
