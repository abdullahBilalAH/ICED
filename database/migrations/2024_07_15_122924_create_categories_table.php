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
  Schema::create('categories', function (Blueprint $table) {
   $table->id();
   $table->text("name");
   $table->text("slug");
   $table->text("description");
   $table->text("visibility");
   $table->text('photos')->nullable();
   $table->timestamp('last_used_at')->nullable();
  });
 }

 /**
  * Reverse the migrations.
  */
 public function down(): void
 {
  Schema::dropIfExists('categories');
 }
};
