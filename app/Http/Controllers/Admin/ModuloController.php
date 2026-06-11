<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Modulo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuloController extends Controller
{
    public function index(Curso $curso): View
    {
        $modulos = $curso->modulos()->paginate(10);
        return view('admin.modulo.index', compact('curso', 'modulos'));
    }

    public function create(Curso $curso): View
    {
        return view('admin.modulo.create', compact('curso'));
    }

    public function store(Request $request, Curso $curso): RedirectResponse
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        $curso->modulos()->create($validated);
        return redirect()->route('admin.curso.modulo.index', $curso)->with('success', 'Módulo creado exitosamente.');
    }

    public function show(Modulo $modulo)
    {
        // No implementado
    }

    public function edit(Modulo $modulo): View
    {
        return view('admin.modulo.edit', compact('modulo'));
    }

    public function update(Request $request, Modulo $modulo): RedirectResponse
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);
        $modulo->update($validated);
        return redirect()->route('admin.curso.modulo.index', $modulo->curso)->with('success', 'Módulo actualizado exitosamente.');
    }

    public function destroy(Modulo $modulo): RedirectResponse
    {
        $curso = $modulo->curso;
        $modulo->delete();
        return redirect()->route('admin.curso.modulo.index', $curso)->with('success', 'Módulo eliminado exitosamente.');
    }
}