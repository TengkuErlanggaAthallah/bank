@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Akun</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('akun.create') }}" class="btn btn-primary">Tambah Akun</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Nasabah</th>
                <th>Nomor Rekening</th>
                <th>Saldo</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($akun as $a)
            <tr>
                <td>{{ $a->id }}</td>
                <td>{{ $a->nasabah->nama }}</td>
                <td>{{ $a->nomor_rekening }}</td>
                <td>{{ number_format($a->saldo, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('akun.edit', $a->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('akun.destroy', $a->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3">
        {{ $akun->links() }} <!-- This will render pagination links -->
    </div>
</div>
@endsection