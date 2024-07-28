<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
 {
  Schema::create('orders', function (Blueprint $table) {
   $table->id();
   $table->json('user')->nullable();
   $table->json('order')->nullable();
   $table->json('address')->nullable();
   $table->timestamps();
  });
 }

 public function down()
 {
  Schema::dropIfExists('orders');
 }
};
