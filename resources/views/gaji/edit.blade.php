@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="card">
        <div class="card-header bg-white py-3">
            <h5 class="m-0 font-weight-bold">Edit Gaji Karyawan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('gaji.update', $gaji->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                    <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                            id="karyawan_id" name="karyawan_id">
                        <option value="">Pilih Karyawan</option>
                        @foreach($karyawan as $k)
                            <option value="{{ $k->id }}" 
                                data-gaji="{{ $k->jabatan->gaji_pokok }}"
                                data-tunjangan="{{ $k->jabatan->tunjangan }}"
                                {{ old('karyawan_id', $gaji->karyawan_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }} - {{ $k->jabatan->nama_jabatan }}
                            </option>
                        @endforeach
                    </select>
                    @error('karyawan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="bulan" class="form-label">Bulan</label>
                            <select class="form-select @error('bulan') is-invalid @enderror" 
                                    id="bulan" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                    <option value="{{ $bulan }}" {{ old('bulan', $gaji->bulan) == $bulan ? 'selected' : '' }}>
                                        {{ $bulan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <select class="form-select @error('tahun') is-invalid @enderror" 
                                    id="tahun" name="tahun">
                                <option value="">Pilih Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 5;
                                @endphp
                                @for($year = $startYear; $year <= $endYear; $year++)
                                    <option value="{{ $year }}" {{ old('tahun', $gaji->tahun) == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gaji_pokok" class="form-label">Nominal Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control @error('gaji_pokok') is-invalid @enderror"
                               id="gaji_pokok_display" name="gaji_pokok_display" 
                               value="{{ old('gaji_pokok_display', number_format($gaji->gaji_pokok, 0, ',', '.')) }}"
                               readonly>
                    </div>
                    <input type="hidden" id="gaji_pokok" name="gaji_pokok" 
                           value="{{ old('gaji_pokok', $gaji->gaji_pokok) }}">
                    @error('gaji_pokok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tunjangan" class="form-label">Nominal Tunjangan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control @error('tunjangan') is-invalid @enderror"
                               id="tunjangan_display" name="tunjangan_display" 
                               value="{{ old('tunjangan_display', number_format($gaji->tunjangan, 0, ',', '.')) }}"
                               readonly>
                    </div>
                    <input type="hidden" id="tunjangan" name="tunjangan" 
                           value="{{ old('tunjangan', $gaji->tunjangan) }}">
                    @error('tunjangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="potongan" class="form-label">Nominal Potongan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('potongan') is-invalid @enderror"
                               id="potongan" name="potongan" value="{{ old('potongan', $gaji->potongan) }}"
                               min="0" step="1000">
                    </div>
                    @error('potongan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Status Pembayaran</label>
                    <select class="form-select @error('keterangan') is-invalid @enderror"
                            id="keterangan" name="keterangan">
                        <option value="">Pilih Status</option>
                        <option value="Success" {{ old('keterangan', $gaji->keterangan) == 'Success' ? 'selected' : '' }}>Success</option>
                        <option value="Delayed" {{ old('keterangan', $gaji->keterangan) == 'Delayed' ? 'selected' : '' }}>Delayed</option>
                    </select>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('gaji.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Format number to Indonesian Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
    
    // Handle employee selection change
    $('#karyawan_id').change(function() {
        const selectedOption = $(this).find('option:selected');
        const gajiPokok = selectedOption.data('gaji');
        const tunjangan = selectedOption.data('tunjangan');
        
        // Set the displayed formatted values
        $('#gaji_pokok_display').val(gajiPokok ? formatRupiah(gajiPokok) : '');
        $('#tunjangan_display').val(tunjangan ? formatRupiah(tunjangan) : '');
        
        // Set the actual values in hidden fields
        $('#gaji_pokok').val(gajiPokok || '');
        $('#tunjangan').val(tunjangan || '');
    });

    // If there's a selected employee on page load (e.g. from old input)
    if ($('#karyawan_id').val()) {
        $('#karyawan_id').trigger('change');
    }
});
</script>
@endpush
@endsection
