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
        Schema::create('bongkars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sandar_id')->constrained()->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->integer('jumlah')->nullable();
            $table->enum('satuan',['m','u','b'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bongkars');
    }
};
