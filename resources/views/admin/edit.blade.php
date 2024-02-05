@extends('layouts.backend.app')
@section('title','Edit Kapal')
@section('page','Edit Kapal')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.update',$data->id) }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <h3>Informasi Kapal</h3>
                        <div class="row mb-2">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama Kapal</label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"  value="{{ $data->nama }}">
                                    @error('nama')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="panjang">Panjang Kapal</label>
                                    <input type="number" name="panjang" id="panjang" class="form-control @error('panjang') is-invalid @enderror" min="0" value="{{ $data->panjang }}">
                                    @error('panjang')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="foto">Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <h3>Informasi Ploting</h3>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="rangestart">KD Meter Sandar</label>
                                    <input type="number" name="rangestart" id="rangestart" class="form-control @error('rangestart') is-invalid @enderror" min="0" maxlength="3" value="{{ $data->sandar->rangestart }}">
                                    @error('rangestart')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="datetime-datepicker-start">Mulai</label>
                                    <input type="datetime-local" name="start" id="datetime-datepicker-start" class="form-control @error('start') is-invalid @enderror flatpickr-input" value="{{ $data->sandar->start }}" >
                                    @error('start')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="datetime-picker-finish">Selesai</label>
                                    <input type="datetime-local" name="finish" id="datetime-datepicker-finish" class="form-control @error('finish') is-invalid @enderror flatpickr-input" value="{{ $data->sandar->finish }}">
                                    @error('finish')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="row mb-1">
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="aktif" class="form-check-input" value="1" @if ($data->sandar->status == '1') checked @endif>
                                                <label for="aktif" class="form-check label">Aktif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="rencana" class="form-check-input" value="0" @if ($data->sandar->status == '0') checked @endif>
                                                <label for="rencana" class="form-check label">Rencana</label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                        <small style="color: red ; opacity : 0.8;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h3>Informasi Bongkar</h3>
                        <p>Abaikan Jika Tidak Ingin Mengisi</p>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="bongkar" class="form-label">Nama Bongkaran</label>
                                <input type="text" name="bongkar" id="bongkar" class="form-control" value="{{$data->bongkar->nama}}">
                                <small>cth : Kendaraan, Bungkil, dll</small>    
                            </div>
                            <div class="col-md-4">
                                <label for="jlhbongkar" class="form-label">Jumlah</label>
                                <input type="number" min="0" name="jlhbongkar" id="jlhbongkar" class="form-control" value="{{$data->bongkar->jumlah}}">
                            </div>
                            <div class="col-md-4">
                                <label for="stbongkar" class="form-label">Satuan</label>
                                <select name="stbongkar" id="stbongkar" class="form-control">
                                    <option value="0">Pilih Satuan</option>
                                    <option value="m" @if($data->bongkar->satuan == 'm') selected @endif >Ton / M/3</option>
                                    <option value="u" @if($data->bongkar->satuan == 'u') selected @endif>Unit</option>
                                    <option value="b" @if($data->bongkar->satuan == 'b') selected @endif>Box</option>
                                </select>
                            </div>
                        </div>
                        <h3>Informasi Muat</h3>
                        <p>Abaikan Jika Tidak Ingin Mengisi</p>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="muat" class="form-label">Nama Muatan</label>
                                <input type="text" name="muat" id="muat" class="form-control" value="{{$data->muat->nama}}">
                                <small>cth : Kendaraan, Bungkil, dll</small>    
                            </div>
                            <div class="col-md-4">
                                <label for="jlhmuat" class="form-label">Jumlah</label>
                                <input type="number" min="0" name="jlhmuat" id="jlhmuat" class="form-control" value="{{$data->muat->jumlah}}">
                            </div>
                            <div class="col-md-4">
                                <label for="stmuat" class="form-label">Satuan</label>
                                <select name="stmuat" id="stmuat" class="form-control">
                                    <option value="0">Pilih Satuan</option>
                                    <option value="m" @if($data->muat->satuan == 'm') selected @endif >Ton / M/3</option>
                                    <option value="u" @if($data->muat->satuan == 'u') selected @endif>Unit</option>
                                    <option value="b" @if($data->muat->satuan == 'b') selected @endif>Box</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection