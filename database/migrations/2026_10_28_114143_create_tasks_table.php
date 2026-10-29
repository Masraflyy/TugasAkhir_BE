<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (Schema::hasTable('tasks')) {
        return;
    }

    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jenis');            // contoh: arabika, robusta
        $table->integer('ukuran_ml');
        $table->string('rasa');
        $table->decimal('harga', 10, 2);
        $table->boolean('tersedia')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
