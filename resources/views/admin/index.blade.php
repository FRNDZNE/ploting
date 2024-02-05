@extends('layouts.backend.app')
@if ($isDeleted)
@section('title','History Ploting Kapal')
@section('page','History Ploting Kapal')
@else
@section('title','Ploting Kapal')
@section('page','Ploting Kapal')
@endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($isDeleted)
                        <hr>
                    @else
                        <a href="{{ route('admin.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kapal</a>
                        <hr>
                    @endif
                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                <th>Gambar</th>
                                <th>Di Upload Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kapal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kapal->nama }}</td>
                                <td>
                                    <img src="{{ asset($kapal->foto) }}" style="width: 200px; height:auto" alt="Foto Rusak">
                                </td>
                                <td>{{ $kapal->created_by }}</td>
                                @if ($isDeleted)
                                    <td>
                                        {{-- Start Action for not deleted data --}}
                                        <a href="{{ route('admin.history.detail',$kapal->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <!-- Button trigger modal -->
                                        <button
                                                type="button"
                                                class="btn btn-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalRestore-{{ $kapal->id }}"
                                            >
                                            <i class="fas fa-redo"></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div
                                            class="modal fade"
                                            id="modalRestore-{{ $kapal->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                            >
                                            <div
                                                class="modal-dialog modal-md"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Pulihkan Data
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Ingin memulihkan data dari {{ $kapal->nama }}?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('admin.restore',$kapal->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Pulihkan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Force Delete Button --}}
                                        <!-- Button trigger modal -->
                                        <button
                                            type="button"
                                            class="btn btn-dark"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modaldestroy-{{ $kapal->id }}"
                                            >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div
                                            class="modal fade"
                                            id="modaldestroy-{{ $kapal->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                            >
                                            <div
                                                class="modal-dialog modal-md"
                                                role="document"
                                                >
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark">
                                                        <h5 class="modal-title text-white" id="modalTitleId">
                                                            Hapus Permanen
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Ingin Hapus {{ $kapal->nama }} secara permanen?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                        >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('admin.destroy',$kapal->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-dark">Hapus Permanen</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        {{-- Start Action for not deleted data --}}
                                        <a href="{{ route('admin.detail',$kapal->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.edit',$kapal->id) }}" class="btn btn-warning"><i class="fas fa-edit text-white"></i></a>
                                        <!-- Modal trigger button -->
                                        <!-- Button trigger modal -->
                                        <!-- Button trigger modal -->
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalketerangan-{{ $kapal->id }}"
                                        >
                                            <i class="fas fa-comment-alt"></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div
                                            class="modal fade"
                                            id="modalketerangan-{{ $kapal->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-md"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary">
                                                        <h5 class="modal-title text-white" id="modalTitleId">
                                                            {{ $kapal->nama }}
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <form action="{{ route('admin.keterangan') }}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $kapal->id }}">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="keterangan" class="form-label">Keterangan</label>
                                                                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $kapal->sandar->info }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-white"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Close
                                                            </button>
                                                            <button type="submit" class="btn btn-secondary">Save</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <button
                                            type="button"
                                            class="btn btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDelete-{{ $kapal->id }}"
                                            >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div
                                            class="modal fade"
                                            id="modalDelete-{{ $kapal->id }}"
                                            tabindex="-1"
                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                            >
                                            <div
                                                class="modal-dialog modal-md"
                                                role="document"
                                                >
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Hapus Data
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Ingin menghapus {{ $kapal->nama }} dari jadwal?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary"
                                                            data-bs-dismiss="modal"
                                                            >
                                                            Close
                                                        </button>
                                                        <form action="{{ route('admin.delete',$kapal->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection