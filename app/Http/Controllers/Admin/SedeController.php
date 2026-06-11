<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- AÑADIDO

class SedeController extends Controller
{
    public function index()
    {
        $sedes = Sede::latest()->get();
        return view('admin.sede.index', compact('sedes'));
    }

    public function create()
    {
        return view('admin.sede.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // <-- AÑADIDO
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sedes', 'public');
            $validated['image_path'] = $path;
        }

        Sede::create($validated);

        return redirect()->route('admin.sede.index')->with('success', 'Sede creada exitosamente.');
    }

    public function edit(Sede $sede)
    {
        return view('admin.sede.edit', compact('sede'));
    }

    public function update(Request $request, Sede $sede)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // <-- AÑADIDO
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Borra la imagen anterior si existe
            if ($sede->image_path) {
                Storage::disk('public')->delete($sede->image_path);
            }
            $path = $request->file('image')->store('sedes', 'public');
            $validated['image_path'] = $path;
        }

        $sede->update($validated);

        return redirect()->route('admin.sede.index')->with('success', 'Sede actualizada exitosamente.');
    }

    public function destroy(Sede $sede)
    {
        // Borra la imagen si existe
        if ($sede->image_path) {
            Storage::disk('public')->delete($sede->image_path);
        }

        $sede->delete();
        return redirect()->route('admin.sede.index')->with('success', 'Sede eliminada exitosamente.');
    }
}