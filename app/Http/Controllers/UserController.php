<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class UserController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6', 
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(new UserResource($user), 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while registering the user.'], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
    
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            
            return response()->json(['token' => $token], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while logging in.'], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            return response()->json(new UserResource($request->user()));
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the user.'], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            if ($request->has('name')) {
                $user->name = $request->name;
            }

            if ($request->has('email')) {
                $user->email = $request->email;
            }

            if ($request->has('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json(new UserResource($user));
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the user.'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $user = $request->user();
            $user->delete();

            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the user.'], 500);
        }
    }
}
