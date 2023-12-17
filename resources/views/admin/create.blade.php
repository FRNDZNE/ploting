@extends('layouts.backend.app')
@section('title','Tambah Kapal')
@section('page','Tambah Kapal')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama">Nama Kapal</label>
                                    <input type="text" name="nama" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="panjang">Panjang Kapal</label>
                                    <input type="number" name="panjang" id="panjang" class="form-control" min="0">
                                    <small>panjang kapal dalam satuan meter</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rangestart">Titik Sandar</label>
                                    <input type="number" name="rangestart" id="rangestart" class="form-control" min="0" maxlength="820">
                                    <small>Panjang Dermaga adalah 820 Meter</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start">Mulai</label>
                                    <input type="datetime-local" name="start" id="start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="finish">Selesai</label>
                                    <input type="datetime-local" name="finish" id="finish" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="aktif" class="form-check-input" value="1">
                                                <label for="aktif" class="form-check label">Aktif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="rencana" class="form-check-input" value="0">
                                                <label for="rencana" class="form-check label">Rencana</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection