@extends('layouts.app')

@section('styles')
<style>
    .stat-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        opacity: 0.8;
        font-size: 2rem;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 600;
    }
    
    .stat-link {
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .stat-link:hover {
        background: rgba(255, 255, 255, 0.2);
    }
    
    .welcome-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <h4 class="mb-4 fw-bold">Dashboard Overview</h4>
    
    <div class="row g-4">
        <!-- Karyawan Card -->
        <div class="col-md-3">
            <div class="stat-card card h-100" style="background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="stat-icon text-white">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                            Karyawan
                        </span>
                    </div>
                    <h3 class="stat-number text-white mb-3">{{ \App\Models\Alternative::count() }}</h3>
                    <a href="{{ route('alternative.index') }}" class="stat-link d-inline-block text-white text-decoration-none small">
                        View Details <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kriteria Card -->
        <div class="col-md-3">
            <div class="stat-card card h-100" style="background: linear-gradient(135deg, #2eb85c 0%, #1b998b 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="stat-icon text-white">
                            <i class="fas fa-list-check"></i>
                        </div>
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                            Kriteria
                        </span>
                    </div>
                    <h3 class="stat-number text-white mb-3">{{ \App\Models\Criteria::count() }}</h3>
                    <a href="{{ route('criteria.index') }}" class="stat-link d-inline-block text-white text-decoration-none small">
                        View Details <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Penilaian Card -->
        <div class="col-md-3">
            <div class="stat-card card h-100" style="background: linear-gradient(135deg, #f9b115 0%, #f6960b 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="stat-icon text-white">
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                            Penilaian
                        </span>
                    </div>
                    <h3 class="stat-number text-white mb-3">{{ \App\Models\AlternativeScore::count() }}</h3>
                    <a href="{{ route('penilaian.index') }}" class="stat-link d-inline-block text-white text-decoration-none small">
                        View Details <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Hasil Ranking Card -->
        <div class="col-md-3">
            <div class="stat-card card h-100" style="background: linear-gradient(135deg, #3399ff 0%, #0dcaf0 100%);">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="stat-icon text-white">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill">
                            Ranking
                        </span>
                    </div>
                    <h3 class="stat-number text-white mb-3"><i class="fas fa-chart-bar"></i></h3>
                    <a href="{{ route('hasil.index') }}" class="stat-link d-inline-block text-white text-decoration-none small">
                        View Details <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="welcome-card card border-0 p-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-info-circle text-primary me-2 fa-lg"></i>
                        <h5 class="mb-0 fw-bold">Selamat Datang!</h5>
                    </div>
                    <p class="mb-0 text-muted">
                        Sistem Pendukung Keputusan Pemilihan Karyawan Terbaik menggunakan Metode AHP-TOPSIS.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection