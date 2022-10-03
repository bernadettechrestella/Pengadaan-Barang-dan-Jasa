<?php

namespace App\Http\Controllers;

use App\Models\M_suplier;
use Illuminate\Support\Facades\Session;

class Home extends Controller
{
    public function index()
    {
        $key = env('APP_KEY');
        $token = Session::get('token');
        $tokenDb = M_suplier::where('token', $token)->count();

        if ($tokenDb > 0) {
            $data['token'] = $token;
        } else {
            $data['token'] = "kosong";
        }
        return view('home.home', $data);
    }
}
