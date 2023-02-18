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
                            <h4 class="one">Tampil Data</h4>
                            <a href="{{ route('students.create') }}" class="btn btn-primary ml-auto"><i
                                    class="fas fa-plus-circle"></i> Tambah
                                Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="tabel-data">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                                <th>No Nis</th>
                                <th>Kelas</th>
                                <th>Extracurricular</th>
                                <th>Nama Guru</th>
                                <th width="23%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->name }}</th>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->class->name }}</td>
                                    <td>
                                        @foreach ($item->extracurriculars as $data)
                                            - {{ $data->name }} <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->class->teacher->name }}</td>
                                    <td>
                                        <a href="{{ route('students.edit', $item->id) }}" class="btn btn-warning"><i
                                                class="fa fa-edit"></i> Edit</a>

                                        <form action="{{ route('students.destroy', $item->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            {{-- @method('DELETE') --}}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-danger show_confirm"
                                                data-toggle="tooltip"><i class="fa fa-trash"></i>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable();
        });
    </script>

    @if (session('success') == true)
        <script>
            // Swal.fire({
            //     position: 'center',
            //     icon: 'success',
            //     title: '{{ session('success') }}',
            //     showConfirmButton: false,
            //     timer: 2500
            // })

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
@endsection
