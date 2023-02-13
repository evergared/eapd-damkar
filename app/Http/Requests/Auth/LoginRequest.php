<?php

namespace App\Http\Requests\Auth;

use App\Models\Eapd\Mongodb\Pegawai;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nrk' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        #region Agar login dapat menggunakan nrk atau nip
        $id = "";

        // ambil data dari field 'nrk'
        $inputed = implode("|",$this->only('nrk'));

        // cek apakah $inputed merupakan nrk / id pjlp
        if($pegawai = Pegawai::where('nrk','=',$inputed)->first())
        {
            $id = $pegawai->id;
        }
        // cek apakah $inputed merupakan nip / nik
        elseif($pegawai = Pegawai::where('nip','=',$inputed)->first())
        {
            $id = $pegawai->id;
        }

        // jika $inputed bukan nrk/id pjlp maupun nip/nik, maka gagalkan permintaan login
        if($id == "")
            throw ValidationException::withMessages([
                    'nrk' => trans('auth.failed'),
                ]);
        // jika id terisi, maka masukan data tsb dan password nya sebagai kredensial login
        $credential = [ '_id' => $id, 'password' => $this->password];
        #endregion

        if (!Auth::attempt($credential, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nrk' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'nrk' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('nrk')) . '|' . $this->ip());
    }
}
