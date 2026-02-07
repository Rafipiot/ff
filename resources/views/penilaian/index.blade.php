@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Penilaian Karyawan</h5>
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Input Penilaian
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        @foreach($criterias as $criteria)
                            <th>
                                {{ $criteria->nama }}
                                <br>
                                <small>
                                    ({{ $criteria->bobot * 100 }}%)
                                    @if($criteria->tipe == 'benefit')
                                        <span class="badge bg-success">Benefit</span>
                                    @else
                                        <span class="badge bg-danger">Cost</span>
                                    @endif
                                </small>
                            </th>
                        @endforeach
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alternatives as $key => $alternative)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $alternative->nama }}</td>
                            @foreach($criterias as $criteria)
                                <td class="text-center">
                                    {{ $alternative->scores->where('criteria_id', $criteria->id)->first()->nilai ?? '-' }}
                                </td>
                            @endforeach
                            <td>
                                <a href="{{ route('penilaian.edit', $alternative->id) }}" 
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($criterias) + 3 }}" class="text-center">
                                Tidak ada data penilaian
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection