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
        Schema::create('ALCBigcArticles', function (Blueprint $table) {
            $table->id();
            $table->string('article_no');
            $table->decimal('price', $precision = 10, $scale = 2);
            $table->text('pack_size');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ALCBigcArticles');
    }
};
