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
                            <h4 class="one">Edit Data</h4>
                            <a href="{{ route('karyawan.index') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-backward"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('karyawan.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="oldPhoto" value="{{ $data->photo }}">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Karyawan</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="Inputkan Nama" autocomplete="off" autofocus
                                        value="{{ old('name', $data->name) }}">

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
                                        <option value="male"
                                            {{ old('gender', $data->gender) == 'male' ? 'selected' : '' }}>Laki - Laki
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $data->gender) == 'female' ? 'selected' : '' }}>Perempuan
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
                                    <textarea name="address" id="address" cols="50" rows="5"
                                        class="form-control @error('address') is-invalid @enderror">{!! old('address', $data->address) !!}</textarea>

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="photo">Foto</label>
                                    <input type="file" class="form-control" name="photo" id="photo">

                                    <img src="" alt="" id="img-view" width="50"
                                        class="img-thumbnail mt-1">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark float-right"><i class="fas fa-save"></i>
                                Update</button>
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
