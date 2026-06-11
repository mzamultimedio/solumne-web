<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- AÑADIR
use Illuminate\Support\Str;
use Illuminate\View\View;

class CursoController extends Controller
{
    public function index(): View
    {
        $cursos = Curso::latest()->paginate(10);
        return view('admin.curso.index', compact('cursos'));
    }

    public function create(): View
    {
        return view('admin.curso.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validación de imagen
        ]);

        $data = $request->only('title', 'description');
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('cursos', 'public');
        }

        Curso::create($data);

        return redirect()->route('admin.curso.index')->with('success', 'Curso creado exitosamente.');
    }

    public function show(Curso $curso)
    {
        // No implementado
    }

    public function edit(Curso $curso): View
    {
        // ... (lógica de alumnos no cambia)
        $alumnosInscritos = $curso->alumnos()->pluck('id');
        $alumnosPotenciales = User::where('role', 'alumno')->whereNotIn('id', $alumnosInscritos)->get();
        return view('admin.curso.edit', compact('curso', 'alumnosInscritos', 'alumnosPotenciales'));
    }

    public function update(Request $request, Curso $curso): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('title', 'description');
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            // Si hay una imagen nueva, borrar la antigua si existe
            if ($curso->image_path) {
                Storage::disk('public')->delete($curso->image_path);
            }
            $data['image_path'] = $request->file('image')->store('cursos', 'public');
        }

        $curso->update($data);

        return redirect()->route('admin.curso.index')->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Curso $curso): RedirectResponse
    {
        // Borrar la imagen de portada si existe
        if ($curso->image_path) {
            Storage::disk('public')->delete($curso->image_path);
        }

        $curso->delete();
        return redirect()->route('admin.curso.index')->with('success', 'Curso eliminado exitosamente.');
    }

    // ... (métodos enroll y unenroll no cambian)
    public function enroll(Request $request, Curso $curso): RedirectResponse { /*...*/ }
    public function unenroll(Request $request, Curso $curso): RedirectResponse { /*...*/ }
}