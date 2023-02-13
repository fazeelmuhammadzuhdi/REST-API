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
                            <h4 class="one">Tampil Data</h4>
                            <a href="{{ route('karyawan.create') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-plus-circle"></i> Tambah
                                Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Karyawan</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th width="35%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($karyawan as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->name }}</th>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        {{-- <img src="{{ Storage::url($item->photo) }}" alt="" width="50"
                                            class="img-thumbnail"> --}}
                                        <img src="{{ asset('storage/photo/' . $item->photo) }}" alt="" width="50%"
                                            class="img-thumbnail">
                                    </td>
                                    <td>
                                        <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning"><i
                                                class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ route('karyawan.show', $item->id) }}" class="btn btn-info"><i
                                                class="fa fa-eye"></i> Detail</a>
                                        <form action="{{ route('karyawan.destroy', $item->id) }}" method="POST"
                                            class="d-inline-block"
                                            onclick="return confirm('Apakah Ingin Menghapus Data Ini ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger "><i class="fa fa-trash"></i>
                                                Delete</button>

                                        </form>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Data</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    @if (session('success') == true)
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
@endsection
