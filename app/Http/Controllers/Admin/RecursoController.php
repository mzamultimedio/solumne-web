<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leccion;
use App\Models\Recurso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RecursoController extends Controller
{
    public function index(Leccion $leccion): View
    {
        $recursos = $leccion->recursos;
        return view('admin.recurso.index', compact('leccion', 'recursos'));
    }

    public function create(Leccion $leccion): View
    {
        return view('admin.recurso.create', compact('leccion'));
    }

    public function store(Request $request, Leccion $leccion): RedirectResponse
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'file' => ['required', 'file', 'mimes:pdf,png,jpg,jpeg,mp4,mp3,ogg,wav', 'max:2097152'],
        ]);

        $file = $request->file('file');
        $path = $file->store('recursos', 'public');
        $fileType = $this->determineFileType($file->getClientMimeType());

        $leccion->recursos()->create([
            'display_name' => $validated['display_name'],
            'file_path' => $path,
            'file_type' => $fileType,
            'file_size' => $file->getSize(),
        ]);

        return redirect()->route('admin.leccion.recurso.index', $leccion)->with('success', 'Recurso subido exitosamente.');
    }

    public function destroy(Recurso $recurso): RedirectResponse
    {
        $leccion = $recurso->leccion;
        Storage::disk('public')->delete($recurso->file_path);
        $recurso->delete();
        return redirect()->route('admin.leccion.recurso.index', $leccion)->with('success', 'Recurso eliminado exitosamente.');
    }

    private function determineFileType(string $mimeType): string
    {
        if (str_starts_with($mimeType, 'image/')) return 'image';
        if (str_starts_with($mimeType, 'video/')) return 'video';
        if (str_starts_with($mimeType, 'audio/')) return 'audio';
        if ($mimeType === 'application/pdf') return 'pdf';
        return 'other';
    }
}