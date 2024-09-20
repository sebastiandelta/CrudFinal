<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'descripcion', 'precio', 'created_at', 'updated_at'];
 // Asegúrate de que esto esté aquí


    public function item()
    {
        return $this->belongsTo(Item::class); // Relación inversa con Item
    }
}