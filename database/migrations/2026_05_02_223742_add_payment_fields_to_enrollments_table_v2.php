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
        Schema::table('enrollments', function (Blueprint $table) {
            if (!Schema::hasColumn('enrollments', 'payment_method')) {
                $table->string('payment_method')->nullable()->after('status');
            }
            if (!Schema::hasColumn('enrollments', 'payment_proof')) {
                $table->string('payment_proof')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('enrollments', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('payment_proof');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_proof', 'paid_at']);
        });
    }
};
