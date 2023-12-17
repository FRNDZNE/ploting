@extends('layouts.backend.app')
@section('title','Detail')
@section('page','Detail')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if ($isDeleted)
                        <a href="{{ route('admin.history') }}" class="btn btn-secondary mb-3">Kembali</a>
                    @else
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary mb-3">Kembali</a>
                    @endif
                    <h3>Detail Kapal</h3>
                        <p><b>Nama : </b> {{ $data->nama }}</p>
                        <p><b>Panjang Kapal : </b> {{ $data->panjang }} meter</p>
                    <h3>Informasi Sandar</h3>
                        <p><b>Status : </b> {{ $data->sandar->status ? 'Aktif' : 'Rencana' }}</p>
                        <p><b>Mulai : </b> {{ $data->sandar->start }}</p>
                        <p><b>Selesai : </b> {{ $data->sandar->finish }}</p>
                        <p><b>Posisi Titik : </b> {{ $data->sandar->rangestart }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset($data->foto) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection