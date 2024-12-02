@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Daftar Nasabah</h1>
    <a href="{{ route('nasabah.create') }}" class="btn btn-primary">Tambah Nasabah</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No KTP</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nasabah as $n)
            <tr>
                <td>{{ $n->id }}</td>
                <td>{{ $n->nama }}</td>
                <td>{{ $n->no_ktp }}</td>
                <td>{{ $n->alamat }}</td>
                <td>{{ $n->no_telepon }}</td>
                <td>
                    <a href="{{ route('nasabah.edit', $n->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('nasabah.destroy', $n->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
