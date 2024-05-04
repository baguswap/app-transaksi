<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('transaction')->statement('CREATE SCHEMA IF NOT EXISTS transaction');
        Schema::connection('transaction')->create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->enum('prioritas', ['rendah', 'sedang', 'tinggi']);
            $table->date('tanggal');
            $table->enum('status', ['verifikasi', 'belum_verifikasi'])->default('belum_verifikasi');
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
        Schema::connection('transaction')->dropIfExists('transaksi');
        DB::connection('transaction')->statement('DROP SCHEMA IF EXISTS transaction CASCADE');
    }
}
