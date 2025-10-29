<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phcs', function (Blueprint $table) {
            $table->id();
            $table->string('clinic_name');
            $table->string('lga');
            $table->string('ward');
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phcs');
    }
};