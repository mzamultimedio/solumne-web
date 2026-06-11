<?php

namespace App\Http\Controllers;

use App\Models\Sede; // <-- AÑADIR ESTA LÍNEA
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PageController extends Controller
{
    public function index(): View
    {
        return view('home.index');
    }

    public function downloads(): View
    {
        return view('downloads.index');
    }

    public function sedes(): View
    {
        // Buscamos todas las sedes en la base de datos
        $sedes = Sede::all();

        // Pasamos la variable $sedes a la vista
        return view('sedes.index', compact('sedes'));
    }

    /**
     * Gestiona la descarga segura de un archivo.
     */
    public function downloadFile(string $filename): BinaryFileResponse
    {
        // Usamos public_path() para apuntar a la carpeta pública.
        $path = public_path('descargas/' . $filename);

        if (!File::exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->download($path);
    }
}