<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Storage;
use Validator;

class TokenController extends Controller
{
    public function register(Request $request)
    {
        //return response()->json($request->all());
        $validator = Validator::make($request->all(), 
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
                //'password_confirmation' => 'required|same:password',
                //'status' => 'boolean'
            ],
            [
                'email.required' => 'Email tidak boleh kosong.',
                'email.string' => 'Email harus berupa string.',
                'email.email' => 'Email tidak valid.',
                'email.unique' => 'Email telah terdaftar, silahkan login.',
                'password.required' => 'Password tidak boleh kosong.',
                'password.confirmed' => 'Konfirmasi password tidak sama dengan password.',
                'password.string' => 'Password harus berupa string.',
                'password.min' => 'Password harus 8 karakter.',
                'password.letters' => 'Password harus berisi setidaknya satu huruf',
                'password' => [
                    'mixed' => 'Password harus mengandung setidaknya satu huruf besar dan satu huruf kecil.',
                    'numbers' => 'harus berisi setidaknya satu nomor.',
                    'symbols' => 'Password harus berisi setidaknya satu simbol.',
                    'uncompromised' => 'Password yang diberikan telah muncul dalam kebocoran data. Silakan pilih Password yang lain.',
                ],
                //'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
                //'password_confirmation.same' => 'Konfirmasi password tidak sama dengan password',
                //'status' => 'boolean'
            ]
        );
        $collection = collect($validator->errors());
         
        $flattened = $collection->flatMap(function ($values) {
            return array_map('ucfirst', $values);
        });
         
        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'errors' => $flattened->implode(' '),
                //,
            ], 401);
        }
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
    public function store(Request $request)
    {
        $request->validate([

            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            //return new AuthenticationException();
            return response()->json([
                'user' => NULL,
                'message' => 'Password salah!'
            ],401);
        }
        $user = $request->user();
        return [
            'token' => $user->createToken($request->deviceId)->plainTextToken,
            'user' => $user,
            'role' => $user->roles()->pluck('name')->implode(','),
            //'roles' => ,
        ];
    }

    public function user(Request $request)
    {
        return $request->user();
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->where('name', $request->deviceId)->delete();
        return response('', 204);
    }
    public function imageadd(Request $request){
        $foto = request()->image->store('public/profile-photos');
        //Storage::disk('public')->put('request.json', json_encode(request()->all(), JSON_PRETTY_PRINT));
        $user = $request->user();
        $user->profile_photo_path = 'profile-photos/'.basename($foto);
        $user->save();
        return $user;
    }
    public function update_data(Request $request){
        //Storage::disk('public')->put('request.json', json_encode(request()->all(), JSON_PRETTY_PRINT));
        $user = $request->user();
        $user->{$request->field} = $request->data;
        $user->save();
        $data = [
            'user' => $user,
            'request' => $request->all(),
        ];
        return $data;
    }
}
