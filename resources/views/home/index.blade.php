<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--   CSS Toastr   -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>
            Dashboard | SPP Rumah Sakit
        </title>
    </head>
    @extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

    @section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pendaftaran</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlahPendaftaran }}
                                    </h5>
                                    <p class="mb-0">
                                        <a class="text-success text-sm font-weight-bolder" href="{{ url('home')}}">Selengkapnya</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary shadow-primary text-center rounded-circle">
                                    <i class="fa fa-dashboard text-lg opacity-10 mb-2" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Petugas Pendaftaran</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $jumlahPetugas }}
                                    </h5>
                                    <p class="mb-0">
                                        <a class="text-success text-sm font-weight-bolder" href="{{ url('petugas')}}">Selengkapnya</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-secondary shadow-danger text-center rounded-circle">
                                    <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Tabel Pendaftaran Pasien</h5>
                        <a class="btn btn-primary btn-rounded float-start mt-4" href="{{ url('create') }}">
                            <i class="fa fa-plus me-sm-1"></i>
                            <span class="d-sm-inline d-none">Tambah</span>
                        </a>
                        <a class="btn btn-success btn-rounded float-end mt-4" href="{{ url('export-excel') }}">
                            <i class="fa fa-file-export me-sm-1"></i>
                            <span class="d-sm-inline d-none">Export Excel</span>
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 m-4">
                            <table class="table align-items-center mb-0" id="tb_pendaftaran">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bolder">
                                            No</th>
                                        <th class="text-center font-weight-bolder ps-2">
                                            Waktu Registrasi</th>
                                        <th class="text-center font-weight-bolder">
                                            No Registrasi</th>
                                        <th class="text-center font-weight-bolder">
                                            No Rekam Medis</th>
                                        <th class="text-center font-weight-bolder">
                                            Nama Pasien</th>
                                        <th class="text-center font-weight-bolder">
                                            Jenis Kelamin</th>
                                        <th class="text-center font-weight-bolder">
                                            Tanggal Lahir</th>
                                        <th class="text-center font-weight-bolder">
                                            Jenis Registrasi</th>
                                        <th class="text-center font-weight-bolder">
                                            Layanan</th>
                                        <th class="text-center font-weight-bolder">
                                            Jenis Pembayaran</th>
                                        <th class="text-center font-weight-bolder">
                                            Status Registrasi</th>
                                        <th class="text-center font-weight-bolder">
                                            Waktu Mulai Pelayanan</th>
                                        <th class="text-center font-weight-bolder">
                                            Waktu Selesai Pelayanan</th>
                                        <th class="text-center font-weight-bolder">
                                            Petugas Pendaftaran</th>
                                        <th class="text-center font-weight-bolder">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    @php $i=1; @endphp
                                    @forelse ($pendaftaran as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->waktu_registrasi)->format('d/m/y H:i') }}</td>
                                        <td>{{ $data->no_registrasi }}</td>
                                        <td>{{ $data->no_rekam_medis }}</td>
                                        <td>{{ $data->nama_pasien }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>{{ $data->tanggal_lahir }}</td>
                                        <td>{{ $data->jenis_registrasi }}</td>
                                        <td>{{ $data->layanan }}</td>
                                        <td>{{ $data->jenis_pembayaran }}</td>
                                        <td>
                                            @if($data->status_registrasi == 'Aktif')
                                            <span class="badge bg-primary mb-0">Aktif</span>
                                            @else
                                            <span class="badge bg-success mb-0">Tutup Kunjungan</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($data->waktu_mulai_pelayanan)->format('d/m/y H:i') }}</td>
                                        @if($data->waktu_selesai_pelayanan == null)
                                        <td>{{ '-' }}</td>
                                        @else
                                        <td>{{ \Carbon\Carbon::parse($data->waktu_selesai_pelayanan)->format('d/m/y H:i') }}</td>
                                        @endif
                                        <td>{{ $data->petugas_pendaftaran }}</td>
                                        <td>
                                            @if($data->status_registrasi == 'Aktif')
                                            <form action="{{ route('home.update', $data->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-warning btn-rounded" onclick="return confirm('Anda yakin ingin menutup kunjungan ini?')"> <i class="fa fa-edit me-sm-1"></i>
                                                    Tutup Kunjungan</button>
                                            </form>
                                            @else
                                            @endif
                                            
                                            @if($data->status_registrasi == 'Tutup Kunjungan')
                                            <form action="{{ route('home.destroy', $data->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger btn-rounded" onclick="return confirm('Anda yakin ingin menghapus data pendaftaran ini?')"> <i class="fa fa-close me-sm-1"></i>
                                                    Hapus</button>
                                            </form>
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">No Record Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Toastr -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                            <script>
                                @if(Session::has('status'))
                                toastr.success("{{ Session::get('status') }}")
                                @endif
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    </html>