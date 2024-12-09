@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Detail Akun</h1>
    <p><strong>Nama Nasabah:</strong> {{ $akun->nasabah->nama }}</p>
    <p><strong>Nomor Rekening:</strong> {{ $akun->nomor_rekening }}</p>
    <p><strong>Saldo:</strong> {{ number_format($akun->saldo, 2, ',', '.') }}</p>
    
    <h3>Riwayat Transaksi</h3>
    
    <div class="mt-4">
        <h5>Riwayat Transfer</h5>
        <table class="table">
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
                        <td>{{ $transfer->getPengirimNasabah()->nama ?? 'N/A' }}</td>
                        <td>{{ $transfer->getPenerimaNasabah()->nama ?? 'N/A' }}</td>
                        <td>{{ number_format($transfer->nominal, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($transfer->tanggal)->format('d-m-Y') }}</td>
                        <td>
                            <form action="{{ route('transfers.destroy', $transfer->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        <h5>Riwayat Top Up</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal Top Up</th>
                    <th>Nominal</th>
                    <th>Metode Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akun->transaksi()->where('tipe', 'topup')->orderBy('created_at', 'desc')->get() as $topup)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($topup->created_at)->format('d-m-Y') }}</td>
                        <td>{{ number_format($topup->nominal, 2) }}</td>
                        <td>{{ $topup->metode_pembayaran }}</td>
                        <td>
                            <form action="{{ route('topups.destroy', $topup->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection