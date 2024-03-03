<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;
class InvoiceController extends Controller
{
    
    public function createInvoice($orderId){
        try {
            $order = Order::findOrFail($orderId);
    
            $invoice = Invoice::create([
                'order_id' => $orderId,
            ]);
    
            $order->invoice()->save($invoice);
    
            return true;
        } catch (\Exception $e) {
            \Log::error('Error creating invoice: ' . $e->getMessage());
            
            return $e;
        }
    }
    

}
