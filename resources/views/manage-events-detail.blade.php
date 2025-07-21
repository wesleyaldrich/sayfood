@extends('layout.app')
@section('title')
    Detail Event: {{ $event->name }}
@endsection

{{-- Tambahkan Font Awesome jika belum ada di layout utama Anda --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body {
        background-color: #f4f7f6;
    }
    .main-content {
        padding: 2rem;
    }
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e0e0e0;
    }
    .creator-info {
        display: flex;
        align-items: center;
    }
    .creator-info .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #e0e0e0;
        margin-right: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.5rem;
        color: #333;
    }
    .creator-info .name {
        font-weight: bold;
        font-size: 1.2rem;
    }
    .creator-info .id {
        color: #6c757d;
    }
    .action-buttons form {
        display: inline-block;
    }
    .details-card, .participants-card {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .details-card h5, .participants-card h5 {
        font-weight: bold;
        color: darkgreen;
        margin-bottom: 1.5rem;
    }
    .detail-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        color: #333;
    }
    .detail-item i {
        color: darkgreen;
        width: 20px;
        margin-right: 15px;
        margin-top: 4px;
    }
    .participants-count {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .participants-count .count {
        font-size: 2.5rem;
        font-weight: bold;
        color: darkgreen;
    }
    .participants-list {
        max-height: 400px;
        overflow-y: auto;
    }
</style>

@section('content')
<div class="container-fluid main-content">
    <!-- Header: Info Kreator dan Tombol Aksi -->
    <div class="header-section">
        <div class="creator-info">
            <div class="avatar"><i class="fas fa-user"></i></div>
            <div>
                <div class="name">{{ $event->creator->user->username ?? 'Nama Kreator' }}</div>
                <div class="id">ID: {{ $event->creator->id }}</div>
            </div>
        </div>
        
        {{-- Tampilkan tombol hanya jika statusnya 'Pending' --}}
        @if ($event->status == 'Pending')
        <div class="action-buttons">
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-times-circle me-1"></i> Reject
                </button>
            </form>
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check-circle me-1"></i> Approve
                </button>
            </form>
        </div>
        @endif
    </div>

    <div class="row">
        <!-- Kolom Kiri: Detail Event -->
        <div class="col-lg-8">
            <div class="details-card">
                <h5>Event Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-item">
                            <i class="fas fa-flag"></i>
                            <div><strong>Status</strong><br>
                                @php
                                    $statusClass = 'bg-secondary';
                                    if($event->status == 'Pending') $statusClass = 'bg-warning text-dark';
                                    if($event->status == 'Coming Soon') $statusClass = 'bg-info';
                                    if($event->status == 'On Going') $statusClass = 'bg-primary';
                                    if($event->status == 'Completed') $statusClass = 'bg-success';
                                    if($event->status == 'Rejected') $statusClass = 'bg-danger';
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $event->status }}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-tag"></i>
                            <div><strong>Creator ID</strong><br>{{ $event->creator_id }}</div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-envelope"></i>
                            <div><strong>Email</strong><br>{{ $event->creator->user->email ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div><strong>Date</strong><br>{{ \Carbon\Carbon::parse($event->date)->format('l, d F Y H:i') }}</div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div><strong>Address</strong><br>{{ $event->location }}</div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-tag"></i>
                            <div><strong>Category</strong><br>{{ $event->category->name }}</div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="detail-item">
                    <i class="fas fa-align-left"></i>
                    <div><strong>Description</strong><br>{{ $event->description }}</div>
                </div>
                {{-- Tambahkan item lain jika ada, seperti Group Link atau Certificate --}}
            </div>
        </div>

        <!-- Kolom Kanan: Partisipan (jika status sesuai) -->
        <div class="col-lg-4">
            @if(in_array($event->status, ['Coming Soon', 'On Going', 'Completed']))
            <div class="participants-card">
                <h5>Participants</h5>
                <div class="participants-count">
                    <div class="count">{{ $event->participants->count() }}</div>
                    <div>Total Participants</div>
                </div>
                <div class="participants-list">
                    <table class="table table-borderless table-sm">
                        <tbody>
                            @forelse($event->participants as $participant)
                            <tr>
                                <td>{{ $participant->id }}</td>
                                <td>{{ $participant->user->username }}</td> {{-- Sesuaikan dengan nama kolom di tabel user --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">No participants yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('show.manage.events') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
