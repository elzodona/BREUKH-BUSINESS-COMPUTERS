<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Unite;
use App\Models\Produit;
use App\Models\Caracteristiques;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prod_cars', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('description')->nullable();
            $table->string('valeur')->nullable();
            $table->foreignIdFor(Unite::class)->constrained()->nullable();
            $table->foreignIdFor(Produit::class)->constrained();
            $table->foreignIdFor(Caracteristiques::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_cars');
    }
};