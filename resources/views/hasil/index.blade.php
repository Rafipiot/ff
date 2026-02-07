@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Hasil Perangkingan Karyawan</h5>
    </div>
    <div class="card-body">
        @if($rankings->isEmpty())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                Belum ada data penilaian yang bisa diproses. 
                Silahkan input penilaian terlebih dahulu.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" width="5%">Ranking</th>
                            <th>Nama Karyawan</th>
                            <th class="text-center" width="15%">Posisi</th>
                            <th class="text-center" width="15%">Jenis Kelamin</th>
                            <th class="text-center" width="15%">Lama Bekerja</th>
                            <th class="text-center" width="15%">Nilai Preferensi</th>
                            <th class="text-center" width="15%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rankings as $ranking)
                            <tr>
                                <td class="text-center">{{ $ranking['rank'] }}</td>
                                <td>{{ $ranking['alternative']->nama }}</td>
                                <td class="text-center">{{ ucfirst($ranking['alternative']->posisi) }}</td>
                                <td class="text-center">{{ $ranking['alternative']->jenis_kelamin === 'L' ? 'Laki-laki' : ($ranking['alternative']->jenis_kelamin === 'P' ? 'Perempuan' : $ranking['alternative']->jenis_kelamin) }}</td>
                                <td class="text-center">{{ $ranking['alternative']->lama_bekerja_label }}</td>
                                <td class="text-center">{{ number_format($ranking['score'], 4) }}</td>
                                <td class="text-center">
                                    @if($ranking['rank'] == 1)
                                        <span class="badge bg-success">
                                            <i class="fas fa-trophy"></i> Terbaik
                                        </span>
                                    @elseif($ranking['rank'] <= 3)
                                        <span class="badge bg-info">
                                            <i class="fas fa-star"></i> Sangat Baik
                                        </span>
                                    @elseif($ranking['score'] >= 0.5)
                                        <span class="badge bg-primary">
                                            <i class="fas fa-thumbs-up"></i> Baik
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="fas fa-exclamation"></i> Cukup
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-info-circle"></i> Keterangan</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">Interpretasi Nilai Preferensi:</p>
                        <ul>
                            <li>Nilai mendekati 1 = Kinerja sangat baik</li>
                            <li>Nilai mendekati 0.5 = Kinerja cukup</li>
                            <li>Nilai mendekati 0 = Kinerja perlu ditingkatkan</li>
                        </ul>
                        
                        <p class="mb-2">Status Karyawan:</p>
                        <ul class="mb-0">
                            <li><span class="badge bg-success">Terbaik</span> = Ranking 1</li>
                            <li><span class="badge bg-info">Sangat Baik</span> = Ranking 2-3</li>
                            <li><span class="badge bg-primary">Baik</span> = Nilai ≥ 0.5</li>
                            <li><span class="badge bg-warning">Cukup</span> = Nilai < 0.5</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection