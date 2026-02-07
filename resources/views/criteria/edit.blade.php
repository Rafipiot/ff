@extends('layouts.app')

@section('content')
<div class="card">
   <div class="card-header">
       <h5 class="mb-0">Edit Kriteria</h5>
   </div>
   <div class="card-body">
       <form action="{{ route('criteria.update', $criterion) }}" method="POST">
           @csrf
           @method('PUT')
           <div class="mb-3">
               <label for="nama" class="form-label">Nama Kriteria</label>
               <input type="text" 
                      class="form-control @error('nama') is-invalid @enderror" 
                      id="nama" 
                      name="nama" 
                      value="{{ old('nama', $criterion->nama) }}" 
                      required>
               @error('nama')
                   <div class="invalid-feedback">
                       {{ $message }}
                   </div>
               @enderror
           </div>

           <div class="mb-3">
               <label for="bobot" class="form-label">Bobot (0-1)</label>
               <input type="number" 
                      class="form-control @error('bobot') is-invalid @enderror" 
                      id="bobot" 
                      name="bobot" 
                      value="{{ old('bobot', $criterion->bobot) }}" 
                      step="0.01"
                      min="0"
                      max="1"
                      required>
               @error('bobot')
                   <div class="invalid-feedback">
                       {{ $message }}
                   </div>
               @enderror
           </div>

           <div class="mb-3">
               <label for="tipe" class="form-label">Tipe Kriteria</label>
               <select class="form-select @error('tipe') is-invalid @enderror" 
                       id="tipe" 
                       name="tipe" 
                       required>
                   <option value="">Pilih Tipe</option>
                   <option value="benefit" {{ (old('tipe', $criterion->tipe) == 'benefit') ? 'selected' : '' }}>
                       Benefit (Semakin tinggi semakin baik)
                   </option>
                   <option value="cost" {{ (old('tipe', $criterion->tipe) == 'cost') ? 'selected' : '' }}>
                       Cost (Semakin rendah semakin baik)
                   </option>
               </select>
               @error('tipe')
                   <div class="invalid-feedback">
                       {{ $message }}
                   </div>
               @enderror
           </div>

           <div class="d-flex gap-2">
               <button type="submit" class="btn btn-primary">
                   <i class="fas fa-save"></i> Update
               </button>
               <a href="{{ route('criteria.index') }}" class="btn btn-secondary">
                   <i class="fas fa-arrow-left"></i> Kembali
               </a>
           </div>
       </form>
   </div>
</div>
@endsection