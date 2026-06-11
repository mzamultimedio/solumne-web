<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::query()
            ->where('user_id', Auth::id())
            ->latest('fecha_emision')
            ->paginate(10);

        return view('student.invoices.index', compact('invoices'));
    }
}
