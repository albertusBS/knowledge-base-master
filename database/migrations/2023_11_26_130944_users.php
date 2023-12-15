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

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unit_id');
            $table->foreign('unit_id')->references('id_unit')->on('units')->onDelete('cascade');
            $table->string('nama_admin');
            $table->string('username');
            $table->string('password');
            $table->string('role');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();

        });
    }

/**~
     * Reverse the migrations.
     */
    public function down(): void {

        Schema::dropIfExists('users');
    }
};
