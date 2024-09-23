<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Item extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio'];
    
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function history()
    {
        return $this->hasMany(History::class); 
    }
}
