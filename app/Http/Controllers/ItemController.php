<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Image;
use App\Models\History;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view("items.index", compact("items"));
    }

    public function create()
    {
        return view("items.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nombre"=> "required|string|max:255",
            "descripcion"=> "required|string",
            "precio" => "required|integer|min:0",
            "images.*" => "image|mimes:jpeg,png,jpg|max:2048"
        ]);

        $item = Item::create($request->only(['nombre', 'descripcion', 'precio']));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public'); // Guardar imagen en storage/app/public/images
                Image::create([
                    'item_id' => $item->id,
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('items.index')->with('success', 'Item creado con éxito.');
    }

    public function show(Item $item)
    {
    // Cargar relaciones, como el historial
        $lastHistory = $item->history()->latest()->first();
        $item->load('images', 'comments', 'history');
        // Si la petición es AJAX, devolver los datos en JSON
        if (request()->ajax()) {
            return response()->json([
                'nombre' => $item->nombre,
                'descripcion' => $item->descripcion,
                'precio' => number_format($item->precio, 0, ',', '.'),
                'imagen' => $item->images->first() ? $item->images->first()->path : null,
            ]);
        }

        // Si no es una petición AJAX, devolver la vista
        return view('items.show', compact('item', 'lastHistory'));
    }

    public function edit(Item $item)
    {
        return view("items.edit", compact("item"));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|integer',
            // Validación de imágenes
        ]);
    
        // Guarda los valores antiguos para el historial
        $oldDescription = $item->descripcion;
        $oldPrice = $item->precio;
    
        // Actualizar el item
        $item->update($request->only(['nombre', 'descripcion', 'precio']));
    
        // Guardar en historial
        History::create([
            'item_id' => $item->id,
            'descripcion' => "Descripción cambiada de '{$oldDescription}' a '{$item->descripcion}'. Precio cambiado de '{$oldPrice}' a '{$item->precio}'.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('items.index')->with('success', 'Item actualizado con éxito.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success','Eliminado con exito');
    }
}
