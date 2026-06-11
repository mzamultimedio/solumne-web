<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Leccion;
use App\Models\Modulo;
use App\Models\Recurso;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Recogemos todas las estadísticas
        $totalCursos = Curso::count();
        $totalModulos = Modulo::count();
        $totalLecciones = Leccion::count();
        $totalRecursos = Recurso::count();

        // Obtenemos los últimos 5 cursos
        $ultimosCursos = Curso::latest()->take(5)->get();

        // Pasamos todos los datos a la vista
        return view('admin.dashboard', compact(
            'totalCursos',
            'totalModulos',
            'totalLecciones',
            'totalRecursos',
            'ultimosCursos'
        ));
    }
}