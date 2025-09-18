<?php

use App\Models\Marca;
use App\Models\Modelo;
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
        Schema::create('marca_modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marca::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Modelo::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marca_modelos');
    }
};
