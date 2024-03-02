<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use PDF;

class PDFController extends Controller
{
    public function generateInvoicePDF($id)
{
    $invoice = Invoice::findOrFail($id);
    $order = $invoice->order;
    $user = $order->user;
    $createdAt = $order->created_at;

    // Concatena el nombre de la factura y su ID para el nombre del archivo PDF
    $fileName = 'invoice_' . str_replace(' ', '_', strtolower($invoice->name)) . '_' . $invoice->id . '.pdf';

    $pdf = PDF::loadView('layouts.showInvoice', compact('invoice', 'order', 'user', 'createdAt'));

    // Descarga el archivo PDF con el nombre generado
    return $pdf->download($fileName);
}

}