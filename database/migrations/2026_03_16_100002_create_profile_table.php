<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('title', 150);
            $table->text('tagline')->nullable();
            $table->text('bio')->nullable();
            $table->string('availability', 80)->default('Available for work');
            $table->string('avatar_path', 255)->nullable();
            $table->string('resume_path', 255)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('location', 150)->nullable();
            $table->string('hire_me_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
