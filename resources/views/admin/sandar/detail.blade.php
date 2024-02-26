@extends('layouts.backend.app')
@section('title','Detail')
@section('page','Detail')
@section('content')
<div class="container">
    @if ($isDeleted)
        <a href="{{ route('admin.sandar.history') }}" class="btn btn-secondary mb-3">Kembali</a>
    @else
        <a href="{{ route('admin.sandar.index') }}" class="btn btn-secondary mb-3">Kembali</a>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" src="{{ asset($data->kapal->foto) }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    
                    <h3>Detail Kapal</h3>
                    <p><b>Nama : </b> {{ $data->kapal->nama }}</p>
                    <p><b>Panjang Kapal : </b> {{ $data->kapal->panjang }} meter</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>Informasi Sandar</h3>
                    <p><b>Status : </b> {{ $data->status ? 'Aktif' : 'Rencana' }}</p>
                    <p><b>Mulai : </b> {{ $data->mulai }}</p>
                    <p><b>Selesai : </b> {{ $data->selesai }}</p>
                    <p><b>Posisi Titik : </b> {{ $data->rangestart }}</p>
                    <p><b>Keterangan : </b> {{ $data->info ? $data->info : '-' }}</p>

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>Informasi Bongkar</h3>
                    <p><b>Bongkar :</b> {{ $data->bongkar->nama ? $data->bongkar->nama : '-' }}</p>
                    <p><b>Jumlah :</b> {{ $data->bongkar->jumlah ? $data->bongkar->jumlah : '-'}}</p>
                    <p><b>Satuan :</b> {{ $data->bongkar->satuan == 'm' ? 'Ton / M3' : ($data->bongkar->satuan == 'u' ? 'Unit' : ($data->bongkar->satuan == 'b' ? 'Box' : '-')) }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3>Informasi Muat</h3>
                    <p><b>Muat :</b> {{ $data->muat->nama ? $data->muat->nama : '-' }}</p>
                    <p><b>Jumlah :</b> {{ $data->muat->jumlah ? $data->muat->jumlah : '-' }}</p>
                    <p><b>Satuan :</b> {{ $data->muat->satuan == 'm' ? 'Ton / M3' : ($data->muat->satuan == 'u' ? 'Unit' : ($data->muat->satuan == 'b' ? 'Box' : '-')) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection