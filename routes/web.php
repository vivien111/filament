<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::post('subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});


Route::get('/setup-roles', function () {
    // Créer des permissions si elles n'existent pas déjà
    Permission::firstOrCreate(['name' => 'view integrations']);
    Permission::firstOrCreate(['name' => 'edit integrations']);
    Permission::firstOrCreate(['name' => 'delete integrations']);

    // Créer des rôles s'ils n'existent pas déjà
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $managerRole = Role::firstOrCreate(['name' => 'manager']);

    // Attribuer des permissions aux rôles
    $adminRole->givePermissionTo(['view integrations', 'edit integrations', 'delete integrations']);
    $managerRole->givePermissionTo(['view integrations', 'edit integrations']);

    return 'Rôles et permissions configurés avec succès !';
});
