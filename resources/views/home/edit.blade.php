<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            Edit Pendaftaran | SPP Rumah Sakit
        </title>
    </head>
    @extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

    @section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Pendaftaran Pasien'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0">Edit Pendaftaran Pasien</h5>
                            <a href="{{  url('home') }}" class="btn btn-sm btn-outline-danger btn-rounded ms-auto">
                                <i class="fa fa-arrow-left me-sm-1"></i>
                                <span class="d-sm-inline d-none">Kembali</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('home.update', $pendaftaran->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="nama_pasien" value="{{$pendaftaran['nama_pasien']}}" class="form-control" placeholder="Masukkan nama pasien">
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
                                    <input type="date" name="tanggal_lahir" value="{{$pendaftaran['tanggal_lahir']}}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Registrasi</label>
                                        <select name="jenis_registrasi" class="form-control">
                                            <option value="{{$pendaftaran['jenis_registrasi']}}">{{$pendaftaran['jenis_registrasi']}}</option>
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
                                            <option value="{{$pendaftaran['layanan']}}">{{$pendaftaran['layanan']}}</option>
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
                                            <option value="{{$pendaftaran['jenis_pembayaran']}}">{{$pendaftaran['jenis_pembayaran']}}</option>
                                            <option value="Umum">Umum</option>
                                            <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                                            <option value="Mandiri Inhealth">Mandiri Inhealth</option>
                                            <option value="BNI Life">BNI Life</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status Registrasi</label>
                                    <select name="status_registrasi" class="form-control">
                                        <option value="{{$pendaftaran['status_registrasi']}}">{{$pendaftaran['status_registrasi']}}</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tutup Kunjungan">Tutup Kunjungan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Mulai Pelayanan</label>
                                        <input type="datetime-local" name="waktu_mulai_pelayanan" value="{{$pendaftaran['waktu_mulai_pelayanan']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Waktu Selesai Pelayanan</label>
                                        <input type="datetime-local" name="waktu_selesai_pelayanan" value="{{$pendaftaran['waktu_selesai_pelayanan']}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Petugas Pendaftaran</label>
                                    <select name="petugas_pendaftaran" class="form-control">
                                        @foreach($petugas as $item)
                                        <option value="{{$pendaftaran['petugas_pendaftaran']}}">{{$pendaftaran['petugas_pendaftaran']}}</option>
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