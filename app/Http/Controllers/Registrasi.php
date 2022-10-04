<?php

namespace App\Http\Controllers;

use App\Models\M_suplier;
use Illuminate\Http\Request;

class Registrasi extends Controller
{
    public function index()
    {
        return view('registrasi.registrasi');
    }

    public function registrasi(Request $request)
    {
        $this->validate(
            $request,
            [
                'nama_usaha' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'no_npwp' => 'required',
                'password' => 'required'
            ]
        );

        if (M_suplier::create([
            "nama_usaha" => $request->nama_usaha,
            "email" => $request->email,
            "alamat" => $request->alamat,
            "no_npwp" => $request->no_npwp,
            "password" => encrypt($request->password),
        ])) {
            return redirect('/loginSuplier')->with('berhasil', 'Data berhasil disimpan');
        } else {
            return redirect('/registrasi')->with('gagal', 'Data gagal disimpan');
        }
    }
}
