<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{


    public function loginAdmin(LoginRequest $request)
    {

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $admin->token = $admin->createToken($request->device_name)->plainTextToken;

        return new AdminResource($admin);
    }

    public function loginUser(LoginRequest $request)
    {

        $admin = User::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $admin->token = $admin->createToken($request->device_name)->plainTextToken;

        return new AdminResource($admin);
    }




    public function user(Request $request)
    {   
        dd(auth()->user());
    }

}
