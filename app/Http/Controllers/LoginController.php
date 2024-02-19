<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Admin\Event\Actions;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required' => 'username wajib diisi',
            'password.required' => 'password wajib diisi'
        ]);

        $data = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $result = [
                'flag' => 'success',
                'msg' => 'Anda akan dialihkan ke halaman admin',
                'title' => 'Login sukses',
            ];
        } else {
            $result = [
                'flag' => 'error',
                'msg' => 'Periksa kembali username dan password Anda',
                'title' => 'Username atau password salah',
            ];
        }

        return response()->json($result);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
