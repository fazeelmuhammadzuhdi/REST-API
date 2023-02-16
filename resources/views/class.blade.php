@extends('layout.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kelas</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                            <h4 class="one">Tampil Data</h4>
                            <button type="button" class="btn btn-info ml-auto" id="btn-tambah" data-toggle="modal"
                                data-target="#modal-info">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kelas</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Info Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('class.store') }}" method="POST" id="forms">
                        @csrf
                        <div class="form-group">
                            <label for="name">Kelas</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Inputkan Kelas">
                            <input type="text" hidden class="form-control" name="id" id="id"
                                placeholder="Inputkan Kelas">
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" name="batal" id="btn-tutup" class="btn btn-outline-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" id="simpan" class="btn btn-outline-light">Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('class.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            });
        });

        $(document).on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                typeData: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('#btn-tutup').click()
                    $('#table').DataTable().ajax.reload()
                    $('#name').val('');
                    toastr.success(response.text, 'Success')
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.text, 'Gagal!')
                }
            });
        })

        $(document).on('click', '.edit', function() {
            $('#forms').attr('action', "{{ route('class.update') }}")
            let id = $(this).attr('id')
            $.ajax({
                type: "post",
                url: "{{ route('class.edit') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    $('#id').val(response.id)
                    $('#name').val(response.name)
                    $('#btn-tambah').click()
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        })

        $(document).on('click', '.hapus', function() {
            let id = $(this).attr('id')
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('class.hapus') }}",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response, status) {
                            if (status = '200') {
                                setTimeout(() => {
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Data Berhasil Di Hapus',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((response) => {
                                        $('#table').DataTable().ajax.reload()
                                    })
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Gagal Menghapus!',
                            })
                        }
                    });
                }
            })
        })
    </script>
@endsection
