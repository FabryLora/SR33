<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarcaModelo extends Model
{
    protected $guarded = [];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
