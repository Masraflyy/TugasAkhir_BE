<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (Schema::hasTable('kopi')) {
        return;
    }

    Schema::create('kopi', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jenis');          
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
        Schema::dropIfExists('kopi');
    }
};



//jangan lupa follow ig saya buat yang liat ini yaa @rafly_dhana