@extends('layouts.admin')
@section('title', 'Transaksi')
@section('content')

    <div>
        <h3>Rekap Data Transaksi</h3>
        <form action="{{ route('rekap.export') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-file-excel"></i>
                Unduh Rekap</button>
        </form>
    </div>

@endsection
