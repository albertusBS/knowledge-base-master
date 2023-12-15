<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('unit_id');
            $table->string('judul_post');
            $table->string('tag');
            $table->string('image');
            $table->string('excerpt');
            $table->longText('isi_post');
            $table->timestamps();

            $table->foreign('unit_id')->references('id_unit')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
