<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Http\Requests\UserRegistrationRequest;

class UserRegistrationController extends Controller
{
    /**
    * Handle user registration request.
    */
    public function store(UserRegistrationRequest $request)
    {
        $validated = $request->validated();
       
        $input = $request->all(); 
        $input['password'] = Hash::make($input['password']); 
        $user = User::create($input);
        $token =  $user->createToken('NewsApp')->accessToken; 
        return response()->json(['user'=>$user,'token'=>$token], 200); 
    }

}