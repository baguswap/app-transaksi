<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction\Transaksi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('user.dashboard', compact('transaksis'));
    }

    public function transaksi()
    {
        return view('user.transaksi');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'tanggal' => 'required|date',
        ]);

        Transaksi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'prioritas' => $request->prioritas,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Transaksi created successfully.');
    }
}
