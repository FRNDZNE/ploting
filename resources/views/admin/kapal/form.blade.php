@extends('layouts.backend.app')
@if ($isCreate)
    @section('title','Tambah Kapal')
    @section('page','Tambah Kapal')
@else
    @section('title','Edit Kapal')
    @section('page','Edit Kapal')
@endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <form action="
                    @if ($isCreate)
                        {{ route('admin.kapal.store') }}
                    @else
                        {{ route('admin.kapal.update',$data->id) }}
                    @endif
                " 
                method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label class="form-label" for="nama">Nama Kapal <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="@if($isCreate){{ old('nama') }}@else{{ $data->nama }} @endif">
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="panjang">Panjang Kapal <span class="text-danger">*</span></label>
                                    <input type="number" name="panjang" id="panjang" class="form-control @error('panjang') is-invalid @enderror" min="0" value="@if($isCreate){{ old('panjang')}}@else{{ $data->panjang }}@endif">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="foto">Foto <span class="text-danger">*</span></label>
                                    <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                    @if (!$isCreate)
                                        <small>Abaikan Jika Tidak Ingin Mengganti Gambar</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.kapal.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" @if($isCreate) class="btn btn-primary" @else class="btn btn-warning" @endif>
                            @if ($isCreate)
                            Simpan
                            @else
                            Update                                
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@error('nama')
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "{{$message}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@enderror 
@error('panjang')
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "{{$message}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@enderror 
@error('foto')
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "{{$message}}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@enderror 
@endsection