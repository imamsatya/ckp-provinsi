<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;
class AuthenticationController extends Controller
{
    public function createAccount(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => bcrypt($attr['password']),
            'email' => $attr['email']
        ]);

        return $this->success([
            'token' => $user->createToken('tokens')->plainTextToken
        ]);
    }
    //use this method to signin users
    public function signin(Request $request)
    {
        try {
            $request->validate([
              'email' => 'email|required',
              'password' => 'required'
            ]);
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
              return response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized'
              ]);
            }
            $user = User::where('email', $request->email)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
               throw new \Exception('Error in Login');
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
              'status_code' => 200,
              'access_token' => $tokenResult,
              'token_type' => 'Bearer',
            ]);
          } catch (Exception $error) {
            return response()->json([
              'status_code' => 500,
              'message' => 'Error in Login',
              'error' => $error,
            ]);
          }
    }

    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
