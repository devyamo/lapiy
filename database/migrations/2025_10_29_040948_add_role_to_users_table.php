<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'phc_staff'])->default('phc_staff');
            }
            
            if (!Schema::hasColumn('users', 'phc_id')) {
                $table->foreignId('phc_id')->nullable()->constrained('phcs')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['phc_id']);
            $table->dropColumn(['phc_id', 'role']);
        });
    }
};