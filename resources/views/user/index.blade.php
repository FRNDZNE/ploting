@extends('layouts.backend.app')
@section('title','User Managemenet')
@section('page','Daftar User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (!$isDeleted)
                            <!-- Button trigger modal -->
                            <button
                                type="button"
                                class="btn btn-primary btn-md"
                                data-bs-toggle="modal"
                                data-bs-target="#modalId"
                            >
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                            
                            <!-- Modal -->
                            <div
                                class="modal fade"
                                id="modalId"
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
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white" id="modalTitleId">
                                                Tambah Admin
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>
                                        </div>
                                        <form action="{{ route('user.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror   
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                                    @error('email')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror  
                                                </div>
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control">
                                                    @error('password')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror  
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Kembali
                                                </button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $u)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>
                                        @if (!$isDeleted)
                                            <!-- Button trigger modal -->
                                            <button
                                                type="button"
                                                class="btn btn-warning btn-md"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modaledit-{{ $u->id }}"
                                            >
                                                <i class="fas fa-edit text-white"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div
                                                class="modal fade"
                                                id="modaledit-{{ $u->id }}"
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
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-white" id="modalTitleId">
                                                                Edit Akun
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <form action="{{ route('user.update') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="{{ $u->id }}">
                                                                <div class="form-group">
                                                                    <label for="name" class="form-label">Nama</label>
                                                                    <input type="text" name="name" id="name" class="form-control" value="{{ $u->name }}">
                                                                    @error('name')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror  
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" name="email" id="email" class="form-control" value="{{ $u->email }}">
                                                                    @error('email')
                                                                        <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="password" class="form-label">Password</label>
                                                                    <input type="password" name="password" id="password" class="form-control">
                                                                    <small>abaikan jika tidak ingin mengganti password</small>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                                >
                                                                Kembali
                                                                </button>
                                                                <button type="submit" class="btn btn-warning text-white">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button trigger modal -->
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-md"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modaldelete-{{ $u->id }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div
                                                class="modal fade"
                                                id="modaldelete-{{ $u->id }}"
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
                                                        <div class="modal-header bg-header">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Hapus Akun
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Menghapus {{ $u->name }} ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('user.delete', $u->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @else
                                            <!-- Button trigger modal -->
                                            <button
                                                type="button"
                                                class="btn btn-success btn-md"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalrestore-{{ $u->id }}"
                                            >
                                                <i class="fas fa-redo text-white"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div
                                                class="modal fade"
                                                id="modalrestore-{{ $u->id }}"
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
                                                            <h5 class="modal-title text-white" id="modalTitleId">
                                                                Restore Akun
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Restore Akun {{ $u->name }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('user.restore',$u->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success">Restore</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Button trigger modal -->
                                            <button
                                                type="button"
                                                class="btn btn-dark btn-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modaldestroy-{{ $u->id }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div
                                                class="modal fade"
                                                id="modaldestroy-{{ $u->id }}"
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
                                                            <p>Hapus permanen {{ $u->name }} ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('user.destroy',$u->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-dark">Hapus Permanen</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endif
                                    </td>
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