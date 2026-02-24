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
        Schema::create('school_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 20)->default('2026/2027');
            $table->integer('peserta_didik')->default(0);
            $table->integer('guru')->default(0);
            $table->integer('rombel')->default(0);
            $table->timestamps();
        });

        // Insert data default
        \DB::table('school_statistics')->insert([
            'tahun_ajaran' => '2026/2027',
            'peserta_didik' => 180,
            'guru' => 12,
            'rombel' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_statistics');
    }
};
