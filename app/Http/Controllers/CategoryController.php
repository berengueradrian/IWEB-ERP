<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategorias() {
        $categorias = Category::all();
        return response()->json([
            'data' => $categorias
        ]);
    }
}
