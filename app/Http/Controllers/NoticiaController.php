<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

// Rutas para Noticias
Route::get('/noticias', [NoticiaController::class, 'index']);
Route::get('/noticias/{id}', [NoticiaController::class, 'show']);
Route::post('/noticias', [NoticiaController::class, 'store']);
Route::put('/noticias/{id}', [NoticiaController::class, 'update']);
Route::delete('/noticias/{id}', [NoticiaController::class, 'destroy']);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class NoticiaController extends Controller
{
    // Obtener todas las noticias
    public function index()
    {
        return response()->json(Noticia::all(), 200);
    }

    // Obtener una noticia por ID
    public function show($id)
    {
        $noticia = Noticia::find($id);
        if (!$noticia) {
            return response()->json(['message' => 'Noticia no encontrada'], 404);
        }
        return response()->json($noticia, 200);
    }

    // Crear una nueva noticia
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'id_autor' => 'required|integer',
            'fecha_hora' => 'required|date',
            'encabezado' => 'required|string',
            'texto' => 'required|string'
        ]);

        $noticia = Noticia::create($request->all());
        return response()->json($noticia, 201);
    }

    // Actualizar una noticia
    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);
        if (!$noticia) {
            return response()->json(['message' => 'Noticia no encontrada'], 404);
        }
        
        $noticia->update($request->all());
        return response()->json($noticia, 200);
    }

    // Eliminar una noticia
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        if (!$noticia) {
            return response()->json(['message' => 'Noticia no encontrada'], 404);
        }

        $noticia->delete();
        return response()->json(['message' => 'Noticia eliminada'], 200);
    }
}
