@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Transfer</h1>
    
    <a href="{{ route('transfer.create') }}" class="btn btn-primary mb-3">Tambah Transfer</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>Nominal</th>
                <th>Tanggal Transfer</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transfers as $transfer)
                <tr>
                    <td>{{ $transfer->nama_pengirim }}</td>
                    <td>{{ $transfer->nama_penerima }}</td>
                    <td>{{ number_format($transfer->nominal, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($transfer->tanggal)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('transfer.edit', $transfer->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('transfer.destroy', $transfer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection