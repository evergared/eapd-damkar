<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('eapd.auth.login');
    }

    public function username()
    {
        return 'nrk';
    }

    protected function attemptLogin(Request $request)
    {
        $cred = $this->credentials($request);

        if(str_contains($cred[$this->username()], 'admin'))
        {
            $new_cred = ["id" => $cred[$this->username()], "password" => $cred["password"]];
            return Auth::guard('admin')->attempt($new_cred, $request->boolean('remember'));
        }
        else
        {

            $pegawai = Pegawai::where('nrk', $cred[$this->username()])->first();

            if(is_null($pegawai))
                $pegawai = Pegawai::where('nip', $cred[$this->username()])->first();
            
            if($pegawai)
            {
                $new_cred = ["id_pegawai" => $pegawai->id_pegawai, "password" => $cred["password"]];
                return $this->guard()->attempt($new_cred, $request->boolean('remember'));
            }

            return false;

        }
    }

    protected function authenticated(Request $request, $user)
    {
        
    }
}
