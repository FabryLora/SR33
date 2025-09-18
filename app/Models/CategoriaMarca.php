<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaMarca extends Model
{
    protected $guarded = [];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
