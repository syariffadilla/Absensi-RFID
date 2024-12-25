<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Tambahkan ini untuk menggunakan Request
use Illuminate\Support\Facades\Auth; // Tambahkan ini untuk menggunakan Auth

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle a successful authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Cek role pengguna dan arahkan ke halaman yang sesuai
        if ($user->role == 1) {
            return redirect('/absensi/manager'); // Arahkan ke halaman Manager
        } elseif ($user->role == 2) {
            return redirect('absensi/admin'); // Arahkan ke halaman Admin
        }

        return redirect('/home'); // Halaman default jika tidak ada role yang cocok
    }
}
