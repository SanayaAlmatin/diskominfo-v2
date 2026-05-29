<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$users = \App\Models\User::with('roles')->get();
foreach($users as $u) {
    echo "User: {$u->email} | Column Role: {$u->role} | Pivot Roles: " . $u->roles->pluck('name')->implode(', ') . "<br>";
}
