<?php

namespace App\Http\Controllers\DataSiswa;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataSiswaController extends Controller
{

    public function index(){

        $siswaId = Auth::guard('siswa')->user()->id;
        $data['models'] = Siswa::where('id', $siswaId)->get();
        // $data['title'] = 'SISWA';
        // dd($data['models']);
        return view('siswa.dashboard.index', $data);
    }
}
