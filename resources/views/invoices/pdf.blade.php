<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        .no-border td, .no-border th { border: none; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .header-table td { vertical-align: top; }
        .muted { color: #555; }
        .logo { height: 80px; display: block; margin: 0 auto; }
        .marca { font-size: 12px; font-weight: bold; margin-top: 6px; display: block; text-align: center; }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('images/logo-solumne.png');
        $total = (float) $invoice->monto_total;
        if ($total <= 0) {
            $total = (float) $invoice->items->sum(fn($i) => ($i->importe - $i->descuento));
        }
    @endphp

    <table class="header-table" style="margin-bottom: 10px;">
        <tr>
            <td style="width: 25%; text-align:center;">
                @if (file_exists($logoPath))
                    <img src="{{ $logoPath }}" class="logo" alt="Logo">
                @endif
                <span class="marca">Instituto Solumne</span>
            </td>
            <td style="width: 15%; text-align:center;">
                <div style="border:2px solid #000; width:100px; height:85px; margin:0 auto; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:70px; line-height:0.9;">
                    {{ $invoice->letra ?? 'X' }}
                </div>
            </td>
            <td style="width: 60%;">
                <div style="font-size:16px; font-weight:bold;">{{ $invoice->tipo ?? 'RECIBO' }}</div>
                <div><strong>Comp Nro:</strong> {{ str_pad($invoice->numero, 6, '0', STR_PAD_LEFT) }}</div>
                <div><strong>Fecha de Pago:</strong> {{ $invoice->fecha_pago?->format('d/m/Y') ?? 'n/a' }}</div>
                <div><strong>Fecha de Emisión:</strong> {{ $invoice->fecha_emision?->format('d/m/Y') ?? 'n/a' }}</div>
                <div><strong>CUIT:</strong> {{ $invoice->emisor_cuit ?? 'n/a' }}</div>
                <div><strong>Ing. Brutos:</strong> {{ $invoice->emisor_ing_brutos ?? 'n/a' }}</div>
                <div><strong>Inicio de Actividades:</strong> {{ $invoice->emisor_inicio_actividades?->format('d/m/Y') ?? 'n/a' }}</div>
            </td>
        </tr>
    </table>

    <table style="margin-bottom: 6px;">
        <tr>
            <td style="width: 25%;"><strong>Razón Social:</strong><br>{{ $invoice->emisor_razon_social ?? 'n/a' }}</td>
            <td style="width: 25%;"><strong>Domicilio:</strong><br>{{ $invoice->emisor_domicilio ?? 'n/a' }}</td>
            <td style="width: 25%;"><strong>Cond. frente al IVA:</strong><br>{{ $invoice->emisor_condicion_iva ?? 'n/a' }}</td>
            <td style="width: 25%;" class="text-center"><strong>Forma de Pago:</strong><br>{{ $invoice->forma_pago ?? 'n/a' }}</td>
        </tr>
    </table>

    <table style="margin-bottom: 10px;">
        <tr>
            <td style="width: 25%;"><strong>DNI/CUIT:</strong><br>{{ $invoice->receptor_documento ?? 'n/a' }}</td>
            <td style="width: 25%;"><strong>Cond. frente al IVA:</strong><br>{{ $invoice->receptor_condicion_iva ?? 'n/a' }}</td>
            <td style="width: 25%;"><strong>Apellido y Nombre/Razón Social:</strong><br>{{ $invoice->alumno_nombre }}</td>
            <td style="width: 25%;"><strong>Domicilio:</strong><br>{{ $invoice->receptor_domicilio ?? 'n/a' }}</td>
        </tr>
    </table>

    <table style="margin-bottom: 0;">
        <thead>
            <tr>
                <th>Concepto</th>
                <th class="text-right" style="width: 15%;">Importe</th>
                <th class="text-right" style="width: 10%;">Dto</th>
                <th class="text-right" style="width: 15%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $item)
                <tr>
                    <td>{{ $item->concepto }}</td>
                    <td class="text-right">${{ number_format($item->importe, 2, ',', '.') }}</td>
                    <td class="text-right">${{ number_format($item->descuento, 2, ',', '.') }}</td>
                    <td class="text-right">${{ number_format(($item->subtotal ?? $item->importe - $item->descuento), 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-right">Total</th>
                <th class="text-right">${{ number_format($total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
