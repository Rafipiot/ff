@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Input Penilaian Karyawan</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-info">
            <h6>Panduan Penilaian:</h6>
            <p class="mb-1">Untuk kriteria benefit (Semakin tinggi semakin baik):</p>
            <ul class="mb-1">
                <li>1 = Sangat Kurang</li>
                <li>2 = Kurang</li>
                <li>3 = Cukup</li>
                <li>4 = Baik</li>
                <li>5 = Sangat Baik</li>
            </ul>
            <p class="mb-1">Untuk kriteria cost (Semakin rendah semakin baik):</p>
            <ul class="mb-0">
                <li>1 = Sangat Baik (0-1 kali/bulan)</li>
                <li>2 = Baik (2-3 kali/bulan)</li>
                <li>3 = Cukup (4-5 kali/bulan)</li>
                <li>4 = Kurang (6-7 kali/bulan)</li>
                <li>5 = Sangat Kurang (>7 kali/bulan)</li>
            </ul>
        </div>

        <form action="{{ route('penilaian.store') }}" method="POST">
            @csrf
            @foreach($alternatives as $alternative)
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">{{ $alternative->nama }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($criterias as $criteria)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ $criteria->nama }}
                                        ({{ $criteria->bobot * 100 }}%)
                                        @if($criteria->tipe == 'benefit')
                                            <span class="badge bg-success">Benefit</span>
                                        @else
                                            <span class="badge bg-danger">Cost</span>
                                        @endif
                                    </label>
                                    <select name="scores[{{ $alternative->id }}][{{ $criteria->id }}]" 
                                            class="form-select @error('scores.'.$alternative->id.'.'.$criteria->id) is-invalid @enderror"
                                            required>
                                        <option value="">Pilih Nilai</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('scores.'.$alternative->id.'.'.$criteria->id)
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Penilaian
                </button>
                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection