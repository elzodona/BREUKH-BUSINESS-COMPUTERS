<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Succursale;
use App\Models\Produit;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('succ_prods', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('quantite')->nullable();
            $table->float('prix_unitaire')->nullable();
            $table->float('prix_en_gros')->nullable();
            $table->foreignIdFor(Produit::class)->constrained();
            $table->foreignIdFor(Succursale::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('succ_prods');
    }
};