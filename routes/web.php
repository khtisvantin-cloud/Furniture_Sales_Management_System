<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FurnitureController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Furniture;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('furnitures', FurnitureController::class);

    foreach (['customers', 'suppliers'] as $type) {
        Route::get("/{$type}", [MasterDataController::class, 'index'])->defaults('type', $type)->name("{$type}.index");
        Route::get("/{$type}/create", [MasterDataController::class, 'create'])->defaults('type', $type)->name("{$type}.create");
        Route::post("/{$type}", [MasterDataController::class, 'store'])->defaults('type', $type)->name("{$type}.store");
        Route::get("/{$type}/{id}/edit", [MasterDataController::class, 'edit'])->defaults('type', $type)->name("{$type}.edit");
        Route::put("/{$type}/{id}", [MasterDataController::class, 'update'])->defaults('type', $type)->name("{$type}.update");
        Route::delete("/{$type}/{id}", [MasterDataController::class, 'destroy'])->defaults('type', $type)->name("{$type}.destroy");
    }

    Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

    Route::get('inventory', fn () => view('inventory.index', [
        'furnitures' => Furniture::orderBy('name')->get(),
        'transactions' => InventoryTransaction::with('furniture')->latest()->take(12)->get(),
    ]))->name('inventory.index');

    Route::post('inventory/{furniture}/{type}', function (Request $request, Furniture $furniture, string $type) {
        $data = $request->validate(['quantity' => ['required', 'integer', 'min:1'], 'notes' => ['nullable', 'string']]);

        if ($type === 'out' && $furniture->quantity < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Insufficient stock.']);
        }

        $furniture->{$type === 'in' ? 'increment' : 'decrement'}('quantity', $data['quantity']);
        InventoryTransaction::create(['furniture_id' => $furniture->id, 'type' => "stock_{$type}", 'quantity' => $data['quantity'], 'notes' => $data['notes']]);

        return back()->with('success', 'Inventory updated successfully.');
    })->whereIn('type', ['in', 'out'])->name('inventory.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
