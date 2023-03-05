<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBerandaController extends Controller
{
    public function index()
    {
        return view('administrator.beranda_index');
    }
}
