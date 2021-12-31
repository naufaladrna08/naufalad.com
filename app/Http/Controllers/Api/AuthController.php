<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller {
  public function register(Request $r) {
    $validator = Validator::make($r->all(), [
      'name' => 'required|string|max:255|min:8',
      'username' => 'required|string|max:255|min:8',
      'password' => 'required|string|min:8',
      'email' => 'required|string',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }

    $user = User::create([
      'name' => $r->name,
      'username' => $r->username,
      'password' => Hash::make($r->password),
      'email' => $r->email
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'code' => 200,
      'status' => 'Success',
      'message' => 'Data berhasil dibuat',
      'data' => [
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer'
      ]
    ]);
  }

  public function login(Request $r) {
    if (!Auth::attempt($r->only('username', 'password'))) {
      return response()->json([
        'code' => 401,
        'status' => 'Failed',
        'message' => 'Unauthorized',
        'data' => null
      ]);
    }

    $user  = User::where('username', $r->username)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'code' => 200,
      'status' => 'Success',
      'message' => 'Berhasil login',
      'data' => [
        'user' => $user,
        'access_token' => $token,
        'token_type' => 'Bearer'
      ]
    ]);
  }

  public function logout(Request $r) {
    Auth::logout();
    $r->session()->invalidate();
    $r->session()->regenerateToken();

    return redirect('/');
  }
}
