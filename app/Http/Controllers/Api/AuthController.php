<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use App\Role;

class AuthController extends Controller
{
        /**
         *Create user and create token
         *
         *@param  [string] full_name
         *@param  [string] user_name
         *@param  [string] email
         *@param  [string] password
         *@return [string] access_token
         *@return [string] token_type
         *@return [string] expires_at
        */
        public function register(Request $request) {
            $request->validate([
                'full_name'=>'required|string',
                'user_name'=>'required|string',
                'email'=>'required|string|email|unique:users',
                'password'=>'required|string'
            ]);

            $user = new User([
                'full_name'=>$request->full_name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password)
            ]);
            $user->save();
            $user->roles()->attach(Role::where('name', 'player')->first());
            $tokenResult= $user->createToken('Personal Access Token');
            $token= $tokenResult->token;
            $token->save();

            return response()->json([
                'access_token'=>$tokenResult->accessToken,
                'token_type'=>'Bearer',
                'expires_at'=>Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
        /**
         *Login user and create token
         *
         *@param  [string] email
         *@param  [string] password
         *@return [string] access_token
         *@return [string] token_type
         *@return [string] expires_at
        */
        public function login(Request $request) {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]);
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials))
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        }
        /**
         *Logout user (Revoke the token)
         *
         *@return [string] message
        */
        public function logout(Request $request) {
            $request->user()->token()->revoke();
            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }
        /**
         *Get the authenticated User
         *
         *@return [json] user object
        */
        public function user(Request $request) { //needs token
            return response()->json($request->user());
        }
}
