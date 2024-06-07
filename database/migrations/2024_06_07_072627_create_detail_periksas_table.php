<?php

use App\Models\Obat;
use App\Models\Periksa;
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
        Schema::create('detail_periksas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Periksa::class);
            $table->foreignIdFor(Obat::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_periksas');
    }
};
