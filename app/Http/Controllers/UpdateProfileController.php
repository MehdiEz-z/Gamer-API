<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{
    public function updateProfile(Request $request, User $user)
    {
        $input =  $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $input['password'] = Hash::make($request->password);

        $user->update($input);

        return response([
            'message' => 'Profile updated successfully!'
        ], 200);
    }

}
