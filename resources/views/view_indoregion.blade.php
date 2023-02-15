@extends('layout.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blank Page</h1>
        </div>



        <div class="section-body">

            <div class="form-group col-md-6">
                <label for="provinsi">Nama Provinsi</label>
                <select name="provinsi" id="provinsi" class="form-control">
                    <option value="">--Pilih Provinsi--</option>
                    @foreach ($provinces as $provinsi)
                        <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="kabupaten">Nama Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control">

                </select>
            </div>


            <div class="form-group col-md-6">
                <label for="kecamatan">Nama Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="form-control">

                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="desa">Nama Desa</label>
                <select name="desa" id="desa" class="form-control">

                </select>


            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(function() {
            $('#provinsi').on('change', function() {
                //mengambil id provinsi
                let id_provinsi = $('#provinsi').val();
                let token = $("meta[name='csrf-token']").attr("content");
                // console.log(id_provinsi);

                $.ajax({
                    type: "POST",
                    url: "{{ route('getkabupaten') }}",
                    data: {
                        "id_provinsi": id_provinsi,
                        "_token": token
                    },
                    cache: false,
                    success: function(response) {
                        $('#kabupaten').html(response);
                        $('#kecamatan').html('');
                        $('#desa').html('');
                    },
                    error: function(xhr) {
                        console.log('Error :', xhr);
                    }
                });
            });

            $('#kabupaten').on('change', function() {
                //mengambil id kabupaten
                let id_kabupaten = $('#kabupaten').val();
                let token = $("meta[name='csrf-token']").attr("content");
                // console.log(id_kabupaten);

                $.ajax({
                    type: "POST",
                    url: "{{ route('getkecamatan') }}",
                    data: {
                        "id_kabupaten": id_kabupaten,
                        "_token": token
                    },
                    cache: false,
                    success: function(response) {
                        $('#kecamatan').html(response);
                        $('#desa').html('');
                    },
                    error: function(xhr) {
                        console.log('Error :', xhr);
                    }
                });
            });

            $('#kecamatan').on('change', function() {
                //mengambil id kecamatan
                let id_kecamatan = $('#kecamatan').val();
                let token = $("meta[name='csrf-token']").attr("content");
                // console.log(id_kecamatan);

                $.ajax({
                    type: "POST",
                    url: "{{ route('getdesa') }}",
                    data: {
                        "id_kecamatan": id_kecamatan,
                        "_token": token
                    },
                    cache: false,
                    success: function(response) {
                        $('#desa').html(response);
                        // $('#kecamatan').html('');
                        // $('#desa').html('');
                    },
                    error: function(xhr) {
                        console.log('Error :', xhr);
                    }
                });
            });
        })
    </script>
@endsection
