<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_taxonomy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->foreignId('taxonomy_id');
            $table->unique(['product_id', 'taxonomy_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_taxonomy');
    }
};
