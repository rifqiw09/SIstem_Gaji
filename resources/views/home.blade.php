@extends('layouts.app')

@section('content')
<div class="dashboard">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-muted">{{ date('l, d F Y') }}</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stats-card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Jabatan</h6>
                            <h2 class="card-title mb-0">{{ count($jabatan) }}</h2>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-sitemap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Karyawan</h6>
                            <h2 class="card-title mb-0">{{ count($karyawan) }}</h2>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stats-card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2">Total Penggajian</h6>
                            <h2 class="card-title mb-0">{{ count($gaji) }}</h2>
                        </div>
                        <div class="stats-icon">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data Section -->
    <div class="row">
        <!-- Recent Jabatan -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-sitemap text-primary"></i> 
                        Data Jabatan Terbaru
                    </h5>
                    <a href="{{ route('jabatan.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Jabatan</th>
                                    <th class="text-end">Gaji Pokok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jabatan as $jab)
                                <tr>
                                    <td>{{ $jab->nama_jabatan }}</td>
                                    <td class="text-end">Rp {{ number_format($jab->gaji_pokok, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-3">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Karyawan -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-users text-success"></i> 
                        Data Karyawan Terbaru
                    </h5>
                    <a href="{{ route('karyawan.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($karyawan as $kar)
                                <tr>
                                    <td>{{ $kar->nama }}</td>
                                    <td>{{ $kar->jabatan->nama_jabatan }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center py-3">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Gaji -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-money-bill-wave text-info"></i> 
                        Data Gaji Terbaru
                    </h5>
                    <a href="{{ route('gaji.create') }}" class="btn btn-sm btn-info text-white">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gaji as $g)
                                <tr>
                                    <td>{{ $g->karyawan->nama }}</td>
                                    <td>{{ $g->bulan }} {{ $g->tahun }}</td>
                                    <td>
                                        @if($g->keterangan == 'Success')
                                            <span class="badge bg-success">Success</span>
                                        @else
                                            <span class="badge bg-warning">Delayed</span>
                                        @endif
                                    </td>
                                    <td class="text-end">Rp {{ number_format($g->total_gaji, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard {
    padding: 1.5rem;
}

.welcome-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.stats-card {
    border-radius: 10px;
    border: none;
    transition: transform 0.2s;
}

.stats-card:hover {
    transform: translateY(-5px);
}

.stats-icon {
    background: rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 10px;
}

.card {
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.table th {
    font-weight: 600;
    background: rgba(0,0,0,0.02);
}

.table td {
    vertical-align: middle;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
}
</style>
@endsection
