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
            return redirect('/loginAdmin')->with('berhasil', 'Anda sudah logout');
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Anda gagal logout');
        }
    }

    public function listAdmin()
    {
        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            $data['admin'] = M_Admin::where('status', '1')->paginate(15);
            return view('admin.list', $data);
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah logout');
        }
    }

    public function tambahAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'password' => 'required'
            ]
        );

        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        // return response([$token, $tokenDb]);

        if ($tokenDb > 0) {
            if (M_Admin::create(
                [
                    "nama" => $request->nama,
                    "email" => $request->email,
                    "alamat" => $request->alamat,
                    "password" => encrypt($request->password),
                ]
            )) {
                // return redirect('/listAdmin')->with('berhasil', 'Data Berhasil Disimpan');
                return response()->json(['code' => '200', 'message' => 'Data berhasil disimpan']);
            } else {
                // return redirect('/listAdmin')->with('gagal', 'Data Gagal Disimpan');
                return response()->json(['code' => '500', 'message' => 'Data gagal disimpan']);
            }
        } else {
            // return redirect('/loginAdmin')->with('gagal', 'Anda sudah keluar, Silahkan masuk kembali');
            return response()->json(['error' => 'Session ended']);
        }
    }

    public function ubahAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'u_nama' => 'required',
                'u_email' => 'required',
                'u_alamat' => 'required',
            ]
        );

        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        // return response([$token, $tokenDb]);

        if ($tokenDb > 0) {
            if (M_Admin::where("id_admin", $request->id_admin)->update(
                [
                    "u_nama" => $request->nama,
                    "u_email" => $request->email,
                    "u_alamat" => $request->alamat,
                ]
            )) {
                // return redirect('/listAdmin')->with('berhasil', 'Data Berhasil Disimpan');
                return response()->json(['code' => '200', 'message' => 'Data berhasil disimpan']);
            } else {
                // return redirect('/listAdmin')->with('gagal', 'Data Gagal Disimpan');
                return response()->json(['code' => '500', 'message' => 'Data gagal disimpan']);
            }
        } else {
            // return redirect('/loginAdmin')->with('gagal', 'Anda sudah keluar, Silahkan masuk kembali');
            return response()->json(['error' => 'Session ended']);
        }
    }

    public function hapusAdmin($id)
    {
        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        // return response([$token, $tokenDb]);

        if ($tokenDb > 0) {
            if (M_Admin::where("id_admin", $id)->delete()) {
                return redirect('/listAdmin')->with('berhasil', 'Data Berhasil Disimpan');
                // return response()->json(['code' => '200', 'message' => 'Data berhasil disimpan']);
            } else {
                return redirect('/listAdmin')->with('gagal', 'Data Gagal Disimpan');
                // return response()->json(['code' => '500', 'message' => 'Data gagal disimpan']);
            }
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah keluar, Silahkan masuk kembali');
            // return response()->json(['error' => 'Session ended']);
        }
    }
}
