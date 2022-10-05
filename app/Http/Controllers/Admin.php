<?php

namespace App\Http\Controllers;

use App\Models\M_Admin;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Session;

class Admin extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function masukAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $cek = M_Admin::where('email', $request->email)->count();
        $adm = M_Admin::where('email', $request->email)->get();

        if ($cek > 0) {
            foreach ($adm as $ad) {
                if (decrypt($ad->password) == $request->password) {
                    $key = env('APP_KEY');
                    $data = array(
                        "id_admin" => $ad->id_admin
                    );

                    $jwt = JWT::encode($data, $key, 'HS256');

                    M_Admin::where('id_admin', $ad->id_admin)->update(
                        [
                            'token' => $jwt
                        ]
                    );
                    Session::put('token', $jwt);
                    // return redirect('/');

                    return redirect('/pengajuan')->with('berhasil', "Selamat Datang");
                } else {
                    return redirect('/loginAdmin')->with('gagal', 'Password Anda salah.');
                }
            }
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Data email tidak ditemukan');
        }
    }

    public function keluarAdmin()
    {
        $token = Session::get('token');

        if (M_Admin::where('token', $token)->update(['token' => 'keluar'])) {
            Session::put('token', "");
            return redirect('/loginAdmin');
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Anda gagal logout');
        }
    }
}
