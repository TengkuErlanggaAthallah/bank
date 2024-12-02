@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Tambah Akun</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('akun.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nasabah_id">Nasabah</label>
            <select name="nasabah_id" id="nasabah_id" class="form-control" required>
                <option value="">Pilih Nasabah</option>
                @foreach($nasabah as $n)
                    <option value="{{ $n->id }}">{{ $n->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nomor_rekening">Nomor Rekening</label>
            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" required pattern="\d{10,12}" title="Nomor rekening harus terdiri dari 10 hingga 12 digit angka." placeholder="Contoh: 1234567890">
        </div>
        <div class="mb-3">
            <label for="saldo">Saldo (IDR)</label>
            <input type="text" name="saldo" id="saldo" class="form-control" required onkeyup="formatRupiah(this)">
            <small class="form-text text-muted">Masukkan saldo dalam format angka.</small>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<script>
    function formatRupiah(input) {
        // Remove non-numeric characters
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let integerPart = split[0];
        let decimalPart = split.length > 1 ? ',' + split[1] : '';

        // Format the integer part with thousands separator
        integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        // Combine integer and decimal parts
        input.value = integerPart + decimalPart;
    }
</script>
@endsection