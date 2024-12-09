@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Transfer Uang</h1>

    <form action="{{ route('transfer.store') }}" method="POST"> <!-- Perbaiki rute ini -->
        @csrf
        <div class="form-group">
            <label for="nama_pengirim">Nama Pengirim</label>
            <select name="pengirim_id" id="pengirim_id" class="form-control" required>
                <option value="">Pilih Pengirim</option>
                @foreach($akun as $a)
                    <option value="{{ $a->id }}">{{ $a->nasabah->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nama_penerima">Nama Penerima</label>
            <select name="penerima_id" id="penerima_id" class="form-control" required>
                <option value="">Pilih Penerima</option>
                @foreach($akun as $a)
                    <option value="{{ $a->id }}">{{ $a->nasabah->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nominal">Nominal Transfer</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required oninput="formatNominal(this)">
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal Transfer</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
</div>

@section('scripts')
<script>
    // Validasi input hanya angka
    document.getElementById('nominal').addEventListener('input', function(e) {
        var inputValue = e.target.value;
        // Filter input untuk hanya menerima angka
        e.target.value = inputValue.replace(/[^0-9]/g, '');
    });

    document.getElementById('pengirim_id').addEventListener('change', function() {
        var selectedPengirimId = this.value;
        var penerimaSelect = document.getElementById('penerima_id');

        // Reset penerima select
        penerimaSelect.innerHTML = '<option value="">Pilih Penerima</option>';

        // Get all options from akun
        var options = @json($akun);
        options.forEach(function(akun) {
            // If the account ID is not the same as the selected pengirim, add it to penerima
            if (akun.id != selectedPengirimId) {
                var option = document.createElement('option');
                option.value = akun.id;
                option.text = akun.nasabah.nama; // Pastikan ini sesuai dengan struktur data
                penerimaSelect.appendChild(option);
            }
        });
    });
</script>
@endsection
@endsection