<?php

namespace App\Http\Controllers;

use App\Models\M_Admin;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Session;

class Pengajuan extends Controller
{
    public function index()
    {
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDb = M_Admin::where('token', $token)->count();

        if ($tokenDb > 0) {
            return view('pengajuan.list');
        } else {
            return redirect('/loginAdmin')->with('gagal', 'Silahkan Login Dahulu');
        }
    }
}
