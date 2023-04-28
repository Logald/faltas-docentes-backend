<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
      'type' => $request->type ? $request->type : 'Adscrito',
    ]);
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'token' => $token,
      'type' => $user->type
    ]);
  }

  public function getAll(Request $request)
  {
    $users = Cache::remember('users', CACHE_TIME, fn() => User::all());
    $users = searchMany($users, $request->all());
    return $users;
  }

  public function getOne(User $user)
  {
    return $user;
  }

  public function update(User $user, Request $request)
  {
    mergeObjects($request->keys(), $user, $request->all());
    if (isset($request->password)) {
      $user->password = Hash::make($request->password);
    }
    $user->save();
    return response()->json(true);
  }

  public function delete(User $user)
  {
    $user->delete();
    return response()->json(true);
  }

  /**
   * @param Request $request
   */
  public function signIn(Request $request)
  {
    if (!Auth::attempt($request->only(['name', 'password'])))
      return response()->json([
        'name' => $request->name,
        'password' => $request->password
      ]);
    // return throw new HttpException(401, 'Unauthorized');
    $user = User::where('name', $request->name)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
      'token' => $token,
      'type' => $user->type
    ]);
  }

}