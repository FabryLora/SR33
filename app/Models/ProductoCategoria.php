<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCategoria extends Model
{
    protected $guarded = [];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
