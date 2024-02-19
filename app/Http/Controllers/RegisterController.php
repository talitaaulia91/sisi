<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Admin\Event\Actions;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
            'email' =>'required',
            'nama_user'=>'required',
            'no_hp'=>'required',
            'wa'=>'required',
        ],[
            'username.required' => 'username wajib diisi',
            'password.required' => 'password wajib diisi',
            'email.required' => 'email wajib diisi',
            'no_hp.required' => 'no_hp wajib diisi',
            'wa.required' => 'no_wa wajib diisi',
            'nama_user.required' => 'nama wajib diisi',
        ]);

        DB::transaction(function () use ($request) {
            User::create($request->except('actionform', 'id'));
        });

        $result = [
            'flag' => 'success',
            'msg' => 'Anda akan dialihkan ke halaman login',
            'title' => 'Registrasi sukses',
        ];

        return response()->json($result);
    }
}
