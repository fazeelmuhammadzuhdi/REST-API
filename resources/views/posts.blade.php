@extends('layout.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>CRUD MENGGUNAKAN AJAX</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0)" class="btn btn-primary mb-2" id="btn-create-post"><i
                            class="fas fa-plus-circle"></i>
                        Tambah</a>
                </div>
                <div class="card-body">
                    <div class="section-title mt-0">Tampil Data</div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-posts">
                            @foreach ($posts as $post)
                                <tr id="index_{{ $post->id }}">
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $post->id }}"
                                            class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $post->id }}"
                                            class="btn btn-danger btn-sm">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
    @include('components.modal_create')
    @include('components.modal_edit')
    @include('components.delete')
@endsection
