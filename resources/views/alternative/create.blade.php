@extends('layouts.app')



@section('content')

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">Tambah Karyawan</h5>

    </div>

    <div class="card-body">

        <form action="{{ route('alternative.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label for="nama" class="form-label">Nama Karyawan</label>

                <input type="text" 

                       class="form-control @error('nama') is-invalid @enderror" 

                       id="nama" 

                       name="nama" 

                       value="{{ old('nama') }}" 

                       required>

                @error('nama')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>



            <div class="mb-3">

                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                <select class="form-control @error('jenis_kelamin') is-invalid @enderror"

                        id="jenis_kelamin"

                        name="jenis_kelamin"

                        required>

                    <option value="">-- Pilih --</option>

                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>

                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>

                </select>

                @error('jenis_kelamin')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>



            <div class="mb-3">

                <label for="lama_bekerja" class="form-label">Lama Bekerja (Tahun)</label>

                <input type="number"

                       class="form-control @error('lama_bekerja') is-invalid @enderror"

                       id="lama_bekerja"

                       name="lama_bekerja"

                       value="{{ old('lama_bekerja') }}"

                       min="0"

                       required>

                @error('lama_bekerja')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>



            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="fas fa-save"></i> Simpan

                </button>

                <a href="{{ route('alternative.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i> Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection