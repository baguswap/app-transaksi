@extends('layouts.user')
@section('title', 'Transaksi')
@section('content')

    <section class="container">
        <form action="{{ route('user.transaksi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Transaksi / Kegiatan:</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="prioritas">Prioritas:</label>
                <select name="prioritas" class="form-control" id="prioritas" required>
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </section>

@endsection
