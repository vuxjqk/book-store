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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('author')->nullable();
            $table->string('publishing_house')->nullable();
            $table->string('language')->nullable();
            $table->string('status')->nullable();
            $table->decimal('current_price', 15, 0)->default(0);
            $table->decimal('original_price', 15, 0)->default(0);
            $table->text('description')->nullable();
            $table->integer('page_number')->default(0);
            $table->string('size')->nullable();
            $table->date('year_of_publication')->nullable();
            $table->string('cover_type')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
