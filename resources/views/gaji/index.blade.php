@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 95%;">
    <div class="card">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold">Data Gaji</h5>
            <a href="{{ route('gaji.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select id="bulan_filter" class="form-select">
                        <option value="">Semua Bulan</option>
                        @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="status_filter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Success">Success</option>
                        <option value="Delayed">Delayed</option>
                    </select>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">No</th>
                            <th style="width: 15%">Bulan</th>
                            <th style="width: 20%">Nama Karyawan</th>
                            <th style="width: 15%">Gaji Pokok</th>
                            <th style="width: 15%">Tunjangan</th>
                            <th style="width: 10%">Total Gaji</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gaji as $index => $item)
                            <tr class="gaji-row" 
                                data-bulan="{{ $item->bulan }}"
                                data-status="{{ $item->keterangan }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->karyawan->nama }}</td>
                                <td>Rp {{ number_format($item->karyawan->jabatan->gaji_pokok, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->karyawan->jabatan->tunjangan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->total_gaji, 0, ',', '.') }}</td>
                                <td>
                                    @if($item->keterangan == 'Success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-warning">Delayed</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('gaji.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('gaji.destroy', $item->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="no-data-row" style="display: none;">
                                <td colspan="8" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    function filterTable() {
        const bulanFilter = $('#bulan_filter').val();
        const statusFilter = $('#status_filter').val();
        let visibleRows = 0;

        $('.gaji-row').each(function() {
            const row = $(this);
            const bulan = row.data('bulan');
            const status = row.data('status');
            
            const bulanMatch = !bulanFilter || bulan === bulanFilter;
            const statusMatch = !statusFilter || status === statusFilter;
            
            if (bulanMatch && statusMatch) {
                row.show();
                visibleRows++;
            } else {
                row.hide();
            }
        });

        // Show "no data" message if no rows are visible
        if (visibleRows === 0) {
            $('#no-data-row').show();
        } else {
            $('#no-data-row').hide();
        }
    }

    $('#bulan_filter, #status_filter').change(filterTable);
});
</script>
@endpush
@endsection
