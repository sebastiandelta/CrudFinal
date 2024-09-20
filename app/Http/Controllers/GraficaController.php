<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class GraficaController extends Controller
{
    public function index()
    {
        $items = Item::all();
    
        // Extraer nombres y precios
        $labels = $items->pluck('nombre'); // Nombres para las etiquetas
        $ids = $items->pluck('id'); // IDs para redirigir
        $data = $items->pluck('precio'); // Precios para los datos
    
        return view('grafica.index', compact('labels', 'data', 'ids'));
    }
}
