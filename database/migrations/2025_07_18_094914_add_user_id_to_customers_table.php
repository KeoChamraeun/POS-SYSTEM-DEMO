<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->after('id');
            $table->string('name')->nullable(false)->change();
            $table->string('phone')->nullable()->change();
            $table->string('address')->nullable(false)->change();
            $table->enum('status', ['active', 'inactive'])->default('active')->change();
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('name')->nullable()->change();
            $table->string('phone')->nullable()->unique()->change();
            $table->string('address')->nullable()->change();
            $table->string('status')->default('active')->change();
        });
    }
};
