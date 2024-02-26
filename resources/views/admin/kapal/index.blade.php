@extends('layouts.backend.app')
@if (!$isDeleted)
@section('title','Master Kapal')
@section('page','Master Kapal')
@else
@section('title','History Master Kapal')
@section('page','History Master Kapal')
@endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (!$isDeleted)
                        <a href="{{ route('admin.kapal.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kapal</a>
                        <hr>
                    @endif
                    <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kapal</th>
                                <th>Gambar</th>
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
                                <td>
                                    {{-- Detail Button --}}
                                        <!-- Modal trigger button -->
                                        <button
                                            type="button"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetail-{{ $kapal->id }}"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div
                                            class="modal fade"
                                            id="modalDetail-{{ $kapal->id }}"
                                            tabindex="-1"
                                            data-bs-backdrop="static"
                                            data-bs-keyboard="false"
                                            
                                            role="dialog"
                                            aria-labelledby="modalTitleId"
                                            aria-hidden="true"
                                        >
                                            <div
                                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
                                                role="document"
                                            >
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            Detail Kapal
                                                        </h5>
                                                        <button
                                                            type="button"
                                                            class="btn-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                        ></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <img src="{{ asset($kapal->foto) }}" class="img-fluid" alt="Foto Rusak">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><span class="fw-bold">Nama Kapal : </span>{{ $kapal->nama }}</p>
                                                                <p><span class="fw-bold">Panjang Kapal : </span>{{ $kapal->panjang }} Meter</p>
                                                            </div>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Optional: Place to the bottom of scripts -->
                                        <script>
                                            const myModal = new bootstrap.Modal(
                                                document.getElementById("modalDetail-{{ $kapal->id }}"),
                                                options,
                                            );
                                        </script>
                                        
                                    {{-- End Detail Button --}}
                                    @if (!$isDeleted)
                                        {{-- Edit Button --}}
                                            <a href="{{ route('admin.kapal.edit',$kapal->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        {{-- End Edit BUtton --}}
                                        {{-- Delete Button --}}
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalDelete-{{ $kapal->id }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade"
                                                id="modalDelete-{{ $kapal->id }}"
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
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Hapus Master Kapal
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Menghapus "{{ $kapal->nama }}" dari Master Kapal ?</p>    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('admin.kapal.delete',$kapal->id) }}" method="post">
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
                                                    document.getElementById("modalDelete-{{ $kapal->id }}"),
                                                    options,
                                                );
                                            </script>
                                            
                                        {{-- End Delete Button --}}
                                    @else
                                        {{-- Restore Button --}}
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalrestore-{{ $kapal->id }}"
                                            >
                                                <i class="fas fa-redo"></i>
                                            </button>
                                            
                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade"
                                                id="modalrestore-{{ $kapal->id }}"
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
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title" id="modalTitleId">
                                                                Restore Kapal
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Restore Kapal "{{ $kapal->nama }}" ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('admin.kapal.restore',$kapal->id) }}" method="post">
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
                                                    document.getElementById("modalrestore-{{ $kapal->id }}"),
                                                    options,
                                                );
                                            </script>
                                            
                                        {{-- End Restore Button --}}
                                        {{-- Destroy Button --}}
                                            <!-- Modal trigger button -->
                                            <button
                                                type="button"
                                                class="btn btn-dark btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modaldestroy-{{ $kapal->id }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            
                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div
                                                class="modal fade"
                                                id="modaldestroy-{{ $kapal->id }}"
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
                                                                Hapus Permanen Kapal
                                                            </h5>
                                                            <button
                                                                type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"
                                                            ></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Ingin Hapus Permanen Kapal "{{ $kapal->nama }}" ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                Kembali
                                                            </button>
                                                            <form action="{{ route('admin.kapal.destroy',$kapal->id) }}" method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-dark">Hapus Permanen</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Optional: Place to the bottom of scripts -->
                                            <script>
                                                const myModal = new bootstrap.Modal(
                                                    document.getElementById("modaldestroy-{{ $kapal->id }}"),
                                                    options,
                                                );
                                            </script>
                                            
                                        {{-- End Destroy Button --}}
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