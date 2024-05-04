@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

    @if ($transaksis->count() > 0)
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Daftar Transaksi</h2>
    <form action="{{ route('rekap.export') }}" method="post">
        @csrf
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-file-excel"></i>
            Unduh Rekap
        </button>
    </form>
</div>

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
                                @if ($transaksi->status === 'belum_verifikasi')
                                    <span style="color: rgb(255, 0, 0);">Belum Terverifikasi</span>
                                @elseif ($transaksi->status === 'verifikasi')
                                    <span style="color: green;">Terverifikasi</span>
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
