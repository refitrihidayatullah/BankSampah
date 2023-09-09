<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('kd_barang', 8)->primary();
            $table->string('kategori_id', 8);
            $table->string('nama_barang', 20);
            $table->float('harga')->default(0);
            $table->longText('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('kd_kategori')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
