<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Team;
use App\Models\Semester;

use Validator;

class AuthController extends Controller
{
    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        $request->validate(
            [
                'email'=> 'required|string|email|unique:users',
                'password'=> [
                    'required', 
                    'confirmed', 
                    Password::min(8)->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                ],
                'password_confirmation' => 'required|same:password',
                'status' => 'boolean'
            ],
            [
                'email' => [
                    'required' => 'Email tidak boleh kosong.',
                    'string' => 'Email harus berupa string.',
                    'email' => 'Email tidak valid.',
                    'unique' => 'Email telah terdaftar, silahkan login.',
                ],
                'password.required' => 'Password tidak boleh kosong.',
                'password.confirmed' => 'Konfirmasi password tidak sama dengan password.',
                'password.string' => 'Password harus berupa string.',
                'password.min' => 'Password harus 8 karakter.',
                'password_confirmation' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'same' => 'Konfirmasi password tidak sama dengan password',
                ],
                'status' => 'boolean'
            ]
        );

        $user = new User([
            'email' => $request->email,
            'name' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            //$tokenResult = $user->createToken('Personal Access Token');
            //$token = $tokenResult->plainTextToken;

            return response()->json([
                'message' => 'Akun berhasil dibuat, silahkan periksa inbox/spam untuk mengkonfirmasi pendaftaran',
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }
    /**
     * Login user and create token
    *
    * @param  [string] email
    * @param  [string] password
    * @param  [boolean] remember_me
    */

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|string|email|exists:users',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ],
            [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.exists' => 'Email tidak terdaftar',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]
        );

        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'message' => 'Unauthorized'
        ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        $semester = Semester::find(semester_id());
        $team = Team::firstOrCreate([
            'name' => $semester->nama,
            'display_name' => $semester->nama,
            'description' => $semester->nama,
        ]);
        if(!$user->sekolah_id){
            if(!$user->hasRole('administrator', $semester->nama)){
                $user->attachRole('administrator', $team);
            }
        }
        $general  = [
            [
                'action' => 'read',
                'subject' => 'Web'
            ],
            [
                'action' => 'read',
                'subject' => 'Front',
            ]
        ];
        $user->role = $user->roles()->pluck('name')->toArray();
        $user->roles = $user->roles;
        $user->ability = $user->allPermissions(['description as action', 'name as subject'], $semester->nama);
        $user->semester = $semester;
        return response()->json([
            'accessToken' =>$token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }
    /**
     * Get the authenticated User
    *
    * @return [json] user object
    */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    /**
     * Logout user (Revoke the token)
    *
    * @return [string] message
    */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);

    }
}