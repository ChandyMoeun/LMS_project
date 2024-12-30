<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function getMember()
    {
        // Assuming you have a method to get the authenticated user
        $user = auth()->user();

        // Return user data along with the member's role and other details
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles->first()->name,  // Assuming you use roles relationship
        ]);
    }
}
