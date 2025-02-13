<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $objects = Category::all();

            return response()-> json([
                'success' => true,
                'data' => $objects//este me va a regresar los datos
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,//este me va a indicar si se logró o no
                'message' => 'Error al obtener los tipos de pregunta.',//este me va a mostrar el mensaje determinado
                'error' => $e ->getMessage()//este me muestra el tipo de error que ocurrió
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //solamente se usa cuando está integrado con un html
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar la solicitud
            $request->validate([
                'nombre_categoria' => 'required|varchar|max:500',
                'descripcion' => 'required|varchar|max:500'
            ]);

            // Crear y guardar el nuevo registro
            $type = Category::create([
                'nombre_categoria' => $request->nombre_categoria,
                'descripcion' => $request->descripcion
            ]);

            // Respuesta exitosa con código 201 (Created)
            return response()->json([
                'success' => true,
                'message' => 'Tipo de dato creado exitosamente.',
                'data' => $type
            ], 201);
        } catch (\Exception $e) {
            // Manejo de errores con código 500
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de dato.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse//es como 
    {
        try {
            $object = Category::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $object
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'El tipo de dato no fue encontrado.'
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado, intente nuevamente.'
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse//es como el método store pero la diferencia es que busca por id
    {
    try {
        $object = Category::findOrFail($id);

        // Validar los datos recibidos
        $validated = $request->validate([
            'nombre_categoria' => 'sometimes|required|varchar|max:500|unique:categories,nombre_categoria,' . $id,
            'descripcion' => 'sometimes|required|varchar|max:500|unique:categories,descripcion,' . $id
        ]);

        // Actualizar solo si se envían datos válidos
        $object->fill($validated);
        
        if ($object->isDirty()) {
            $object->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Tipo de dato actualizado exitosamente.',
            'data' => $object
        ], 200);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'El tipo de dato no fue encontrado.'
        ], 404);
    } catch (Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error inesperado, intente nuevamente.'
        ], 500);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $type = Category::findOrFail($id);
            $type->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de dato eliminado exitosamente.'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'El tipo de dato no fue encontrado.'
            ], 404);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado, intente nuevamente.'
            ], 500);
        }
    }
}
