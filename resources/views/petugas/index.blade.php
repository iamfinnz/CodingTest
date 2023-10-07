<DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--   CSS Toastr   -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>
            Kelola Petugas | SPP Rumah Sakit
        </title>
    </head>
    @extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

    @section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Kelola Petugas'])
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h5>Tabel Petugas Pendaftaran</h5>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 m-4">
                            <table class="table align-items-center mb-0" id="tb_petugas">
                                <thead>
                                    <tr>
                                        <th class="text-center font-weight-bolder">
                                            No</th>
                                        <th class="text-center font-weight-bolder ps-2">
                                            Nama</th>
                                        <th class="text-center font-weight-bolder">
                                            Email</th>
                                        <th class="text-center font-weight-bolder">
                                            Password</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                    @php $i=1; @endphp
                                    @forelse ($petugas as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->password }}</td>
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