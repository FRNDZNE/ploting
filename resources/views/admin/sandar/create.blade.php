@extends('layouts.backend.app')
@section('title','Tambah Jadwal')
@section('page','Tambah Jadwal')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.sandar.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <h3>Informasi Kapal</h3>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama Kapal <span class="text-danger">*</span></label>
                                    <select name="kapal_id" id="kapal" class="form-control @error('kapal_id') is-invalid @enderror">
                                        <option value="0">Pilih Kapal</option>
                                        @foreach ($kapal as $k)
                                            <option value="{{ $k->id }}" @if(old('kapal_id') == $k->id) selected="selected" @endif>{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kapal_id')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h3>Informasi Plotting</h3>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="rangestart">KD Meter Sandar <span class="text-danger">*</span></label>
                                    <input type="number" name="rangestart" id="rangestart" class="form-control @error('rangestart') is-invalid @enderror" min="0" maxlength="3" value="{{ old('rangestart') }}">
                                    @error('rangestart')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="datetime-datepicker-start">Mulai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="start" id="datetime-datepicker-start" class="form-control @error('start') is-invalid @enderror flatpickr-input" value="{{ old('start') }}" >
                                    @error('start')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="datetime-picker-finish">Selesai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="finish" id="datetime-datepicker-finish" class="form-control @error('finish') is-invalid @enderror flatpickr-input" value="{{ old('finish') }}">
                                    @error('finish')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <div class="row mb-1">
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="aktif" class="form-check-input" value="1" @if(old('status') == 1) checked @endif>
                                                <label for="aktif" class="form-check label">Aktif</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check mt-1">
                                                <input type="radio" name="status" id="rencana" class="form-check-input" value="0" @if(old('status') == 0) checked @endif>
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
                                <input type="text" name="bongkar" id="bongkar" class="form-control">
                                <small>cth : Kendaraan, Bungkil, dll</small>    
                            </div>
                            <div class="col-md-4">
                                <label for="jlhbongkar" class="form-label">Jumlah</label>
                                <input type="number" min="0" name="jlhbongkar" id="jlhbongkar" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="stbongkar" class="form-label">Satuan</label>
                                <select name="stbongkar" id="stbongkar" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="m">Ton / M/3</option>
                                    <option value="u">Unit</option>
                                    <option value="b">Box</option>
                                </select>
                            </div>
                        </div>
                        <h3>Informasi Muat</h3>
                        <p>Abaikan Jika Tidak Ingin Mengisi</p>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label for="muat" class="form-label">Nama Muatan</label>
                                <input type="text" name="muat" id="muat" class="form-control">
                                <small>cth : Kendaraan, Bungkil, dll</small>    
                            </div>
                            <div class="col-md-4">
                                <label for="jlhmuat" class="form-label">Jumlah</label>
                                <input type="number" min="0" name="jlhmuat" id="jlhmuat" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="stmuat" class="form-label">Satuan</label>
                                <select name="stmuat" id="stmuat" class="form-control">
                                    <option value="">Pilih Satuan</option>
                                    <option value="m">Ton / M/3</option>
                                    <option value="u">Unit</option>
                                    <option value="b">Box</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.sandar.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection