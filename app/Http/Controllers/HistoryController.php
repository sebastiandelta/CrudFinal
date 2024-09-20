<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;


class HistoryController extends Controller
{
    public function destroy($id)
    {
        // Buscar el cambio histórico por ID y eliminarlo
        $history = History::findOrFail($id);
        $history->delete();

        return redirect()->back()->with('success', 'Cambio histórico eliminado con éxito.');
    }
}
