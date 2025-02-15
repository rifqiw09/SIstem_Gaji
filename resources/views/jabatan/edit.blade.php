@extends('layouts.app')

@section('content')
<div class="form-container">
    <div class="card">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold">Edit Jabatan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                    <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                           id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}"
                           placeholder="Masukkan nama jabatan">
                    @error('nama_jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                               id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok', $jabatan->gaji_pokok) }}"
                               placeholder="Masukkan gaji pokok">
                    </div>
                    @error('gaji_pokok')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tunjangan" class="form-label">Tunjangan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control @error('tunjangan') is-invalid @enderror" 
                               id="tunjangan" name="tunjangan" value="{{ old('tunjangan', $jabatan->tunjangan) }}"
                               placeholder="Masukkan tunjangan">
                    </div>
                    @error('tunjangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
