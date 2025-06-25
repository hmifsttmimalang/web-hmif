<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('member_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // info data tambahan
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->text('alamat');

            // motivasi
            $table->text('motivasi')->nullable();
            $table->text('harapan')->nullable();
            $table->text('bagi_waktu')->nullable();
            
            $table->string('kontribusi')->nullable();

            // minat dan bakat
            $table->json('minat')->nullable();
            $table->string('minat_lainnya')->nullable();
            $table->text('pengalaman_organisasi')->nullable();
            $table->string('divisi')->nullable();
            
            // portfolio
            $table->text('ket_portofolio')->nullable();
            $table->string('link_portofolio')->nullable();
            $table->string('file_portofolio')->nullable();
            $table->text('skill')->nullable();

            // ide dan solusi
            $table->text('ide')->nullable();
            $table->text('solusi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_registrations');
    }
};
