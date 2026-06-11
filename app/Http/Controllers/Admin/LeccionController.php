<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leccion;
use App\Models\Modulo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeccionController extends Controller
{
    public function index(Modulo $modulo): View
    {
        $lecciones = $modulo->lecciones()->paginate(10);
        return view('admin.leccion.index', compact('modulo', 'lecciones'));
    }

    public function create(Modulo $modulo): View
    {
        return view('admin.leccion.create', compact('modulo'));
    }

    public function store(Request $request, Modulo $modulo): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'text_content' => 'nullable|string',
        ]);

        $modulo->lecciones()->create($validated);
        return redirect()->route('admin.modulo.leccion.index', $modulo)->with('success', 'Lección creada exitosamente.');
    }

    public function edit(Leccion $leccion): View
    {
        return view('admin.leccion.edit', compact('leccion'));
    }

    public function update(Request $request, Leccion $leccion): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'text_content' => 'nullable|string',
        ]);

        $leccion->update($validated);
        return redirect()->route('admin.modulo.leccion.index', $leccion->modulo)->with('success', 'Lección actualizada exitosamente.');
    }

    public function destroy(Leccion $leccion): RedirectResponse
    {
        $modulo = $leccion->modulo;
        $leccion->delete();
        return redirect()->route('admin.modulo.leccion.index', $modulo)->with('success', 'Lección eliminada exitosamente.');
    }
}