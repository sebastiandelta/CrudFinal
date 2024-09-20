<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;


class ImageController extends Controller
{
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        
        // Eliminar el archivo del sistema
        Storage::disk('public')->delete($image->path);
        
        // Eliminar el registro de la base de datos
        $image->delete();

        return redirect()->back()->with('success', 'Imagen eliminada con éxito.');
    }
}
