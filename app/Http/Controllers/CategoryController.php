<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // obtener todas las categorias
    public function getCategorias(Request $request) {
        $categorias = Category::select('categories.id', 'categories.name')->get();
        return response()->json([
            'data' => $categorias
        ]);
    }

    // crear categoria
    public function createCategoria(Request $request) {
        $categoria = new Category();
        $categoria->name = $request->name;
        $categoria->save();

        return response()->json([
            'message' => 'Categoria creada',
            'data' => $categoria,
        ]);
    }

    // borrar una categoria
    public function deleteCategoria(Request $request) {
        $categoria = Category::whereId($request->id)->first();
        $categoria->delete();

        return response()->json([
            'message' => 'Categoria borrada',
            'data' => $categoria,
        ]);
    }
}
