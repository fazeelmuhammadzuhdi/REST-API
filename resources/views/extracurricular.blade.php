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

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Extracurricular</th>
                                <th>Nama Anggota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($eksul as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->students as $data)
                                            <ul>
                                                <li>{{ $data->name }} <br></li>
                                            </ul>
                                        @endforeach
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
