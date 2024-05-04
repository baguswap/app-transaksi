<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaksi;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('status', 'verifikasi')->orderBy('tanggal', 'desc')->get();

        // Mengirimkan data transaksi ke view 'admin.dashboard'
        return view('admin.dashboard', compact('transaksis'));
    }



    public function rekap()
    {
        return view('admin.rekap');
    }
}
