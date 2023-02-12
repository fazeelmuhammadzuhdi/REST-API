@extends('Auth.app')
@section('content')
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('/') }}assets/img/stisla-fill.svg" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register.auth') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input id="name" name="name" type="name"
                                            class="form-control @error('name')
                                            is-invalid @enderror"
                                            name="name" tabindex="1" autofocus value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" type="email"
                                            class="form-control @error('email')
                                            is-invalid @enderror"
                                            name="email" tabindex="1" autofocus value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" name="password"
                                            class="form-control  @error('password')
                                            is-invalid @enderror"
                                            name="password" tabindex="2">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="text-muted text-center mb-3">
                                <a href="{{ route('admin.login') }}">Kembali Ke Halaman Login</a>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
