@extends('layouts.verifikator')
@section('title', 'Dashboard')
@section('content')
    @if ($transaksis->count() > 0)
        <div class="container">
            <h2>Daftar Transaksi</h2>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Transaksi / Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Prioritas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $index => $transaksi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $transaksi->nama }}</td>
                            <td>{{ $transaksi->deskripsi }}</td>
                            <td style="padding: 5px 10px; text-align: center;">
                                <span class="badge badge-{{ $transaksi->prioritas === 'rendah' ? 'info' : ($transaksi->prioritas === 'sedang' ? 'warning' : 'danger') }}">
                                {{ ucfirst($transaksi->prioritas) }}
                                </span>
                            </td>
                            <td>{{ date('Y-m-d', strtotime($transaksi->tanggal)) }}</td>
                            <td>
                                @if ($transaksi->status === 'verifikasi')
                                    <form action="{{ route('verifikator.transaksi.verifikasi', $transaksi->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success" disabled>Terverifikasi</button>
                                    </form>
                                @elseif ($transaksi->status === 'belum_verifikasi')
                                    <form action="{{ route('verifikator.transaksi.verifikasi', $transaksi->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin memverifikasi data ini?')">Belum Verifikasi</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Tidak ada transaksi yang tersedia.</p>
    @endif
@endsection
