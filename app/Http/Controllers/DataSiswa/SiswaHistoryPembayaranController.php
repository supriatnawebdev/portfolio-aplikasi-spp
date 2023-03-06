<?php

namespace App\Http\Controllers\DataSiswa;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiswaHistoryPembayaranController extends Controller
{
     public function index(){
        $siswaId = Auth::guard('siswa')->user()->id;
        $data['tagihan'] = Tagihan::with('tagihanDetail', 'pembayaran')->where('siswa_id', $siswaId)->get();
        $data['title'] = 'Tagihan SPP';
        // dd($data['tagihan']);
        return view('siswa.dashboard.history_index', $data);
    }
}
