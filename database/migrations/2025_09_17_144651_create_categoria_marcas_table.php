<?php

use App\Models\Categoria;
use App\Models\Marca;
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
        Schema::create('categoria_marcas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Categoria::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Marca::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categoria_marcas');
    }
};
