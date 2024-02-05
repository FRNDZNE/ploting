@extends('layouts.frontend.app')
@section('title','Login')
@section('content')
   <div class="page-content page-login" data-aos="fade-down" data-aos-delay="800">
      <section class="login" >
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
              <img
                src="{{ asset('/') }}/frontend/images/loginimage.png"
                alt=""
                class="w-50 mb-4 mb-lg-none" />
            </div>
            <div class="col-lg-5">
              <h2 class="text-center">LOGIN</h2>
              <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">Username</label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    autofocus @error('name') is-invalid @enderror value="{{ old('name') }}">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" @error('password') is-invalid @enderror />
                  @error('password')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <a href="{{ url('/') }}" class="btn btn-back">Kembali</a>
                <button type="submit" href="/" class="btn btn-sign">Sign In</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
@endsection