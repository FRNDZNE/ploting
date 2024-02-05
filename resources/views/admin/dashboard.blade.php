@extends('layouts.backend.app')
@section('title','Dashboard')
@section('page','Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="text-center">
                        @php
                            $kapal = count($data['kapal']);
                            // $sandar = count($data['sandar']);
                            // $rencana = count($data['rencana']);
                            // $selesai = count($data['selesai']);
                        @endphp
                        <h2 class="fw-normal text-primary" data-plugin="counterup">{{ $kapal }}</h2>
                        <h5>Kapal Terdata</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="text-center">
                        <h2 class="fw-normal text-success" data-plugin="counterup"></h2>
                        <h5>Sedang Sandar</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="text-center">
                        <h2 class="fw-normal text-warning" data-plugin="counterup"></h2>
                        <h5>Terencana</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="text-center">
                        <h2 class="fw-normal text-info" data-plugin="counterup"></h2>
                        <h5>Selesai</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection