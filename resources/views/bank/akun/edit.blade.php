@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Akun</h1>
    <form action="{{ route('akun.update', $akun->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nasabah</label>
            <select name="nasabah_id" class="form-control">
                @foreach($nasabah as $n)
                    <option value="{{ $n->id }}" {{ $akun->nasabah_id == $n->id ? 'selected' : '' }}>{{ $n->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nomor Rekening</label>
            <input type="text" name="nomor_rekening" value="{{ $akun->nomor_rekening }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Saldo</label>
            <input type="number" step="0.01" name="saldo" value="{{ $akun->saldo }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
