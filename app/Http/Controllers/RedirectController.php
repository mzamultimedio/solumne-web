<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $role = $request->user()->role;

        if ($role === 'admin') {
            // Los administradores van al nuevo panel de Filament.
            return redirect()->route('filament.admin.pages.dashboard');
        }

        if ($role === 'gestor') {
            // Los gestores van directamente a la gestión de usuarios en Filament.
            return redirect()->route('filament.admin.resources.users.index');
        }

        // Cualquier otro rol va al panel de estudiantes.
        return redirect()->route('student.dashboard');
    }
}
