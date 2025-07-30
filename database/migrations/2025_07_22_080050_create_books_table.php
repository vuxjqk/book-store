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
            $table->string('title', 150)->unique();
            $table->string('author', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->enum('language', ['Vietnamese', 'English', 'French', 'Spanish', 'Other'])->nullable();
            $table->enum('status', ['Available', 'OutOfStock', 'PreOrder', 'Discontinued'])->nullable();
            $table->decimal('current_price', 15, 2)->default(0.00);
            $table->decimal('original_price', 15, 2)->default(0.00);
            $table->text('description')->nullable();
            $table->integer('page_count')->unsigned()->default(0);
            $table->string('dimensions', 50)->nullable();
            $table->date('published_date')->nullable();
            $table->enum('cover_type', ['Hardcover', 'Paperback', 'Ebook'])->nullable();
            $table->integer('stock_quantity')->unsigned()->default(0);
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
