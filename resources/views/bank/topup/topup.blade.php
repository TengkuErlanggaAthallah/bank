@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Top Up Saldo</div>
                <div class="card-body">
                    <form action="{{ route('topup.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="account_id" class="form-label">Pilih Rekening</label>
                            <select class="form-select" id="account_id" name="account_id" required>
                                <option value="" disabled selected>Pilih Rekening</option>
                                @foreach($akun as $a)
                                    <option value="{{ $a->id }}">{{ $a->nomor_rekening }} - {{ $a->nasabah->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah Top Up</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="credit_card">Kartu Kredit</option>
                                <option value="e_wallet">E-Wallet</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Top Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection