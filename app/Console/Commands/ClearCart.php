<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCart extends Command
{
 protected $signature = 'cart:clear';
 protected $description = 'Clear all items from the cart';

 public function __construct()
 {
  parent::__construct();
 }

 public function handle()
 {
  // Assuming cart is stored in the session
  session()->forget('cart');

  // If using a database, you might need to interact with a model
  // \App\Models\Cart::truncate(); // Uncomment if using a Cart model

  $this->info('Cart has been cleared!');
 }
}
