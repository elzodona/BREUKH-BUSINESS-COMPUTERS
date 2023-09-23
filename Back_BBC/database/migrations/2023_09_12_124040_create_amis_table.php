<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Succursale;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('friendA')->constrained('succursales');        
            $table->foreignId('friendB')->constrained('succursales'); 
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('accepted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amis');
    }
};