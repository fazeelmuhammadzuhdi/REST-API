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
                            <h4 class="one">Show Data</h4>
                            <a href="{{ route('karyawan.index') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-backward"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Karyawan</th>
                            <td>:</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:</td>
                            <td>{{ ucwords($data->gender) }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Karyawan</th>
                            <td>:</td>
                            <td>{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <th>Photo</th>
                            <td>:</td>
                            <td><img src="{{ asset('storage/photo/' . $data->photo) }}" alt="No Photo" width="50px"></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </section>
@endsection
