@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transfer</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('transfers.update', $transfer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_pengirim">Nama Pengirim</label>
            <select name="pengirim_id" id="pengirim_id" class="form-control" required>
                <option value="">Pilih Pengirim</option>
                @foreach($akun as $a)
                    <option value="{{ $a->id }}" {{ $a->id == $transfer->pengirim_id ? 'selected' : '' }}>{{ $a->nasabah->nama }}</option>
                @endforeach
            </select>
         </div>
            <div class="form-group">
                <label for="nama_penerima">Nama Penerima</label>
                <select name="penerima_id" id="penerima_id" class="form-control" required>
                    <option value="">Pilih Penerima</option>
                    @foreach($akun as $a)
                        <option value="{{ $a->id }}" {{ $a->id == $transfer->penerima_id ? 'selected' : '' }}>{{ $a->nasabah->nama }}</option>
                    @endforeach
                </select>
            </div>

        <div class="form-group">
            <label for="nominal">Nominal</label>
            <input type="number" name="nominal" class="form-control" value="{{ old('nominal', $transfer->nominal) }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $transfer->tanggal) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Transfer</button>
    </form>
</div>
@endsection