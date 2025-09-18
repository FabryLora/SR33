<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = [];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'producto_categorias');
    }


    public function modelos()
    {
        return $this->belongsToMany(
            Modelo::class,       // Modelo relacionado
            'modelo_productos',  // Tabla intermedia
            'producto_id',       // FK de producto en la pivote
            'modelo_id'          // FK de modelo en la pivote
        );
    }
    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'producto_marcas');
    }

    public function imagenes()
    {
        return $this->hasMany(ImagenProducto::class, 'producto_id');
    }

    public function subproductos()
    {
        return $this->hasMany(SubProducto::class);
    }

    public function getImageAttribute($value)
    {
        return url("storage/" . $value);
    }

    public function precio()
    {
        return $this->hasOne(ListaProductos::class, 'producto_id')
            ->where('lista_de_precios_id',  session('cliente_seleccionado') ? session('cliente_seleccionado')->lista_de_precios_id : auth()->user()->lista_de_precios_id ?? null);
    }

    public function pedidos()
    {
        return $this->hasMany(PedidoProducto::class, 'producto_id');
    }

    public function ofertas()
    {
        return $this->hasMany(Oferta::class, 'producto_id');
    }
}
