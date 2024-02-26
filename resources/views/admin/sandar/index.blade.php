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
                    @if (!$isDeleted)
                        <a href="{{ route('admin.sandar.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Jadwal</a>
                        <hr>
                    @endif
                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Di Upload Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->kapal->nama }}</td>  
                                    <td>{{ $d->mulai }}</td>
                                    <td>{{ $d->selesai }}</td>
                                    <td>{{ $d->created_by }}</td>
                                    <td>
                                        {{-- Detail Button --}}
                                            <a href="{{ route('admin.sandar.detail',$d->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        {{-- End Detail Button --}}
                                        @if (!$isDeleted)
                                            {{-- Edit Button --}}
                                                <a href="{{ route('admin.sandar.edit',$d->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            {{-- End Edit Button --}}
                                            {{-- Delete Button --}}
                                                <!-- Modal trigger button -->
                                                <button
                                                    type="button"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete-{{ $d->id }}"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="modalDelete-{{ $d->id }}"
                                                    tabindex="-1"
                                                    data-bs-backdrop="static"
                                                    data-bs-keyboard="false"
                                                    
                                                    role="dialog"
                                                    aria-labelledby="modalTitleId"
                                                    aria-hidden="true"
                                                >
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                        role="document"
                                                    >
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Hapus Jadwal
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Hapus Jadwal Kapal "{{ $d->kapal->nama }}" Yang Sandar Pada {{ $d->mulai }} Hingga {{ $d->selesai }} ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                >
                                                                    Kembali
                                                                </button>
                                                                <form action="{{ route('admin.sandar.delete',$d->id) }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(
                                                        document.getElementById("modalDelete-{{ $d->id }}"),
                                                        options,
                                                    );
                                                </script>
                                                
                                            {{-- End Delete Button --}}
                                            {{-- Set Keterangan Button --}}
                                                <!-- Modal trigger button -->
                                                <button
                                                    type="button"
                                                    class="btn btn-dark btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalKet-{{ $d->id }}"
                                                >
                                                    <i class="fas fa-comment-alt"></i>
                                                </button>
                                                
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="modalKet-{{ $d->id }}"
                                                    tabindex="-1"
                                                    data-bs-backdrop="static"
                                                    data-bs-keyboard="false"
                                                    
                                                    role="dialog"
                                                    aria-labelledby="modalTitleId"
                                                    aria-hidden="true"
                                                >
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
                                                        role="document"
                                                    >
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-dark">
                                                                <h5 class="modal-title text-white" id="modalTitleId">
                                                                    Keterangan
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></button>
                                                            </div>
                                                            <form action="{{ route('admin.sandar.keterangan') }}" method="post">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $d->id }}">
                                                                    <div class="form-group">
                                                                        <label for="" class="form-label">Keterangan</label>
                                                                        <input type="text" name="info" id="" class="form-control" value="{{ $d->info }}">
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
                                                                    <button type="submit" class="btn btn-dark">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(
                                                        document.getElementById("modalKet-{{ $d->id }}"),
                                                        options,
                                                    );
                                                </script>
                                                
                                            {{-- End Set Keterangan Button --}}
                                        @else
                                            {{-- Restore Button --}}
                                                <!-- Modal trigger button -->
                                                <button
                                                    type="button"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalrestore-{{ $d->id }}"
                                                >
                                                    <i class="fas fa-redo"></i>
                                                </button>
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="modalrestore-{{ $d->id }}"
                                                    tabindex="-1"
                                                    data-bs-backdrop="static"
                                                    data-bs-keyboard="false"
                                                    
                                                    role="dialog"
                                                    aria-labelledby="modalTitleId"
                                                    aria-hidden="true">
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-success">
                                                                <h5 class="modal-title" id="modalTitleId">
                                                                    Restore Kapal
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Ingin Restore Kapal Jadwal "{{ $d->kapal->nama }}" Yang Sandar Pada {{ $d->mulai }} Hingga {{ $d->selesai }} ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Kembali
                                                                </button>
                                                                <form action="{{ route('admin.sandar.restore',$d->id) }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-success">Restore</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(
                                                        document.getElementById("modalrestore-{{ $d->id }}"),
                                                        options,
                                                    );
                                                </script>
                                            {{-- End Restore Button --}}
                                            {{-- Delete Button --}}
                                                <!-- Modal trigger button -->
                                                <button
                                                    type="button"
                                                    class="btn btn-dark btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDestroy-{{ $d->id }}"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                
                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div
                                                    class="modal fade"
                                                    id="modalDestroy-{{ $d->id }}"
                                                    tabindex="-1"
                                                    data-bs-backdrop="static"
                                                    data-bs-keyboard="false"
                                                    
                                                    role="dialog"
                                                    aria-labelledby="modalTitleId"
                                                    aria-hidden="true"
                                                >
                                                    <div
                                                        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
                                                        role="document"
                                                    >
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-dark">
                                                                <h5 class="modal-title text-white" id="modalTitleId">
                                                                    Hapus Permanen Jadwal
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"
                                                                ></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Hapus Permanen Jadwal Kapal "{{ $d->kapal->nama }}" Yang Sandar Pada {{ $d->mulai }} Hingga {{ $d->selesai }} ?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal"
                                                                >
                                                                    Kembali
                                                                </button>
                                                                <form action="{{ route('admin.sandar.destroy',$d->id) }}" method="post">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-dark">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(
                                                        document.getElementById("modalDestroy-{{ $d->id }}"),
                                                        options,
                                                    );
                                                </script>
                                            {{-- End Delete Button --}}
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