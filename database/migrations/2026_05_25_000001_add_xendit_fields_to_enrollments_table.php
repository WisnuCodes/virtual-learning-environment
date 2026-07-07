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
            $table->string('xendit_invoice_id')->nullable()->after('payment_proof');
            $table->text('xendit_invoice_url')->nullable()->after('xendit_invoice_id');
            $table->string('xendit_payment_channel')->nullable()->after('xendit_invoice_url');
            $table->string('xendit_payment_method')->nullable()->after('xendit_payment_channel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'xendit_invoice_id',
                'xendit_invoice_url',
                'xendit_payment_channel',
                'xendit_payment_method',
            ]);
        });
    }
};
