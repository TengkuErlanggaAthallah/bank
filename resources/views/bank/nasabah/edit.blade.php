@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Nasabah</h1>
    <form action="{{ route('nasabah.update', $nasabah->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $nasabah->nama }}" required>
        </div>
        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" class="form-control" value="{{ $nasabah->no_ktp }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $nasabah->alamat }}" required>
        </div>
        <div class="mb-3">
            <label>No Telepon</label>
            <input type="text" name="no_telepon" class="form-control" value="{{ $nasabah->no_telepon }}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
