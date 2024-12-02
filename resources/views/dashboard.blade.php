<!-- Head -->
<head>
    <style>
        /* Warna latar belakang aktif */
        .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }

        /* CSS untuk tabel */
        .table td, .table th {
            word-wrap: break-word; /* Memecah kata jika terlalu panjang */
            overflow-wrap: break-word; /* Alternatif untuk word-wrap */
            max-width: 200px; /* Tentukan lebar maksimum untuk kolom */
        }
    </style>
</head>

<!-- Extends layouts.main -->
@extends('layouts.main')

<!-- Section content -->
@section('content')
    <main class="app-main">
        <!-- App Content Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Dashboard</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- App Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Nasabah -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $totalNasabah }}</h3> <!-- Display the total number of Nasabah -->
                                <p>Total Nasabah</p>
                            </div>
                            <svg class="small-box-icon" ... ></svg>
                            <a href="{{ route('nasabah.index') }}" class="small-box-footer">More info <i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </div>

                <!-- List of Nasabah -->
                <div class="row">
                    <div class="col-12">
                        <h4>List Nasabah</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No KTP</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nasabahList as $index => $nasabah)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nasabah->nama }}</td>
                                        <td>{{ $nasabah->no_ktp }}</td>
                                        <td>{{ $nasabah->alamat }}</td>
                                        <td>{{ $nasabah->no_telepon }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection