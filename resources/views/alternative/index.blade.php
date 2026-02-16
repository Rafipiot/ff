@extends('layouts.app')



@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">Data Karyawan</h5>

        <a href="{{ route('alternative.create') }}" class="btn btn-primary">

            <i class="fas fa-plus"></i> Tambah Karyawan

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

                        <th width="5%">No</th>

                        <th>Nama Karyawan</th>

                        <th width="15%">Jenis Kelamin</th>

                        <th width="15%">Lama Bekerja</th>

                        <th width="20%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($alternatives as $key => $alternative)

                        <tr>

                            <td>{{ $key + 1 }}</td>

                            <td>{{ $alternative->nama }}</td>

                            <td>{{ $alternative->jenis_kelamin === 'L' ? 'Laki-laki' : ($alternative->jenis_kelamin === 'P' ? 'Perempuan' : $alternative->jenis_kelamin) }}</td>

                            <td>{{ $alternative->lama_bekerja }}</td>

                            <td>

                                <a href="{{ route('alternative.edit', $alternative->id) }}" 

                                   class="btn btn-sm btn-warning">

                                    <i class="fas fa-edit"></i> Edit

                                </a>

                                <form action="{{ route('alternative.destroy', $alternative->id) }}" 

                                      method="POST" 

                                      class="d-inline"

                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger">

                                        <i class="fas fa-trash"></i> Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">Tidak ada data karyawan</td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection