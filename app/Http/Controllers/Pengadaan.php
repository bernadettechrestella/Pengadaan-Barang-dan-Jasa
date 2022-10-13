<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\M_Admin;
use App\Models\M_Pengadaan;
use \Firebase\JWT\JWT;

class Pengadaan extends Controller
{
    public function index()
    {
        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            return view('pengadaan.list');
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah logout');
        }
    }

    public function tambahPengadaan(Request $request)
    {
        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            $this->validate(
                $request,
                [
                    'nama_pengadaan' => 'required',
                    'deskripsi' => 'required',
                    'gambar' => 'required|image|mimes:jpg,png,jpeg|max:10000',
                    'anggaran' => 'required'
                ]
            );

            $path = $request->file('gambar')->store('public/gambar');

            if (M_Pengadaan::create(
                [
                    "nama_pengadaan" => $request->nama_pengadaan,
                    "deskripsi" => $request->deskripsi,
                    "gamabr" => $path,
                    "anggaran" => $request->anggaran,
                ]
            )) {
                return redirect('/listPengadaan')->with('berhasil', 'Data Berhasil Disimpan');
            } else {
                return redirect('/listPengadaan')->with('gagak', 'Data Gagal Disimpan');
            }
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Silahkan Login');
        }
    }
}
