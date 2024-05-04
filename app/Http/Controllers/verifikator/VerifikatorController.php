<?php

namespace App\Http\Controllers\Verifikator;

use App\Models\Transaction\Transaksi;
use App\Http\Controllers\Controller;

class VerifikatorController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi dan urutkan berdasarkan tanggal
        $transaksis = Transaksi::orderBy('tanggal', 'asc')->get();

        // Kirim data transaksi ke tampilan
        return view('verifikator.dashboard', compact('transaksis'));
    }

    public function verifikasi($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->route('verifikator.dashboard')->with('error', 'Transaksi tidak ditemukan');
        }
        $transaksi->status = 'verifikasi';
        $transaksi->save();

        return redirect()->route('verifikator.dashboard')->with('success', 'Transaksi berhasil diverifikasi');
    }
}
