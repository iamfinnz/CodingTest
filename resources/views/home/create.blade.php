<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            Tambah Pendaftaran | SPP Rumah Sakit
        </title>
    </head>
    @extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

    @section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah Pendaftaran Pasien'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Tambah Pendaftaran Pasien</h5>
                            <a href="{{  url('home') }}" class="btn btn-sm btn-outline-danger btn-rounded ms-auto">
                                <i class="fa fa-arrow-left me-sm-1"></i>
                                <span class="d-sm-inline d-none">Kembali</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan nama pasien">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <br />
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
                                    </label>
                                    <label>
                                        <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Registrasi</label>
                                        <select name="jenis_registrasi" class="form-control">
                                            <option value="" selected disabled hidden>Pilih jenis registrasi</option>
                                            <option value="Rawat Jalan">Rawat Jalan</option>
                                            <option value="UGD">UGD</option>
                                            <option value="Rawat Inap">Rawat Inap</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Layanan</label>
                                        <select name="layanan" class="form-control">
                                            <option value="" selected disabled hidden>Pilih layanan</option>
                                            <option value="Poliknik Umum">Poliknik Umum</option>
                                            <option value="Poliknik Gigi">Poliknik Gigi</option>
                                            <option value="Poliknik Mata">Poliknik Mata</option>
                                            <option value="UGD">UGD</option>
                                            <option value="Kelas 1">Kelas 1</option>
                                            <option value="Kelas 2">Kelas 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Pembayaran</label>
                                        <select name="jenis_pembayaran" class="form-control">
                                            <option value="" selected disabled hidden>Pilih jenis pembayaran</option>
                                            <option value="Umum">Umum</option>
                                            <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                                            <option value="Mandiri Inhealth">Mandiri Inhealth</option>
                                            <option value="BNI Life">BNI Life</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Waktu Mulai Pelayanan</label>
                                    <input type="datetime-local" name="waktu_mulai_pelayanan" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Petugas Pendaftaran</label>
                                    <select name="petugas_pendaftaran" class="form-control">
                                        @foreach($petugas as $item)
                                        <option value="" selected disabled hidden>Pilih nama petugas</option>
                                        <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-5 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary btn-rounded">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Mengisi dropdown dengan data nama pekerja dari server
            $.get('/get-nama-petugas', function(data) {
                $.each(data, function(key, value) {
                    $('#petugas_pendaftaran').append($('<option>').text(value).attr('value', key));
                });
            });
        });
    </script>
    @endsection

    </html>