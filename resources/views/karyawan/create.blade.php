@extends('layout.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Karyawan</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <h4 class="one">Buat Data</h4>
                            <a href="{{ route('karyawan.index') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-backward"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Karyawan</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Inputkan Nama" autocomplete="off" autofocus
                                        value="{{ old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender"
                                        class="form-control @error('gender') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki - Laki
                                        </option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>

                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Alamat Karyawan</label>
                                    <textarea name="address" id="address" cols="50" rows="3"
                                        class="form-control @error('gender') is-invalid @enderror">{{ old('address') }}</textarea>

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="photo">Foto</label>
                                    <input type="file" class="form-control" name="photo" id="photo">

                                    <img src="" alt="" id="img-view" width="50" class="mt-3">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info"><i class="fas fa-save"></i>
                                Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
