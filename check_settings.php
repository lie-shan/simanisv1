<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$settings = App\Models\Setting::all();
if ($settings->isEmpty()) {
    echo "No settings found in database!\n";
} else {
    foreach ($settings as $s) {
        echo "{$s->key} | {$s->group} | {$s->type} | {$s->label}\n";
    }
}
