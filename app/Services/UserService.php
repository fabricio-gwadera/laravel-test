<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function firstOrCreate(Request $request)
    {
        $user = User::where('email', $request->email)
        ->first();

        if ($user) return $user;

        return User::create([
            'email' => $request->email,
            'password' => Hash::make(explode('@', $request->email)[0]),
            'display_name' => $request->name,
            'real_name' => $request->real_name,
        ]);
    }
    
}
