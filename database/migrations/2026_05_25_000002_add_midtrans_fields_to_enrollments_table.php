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
            // Drop Xendit columns if they exist
            if (Schema::hasColumn('enrollments', 'xendit_invoice_id')) {
                $table->dropColumn([
                    'xendit_invoice_id',
                    'xendit_invoice_url',
                    'xendit_payment_channel',
                    'xendit_payment_method',
                ]);
            }

            // Add Midtrans columns
            $table->string('midtrans_snap_token')->nullable()->after('payment_proof');
            $table->string('midtrans_order_id')->nullable()->after('midtrans_snap_token');
            $table->string('midtrans_payment_type')->nullable()->after('midtrans_order_id');
            $table->string('midtrans_transaction_status')->nullable()->after('midtrans_payment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            // Drop Midtrans columns
            $table->dropColumn([
                'midtrans_snap_token',
                'midtrans_order_id',
                'midtrans_payment_type',
                'midtrans_transaction_status',
            ]);

            // Restore Xendit columns
            $table->string('xendit_invoice_id')->nullable()->after('payment_proof');
            $table->text('xendit_invoice_url')->nullable()->after('xendit_invoice_id');
            $table->string('xendit_payment_channel')->nullable()->after('xendit_invoice_url');
            $table->string('xendit_payment_method')->nullable()->after('xendit_payment_channel');
        });
    }
};
