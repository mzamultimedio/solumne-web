<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdfController extends Controller
{
    public function __invoke(Invoice $invoice)
    {
        $user = Auth::user();

        abort_unless(
            $user && ($user->role === 'admin' || $user->role === 'gestor' || $user->id === $invoice->user_id),
            Response::HTTP_FORBIDDEN
        );

        $invoice->load('items', 'user', 'curso');

        $pdf = Pdf::loadView('invoices.pdf', [
            'invoice' => $invoice,
        ])->setPaper('a4');

        $filename = "factura-{$invoice->numero}.pdf";

        if (request()->boolean('download')) {
            return $pdf->download($filename);
        }

        return $pdf->stream($filename);
    }
}
