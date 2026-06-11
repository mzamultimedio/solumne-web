<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        // Verificar permisos
        if (!in_array(auth()->user()->role, ['admin', 'gestor'])) {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        $usersQuery = User::query();

        // Si el usuario autenticado es un gestor, filtramos para que solo vea alumnos.
        if (auth()->user()->role === 'gestor') {
            $usersQuery->where('role', 'alumno');
        }

        $users = $usersQuery->latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dni' => ['nullable', 'string', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // Actualizamos la regla de validación para incluir 'gestor'.
            'role' => ['required', Rule::in(['admin', 'gestor', 'alumno'])],
        ]);

        $data = $request->only('name', 'email', 'dni');
        $data['password'] = Hash::make($request->password);

        // Forzamos el rol si el creador es un gestor, por seguridad.
        if (auth()->user()->role === 'gestor') {
            $data['role'] = 'alumno';
        } else {
            // Solo un admin puede asignar el rol que viene del formulario.
            $data['role'] = $request->role;
        }

        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function edit(User $user)
    {
        $cursosInscritosIds = $user->cursos()->pluck('id');
        $cursosPotenciales = Curso::whereNotIn('id', $cursosInscritosIds)->get();

        return view('admin.user.edit', [
            'user' => $user,
            'cursosInscritos' => $user->cursos,
            'cursosPotenciales' => $cursosPotenciales,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'dni' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            // Actualizamos la regla de validación para incluir 'gestor'.
            'role' => ['required', Rule::in(['admin', 'gestor', 'alumno'])],
        ]);

        $data = $request->only('name', 'email', 'dni', 'role');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.user.index')->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    public function enrollCourse(Request $request, User $user)
    {
        $request->validate(['curso_id' => 'required|exists:cursos,id']);
        $user->cursos()->attach($request->curso_id);
        return back()->with('success', 'Curso asignado exitosamente.');
    }

    public function unenrollCourse(Request $request, User $user)
    {
        $request->validate(['curso_id' => 'required|exists:cursos,id']);
        $user->cursos()->detach($request->curso_id);
        return back()->with('success', 'Curso desasignado exitosamente.');
    }
}