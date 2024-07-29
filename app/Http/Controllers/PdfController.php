<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ZipArchive;

class PdfController extends Controller
{
 public function generateOrders($id)
 {

  $order = Order::findOrFail($id);

  // Extract item IDs from the order
  $itemIds = $order->order['items'] ?? [];

  // Fetch the items from the Item model
  $items = Item::whereIn('id', $itemIds)->get();

  $data = ['order' => $order, 'items' => $items]; // Pass the orders as an array with a key

  $pdf = Pdf::loadView('pdf.orders', $data);

  return $pdf->download('orders.pdf');
 }

 public function generateAllOrdersZip()
 {
  // Fetch all orders
  $orders = Order::all();

  // Create a temporary directory
  $tempDir = storage_path('app/public/temp_pdfs/');
  if (!is_dir($tempDir)) {
   mkdir($tempDir, 0777, true);
  }

  // Generate PDFs for each order and save them temporarily
  foreach ($orders as $order) {
   // Extract item IDs from the order
   $itemIds = $order->order['items'] ?? [];
   $items = Item::whereIn('id', $itemIds)->get();
   $data = ['order' => $order, 'items' => $items];

   $pdf = Pdf::loadView('pdf.orders', $data);
   $pdfPath = $tempDir . 'order_' . $order->id . '.pdf';
   $pdf->save($pdfPath);
  }

  // Create a ZIP file
  $zipFileName = 'orders.zip';
  $zipFilePath = storage_path('app/public/' . $zipFileName);

  $zip = new ZipArchive();
  if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
   exit("Cannot open <$zipFilePath>\n");
  }

  // Add PDFs to the ZIP file
  $files = glob($tempDir . '*.pdf');
  foreach ($files as $file) {
   $zip->addFile($file, basename($file));
  }

  $zip->close();

  // Remove temporary PDFs
  foreach ($files as $file) {
   unlink($file);
  }

  // Return the ZIP file as a download response
  return response()->download($zipFilePath)->deleteFileAfterSend(true);
 }
}
