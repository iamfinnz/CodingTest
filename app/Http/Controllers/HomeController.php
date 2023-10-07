<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PendaftaranDataExport;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $jumlahPendaftaran = Pendaftaran::count();
        $jumlahPetugas = User::count();
        $pendaftaran = Pendaftaran::all();
        return view('home.index', compact('pendaftaran', 'jumlahPendaftaran', 'jumlahPetugas'));
    }

    public function create()
    {
        $petugas = User::all();
        return view('home.create', compact('petugas'));
    }

    public function store(Request $request)
    {
        // No Registrasi
        // Mendapatkan nim terakhir dari database
        $lastNoReg = Pendaftaran::max('no_registrasi');

        // Mengekstrak angka terakhir dari nim terakhir
        $lastNoRegNumber = $lastNoReg ? (int)substr($lastNoReg, -4) : 0;

        // Increment angka terakhir
        $newNoRegNumber = str_pad($lastNoRegNumber + 1, 4, '0', STR_PAD_LEFT);

        // Membentuk nim baru dengan format "2001060001"
        $no_registrasi = date('ydm') . $newNoRegNumber;


        // No Rekam Medis
        // Mendapatkan angka terakhir dari database
        $lastAngka = Pendaftaran::max('no_rekam_medis');

        // Mengekstrak angka terakhir dari nomor rekam medis terakhir
        $lastNomorRekam = $lastAngka ? (int)substr($lastAngka, -2) : 0;

        // Increment angka terakhir
        $newNomorRekamMedis = str_pad($lastNomorRekam + 1, 2, '0', STR_PAD_LEFT);

        // Membentuk nim baru dengan format "00-00-00-01"
        $no_rekam_medis = '00-00-00-' . $newNomorRekamMedis;

        $request->validate([
            'nama_pasien' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_registrasi' => 'required',
            'layanan' => 'required',
            'jenis_pembayaran' => 'required',
            'waktu_mulai_pelayanan' => 'required',
            'petugas_pendaftaran' => 'required',
        ]);

        Pendaftaran::create([
            'waktu_registrasi' => Carbon::now('Asia/Jakarta'),
            'no_registrasi' => $no_registrasi,
            'no_rekam_medis' => $no_rekam_medis,
            'nama_pasien' => $request->input('nama_pasien'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'jenis_registrasi' => $request->input('jenis_registrasi'),
            'layanan' => $request->input('layanan'),
            'jenis_pembayaran' => $request->input('jenis_pembayaran'),
            'status_registrasi' => 'Aktif',
            'waktu_mulai_pelayanan' => $request->input('waktu_mulai_pelayanan'),
            'petugas_pendaftaran' => $request->input('petugas_pendaftaran'),
        ]);

        return redirect('/home')->with('status', 'Berhasil membuat pendaftaran');
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $petugas = User::all();
        return view('home.edit', compact('pendaftaran', 'petugas'));
    }

    public function update($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        
        // Set zona waktu yang diinginkan (misalnya, Asia/Jakarta)
        $timezone = 'Asia/Jakarta';

        // Buat instance Carbon dengan zona waktu yang diinginkan
        $now = Carbon::now($timezone);

        // Update waktu_selesai dengan waktu saat ini dalam zona waktu yang diinginkan
        $pendaftaran->waktu_selesai_pelayanan = $now;
        $pendaftaran->status_registrasi = 'Tutup Kunjungan';

        // Simpan perubahan
        $pendaftaran->save();

        return redirect('/home')->with('status', 'Berhasil edit data pendaftaran');
    }

    public function destroy($id)
    {
        Pendaftaran::destroy($id);

        return redirect()->route('home')
            ->with('status', 'Berhasil hapus data pendaftaran');
    }

    public function exportToExcel()
    {
        $pendaftaran = Pendaftaran::all();

        // Proses data
        $pendaftaranArray = [];
        foreach ($pendaftaran as $key => $data) {
            $pendaftaranArray[] = [
                'waktu_registrasi' => $data['waktu_registrasi'],
                'no_registrasi' => $data['no_registrasi'],
                'no_rekam_medis' => $data['no_rekam_medis'],
                'nama_pasien' => $data['nama_pasien'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_registrasi' => $data['jenis_registrasi'],
                'layanan' => $data['layanan'],
                'jenis_pembayaran' => $data['jenis_pembayaran'],
                'status_registrasi' => $data['status_registrasi'],
                'waktu_mulai_pelayanan' => $data['waktu_mulai_pelayanan'],
                'waktu_selesai_pelayanan' => $data['waktu_selesai_pelayanan'],
                'petugas_pendaftaran' => $data['petugas_pendaftaran'],
            ];
        }

        // Tentukan heading yang diinginkan
        $headings = [
            'No', 'Waktu Registrasi', 'No Registrasi', 'No Rekam Medis', 'Nama Pasien', 'Jenis Kelamin', 'Tanggal Lahir', 'Jenis Registrasi',
            'Layanan', 'Jenis Pembayaran', 'Status Registrasi', 'Waktu Mulai Pelayanan', 'Waktu Selesai Pelayanan', 'Petugas Pendaftaran'
        ];

        // Export riwayat ke Excel
        return Excel::download(new PendaftaranDataExport($pendaftaranArray, $headings), 'Data Pendaftaran Pasien Rumah Sakit.xlsx');
    }
}
