<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Commande;
use App\Models\SuccProd;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produit_commandes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('prix');
            $table->float('quantite');
            $table->float('reduction')->nullable();
            $table->foreignIdFor(SuccProd::class)->constrained();
            $table->foreignIdFor(Commande::class)->constrained();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_commandes');
    }
};