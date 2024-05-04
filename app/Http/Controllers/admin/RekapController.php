<?php

namespace App\Http\Controllers\admin;

use App\Exports\RekapExport;
use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function index()
    {
        return view('admin/rekap');
    }

    public function export(Request $request)
    {
        // Mulai dengan menginisialisasi query builder untuk model Transaksi
        $transaksi = Transaksi::query();

        // Tambahkan kondisi where untuk status verifikasi
        $transaksi->where('status', 'verifikasi');

        // Ambil data transaksi yang sesuai dengan kriteria dan pilih kolom yang diinginkan
        $transaksis = $transaksi->select('nama', 'deskripsi', 'prioritas', 'tanggal')->get();

        // Ubah format tanggal menjadi Y-m-d
        $transaksis->transform(function ($item) {
            $item->tanggal = Carbon::parse($item->tanggal)->format('Y-m-d');
            return $item;
        });

        // Pastikan ada data yang sesuai dengan kriteria
        if ($transaksis->isEmpty()) {
            return back()->with('error', 'Tidak ada data yang sesuai dengan filter yang diberikan.');
        }

        // Jika ada data yang sesuai, lakukan ekspor
        return Excel::download(new RekapExport($transaksis), 'Rekap Data Transaksi.xlsx');
    }
}
