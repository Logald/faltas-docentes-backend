<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  /**
   * @param Request $request
   */
  public function signUp(Request $request)
  {
    $user = User::create([
      'name' => $request->name,
      'password' => Hash::make($request->password),
      'profileId' => $request->profileId
    ]);
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'token' => $token
    ]);
  }

  /**
   * @param Request $request
   */
  public function signIn(Request $request)
  {
    if (!Auth::attempt($request->only(['name', 'password'])))
      return throw new HttpException(401, 'Unauthorized');
    $user = User::where('name', $request->name)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'token' => $token
    ]);
  }

}
