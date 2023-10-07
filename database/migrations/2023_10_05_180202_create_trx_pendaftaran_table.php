<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_registrasi');
            $table->string('no_registrasi');
            $table->string('no_rekam_medis');
            $table->string('nama_pasien');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('jenis_registrasi');
            $table->string('layanan');
            $table->string('jenis_pembayaran');
            $table->string('status_registrasi');
            $table->timestamp('waktu_mulai_pelayanan');
            $table->timestamp('waktu_selesai_pelayanan')->nullable()->default(null);
            $table->string('petugas_pendaftaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_pendaftaran');
    }
}
