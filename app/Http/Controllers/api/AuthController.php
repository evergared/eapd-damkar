<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pegawai;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Throwable;

// Untuk menghandle autentikasi melalui sanctum
class AuthController extends Controller
{
    public function login(Request $request)
    {
        // ambil id (nip, nrk, npjlp, atau nik yang dimasukan ke field id) dan password
        $cred = $request->only('id','password');

        $validator = Validator::make($cred,[
            'id' => 'required|string|max:255',
            'password'=>'required|string'
        ],
        [
            'id.required' => 'Field ID perlu diisi.',
            'password.required' => 'Field Password perlu diisi.'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }

        if(str_contains($cred['id'],'admin'))
        {
            // jika id memiliki kata admin, maka proses login untuk admin
            try{

                $admin = Admin::where('id',$cred['id'])->firstOrFail();
                if(!Hash::check($cred['password'],$admin->password))
                    throw new Exception('login gagal');

                $ab = Str::slug($admin->tipe);

                $token = $admin->createToken('auth_token_admin',[$ab])->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Login admin berhasil',
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]);

            }
            catch(Throwable $e)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Login gagal, periksa id dan password anda : '.$e
                ],401);
            }

        }
        else
        {
            // jika id tidak memiliki kata admin, maka proses login untuk pegawai (user biasa)
            try{

                // cek apakah user menggunakan NRK/NPJLP atau NIP/NIK untuk login
                $pegawai = Pegawai::where('nrk',$cred['id'])->first();

                if(is_null($pegawai))
                    $pegawai = Pegawai::where('nip',$cred['id'])->first();

                // jika user ketemu, maka proses login
                if($pegawai)
                {
                    
                    if(!Hash::check($cred['password'],$pegawai->user->password))
                    {
                        throw new Exception('Password tidak sama');
                    }
                    else
                    {
                     $token = $pegawai->createToken('auth_token_user',['pegawai'])->plainTextToken;

                        return response()->json([
                            'status' => true,
                            'message' => 'Login pegawai berhasil',
                            'access_token' => $token,
                            'token_type' => 'Bearer'
                        ]);
                    }
                }

                // jika tidak, gagalkan
                throw new Exception('Pegawai tidak ditemukan');

            }
            catch(Throwable $e)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Login gagal, periksa id dan password anda : '.$e
                ],401);
            }
            
        }
    }

    public function logout(Request $request)
    {
        $request->user('sanctum')->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }

}
