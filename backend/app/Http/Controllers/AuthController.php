<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $validated = request()->validate([
            'id_card_number' => 'required',
            'password' => 'required'
        ]);

        $user = Society::where('id_card_number', $validated['id_card_number'])->first();

        if (!$user || $validated['password'] !== $user?->password) {
            return response([
                'message' => 'ID Card Number or Password incorrect'
            ], 401);
        }
        return response([
            'name' => $user->name,
            'born_date' => $user->born_date,
            'gender' => $user->gender,
            'address' => $user->address,
            'token' => $user->createToken('user', ['user'])->plainTextToken,
            'regional' => $user->regional
        ]);
    }
    public function logout()
    {
        // dd(request()->headers);
        request()->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Logout success'
        ]);
    }
}
