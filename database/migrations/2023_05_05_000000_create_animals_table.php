<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species'); // Dog, Cat, etc.
            $table->string('breed')->nullable();
            $table->integer('age')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('available'); // available, adopted, pending
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
