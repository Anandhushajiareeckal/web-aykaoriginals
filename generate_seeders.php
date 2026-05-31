<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

$dbName = env('DB_DATABASE');
$tables = DB::select('SHOW TABLES');

$skipTables = ['migrations', 'password_reset_tokens', 'sessions', 'failed_jobs', 'personal_access_tokens'];
$tableKey = 'Tables_in_' . $dbName;

$tableNames = [];
foreach ($tables as $table) {
    $name = $table->$tableKey;
    if (!in_array($name, $skipTables)) {
        $tableNames[] = $name;
    }
}

if (!empty($tableNames)) {
    $tablesList = implode(',', $tableNames);
    echo "Running iseed for tables: " . $tablesList . "\n";
    Artisan::call('iseed', [
        'tables' => $tablesList,
        '--force' => true
    ]);
    echo Artisan::output();
} else {
    echo "No tables to seed.\n";
}
