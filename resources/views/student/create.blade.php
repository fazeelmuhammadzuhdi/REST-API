@extends('layout.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Data Students</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <h4 class="one">Buat Data</h4>
                            <a href="{{ route('students.index') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-backward"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Siswa</label>
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
                                    <label for="nis">No NIS Siswa</label>
                                    <input type="number" name="nis"
                                        class="form-control @error('nis') is-invalid @enderror" id="nis"
                                        placeholder="Inputkan No NISN" autocomplete="off" autofocus
                                        value="{{ old('nis') }}">

                                    @error('nis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>

                                <div class="form-group col-md-6">
                                    <label for="class_id">Kelas</label>
                                    <select name="class_id" id="class_id"
                                        class="form-control @error('class_id') is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Kelas --</option>
                                        @foreach ($class as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('class_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

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
