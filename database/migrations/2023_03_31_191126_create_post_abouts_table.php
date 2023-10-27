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
        Schema::create('post_abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('link')->default(NULL);
            $table->longText('content')->default(NULL);
            $table->foreignId('users_id');
            $table->string('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_abouts');
    }
};
