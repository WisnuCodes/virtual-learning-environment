<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
    \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

    $params = [
        'transaction_details' => [
            'order_id' => 'lms-enrollment-test-' . time(),
            'gross_amount' => 10000,
        ],
        'customer_details' => [
            'first_name' => 'Test User',
            'email' => 'test@example.com',
        ],
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    echo "Snap Token: " . $snapToken . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
