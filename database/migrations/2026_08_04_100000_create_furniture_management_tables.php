<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::table('users',fn(Blueprint $t)=>$t->string('role')->default('staff')->after('password'));
  Schema::create('categories',function(Blueprint $t){$t->id();$t->string('name')->unique();$t->string('description')->nullable();$t->timestamps();});
  Schema::create('customers',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->nullable()->unique();$t->string('phone')->nullable();$t->text('address')->nullable();$t->timestamps();});
  Schema::create('suppliers',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->nullable();$t->string('phone')->nullable();$t->string('address')->nullable();$t->timestamps();});
  Schema::create('furnitures',function(Blueprint $t){$t->id();$t->string('furniture_code')->unique();$t->string('name');$t->foreignId('category_id')->constrained()->cascadeOnDelete();$t->string('material')->nullable();$t->string('color')->nullable();$t->string('size')->nullable();$t->decimal('price',12,2);$t->unsignedInteger('quantity')->default(0);$t->text('description')->nullable();$t->string('image')->nullable();$t->string('status')->default('available');$t->timestamps();});
  Schema::create('orders',function(Blueprint $t){$t->id();$t->string('order_number')->unique();$t->foreignId('customer_id')->constrained();$t->foreignId('user_id')->constrained();$t->decimal('subtotal',12,2);$t->decimal('tax',12,2)->default(0);$t->decimal('total',12,2);$t->string('status')->default('completed');$t->timestamps();});
  Schema::create('order_items',function(Blueprint $t){$t->id();$t->foreignId('order_id')->constrained()->cascadeOnDelete();$t->foreignId('furniture_id')->constrained('furnitures');$t->unsignedInteger('quantity');$t->decimal('price',12,2);$t->decimal('line_total',12,2);$t->timestamps();});
  Schema::create('inventory_transactions',function(Blueprint $t){$t->id();$t->foreignId('furniture_id')->constrained('furnitures')->cascadeOnDelete();$t->string('type');$t->unsignedInteger('quantity');$t->string('notes')->nullable();$t->timestamps();});
 }
 public function down(): void {foreach(['inventory_transactions','order_items','orders','furnitures','suppliers','customers','categories'] as $t)Schema::dropIfExists($t);Schema::table('users',fn(Blueprint $t)=>$t->dropColumn('role'));}
};
