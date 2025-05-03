<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller {
  public function register (Request $request){
    $validator = \Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }
    $data = $validator->validated();
    $data['password'] = Hash::make($data['password']);
    $user = User::create($data);
    $success['token'] = $user->createToken('auth_token')->plainTextToken;
    $success['name'] = $user->name;
    return response()->json(['success' => $success], 201);
  }

  public function login (Request $request){
    $credentials = [
      'email' => $request->email,
      'password' => $request->password,
    ];

    if(Auth::attempt($credentials)){
      $user = Auth::user();
      $success['token'] = $user->createToken('auth_token')->plainTextToken;
      $success['name'] = $user->name;
      return response()->json(['success' => $success], 200);
    }

    return response()->json(['error' => 'Unauthenticated'], 401);
  }
}
