<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use \Firebase\JWT\JWT;
use Illuminate\Http\Response;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\M_suplier;

class Suplier extends Controller
{
    public function index()
    {
        return view('suplier.login');
    }

    public function masukSuplier(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $cek = M_suplier::where('email', $request->email)->count();
        $sup = M_suplier::where('email', $request->email)->get();
        if ($cek > 0) {
            foreach ($sup as $s) {
                if (decrypt($s->password) == $request->password) {
                    $key = env('APP_KEY');
                    $data = array(
                        "id_suplier" => $s->id_suplier
                    );

                    $jwt = JWT::encode($data, $key, 'HS256');

                    M_suplier::where('id_suplier', $s->id_suplier)->update(
                        [
                            'token' => $jwt
                        ]
                    );
                    Session::put('token', $jwt);
                    return redirect('/');
                } else {
                    return redirect('/loginSuplier')->with('gagal', 'Password Anda salah.');
                }
            }
        } else {
            return redirect('/loginSuplier')->with('gagal', 'Data email tidak terdaftar.');
        }
    }

    public function keluarSuplier()
    {
        $token = Session::get('token');

        if (M_suplier::where('token', $token)->update(['token' => 'keluar'])) {
            Session::put('token', "");
            return redirect('/');
        } else {
            return redirect('/loginSuplier')->with('gagal', 'Anda gagal logout');
        }
    }
}
