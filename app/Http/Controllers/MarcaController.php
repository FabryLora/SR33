<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = $request->input('per_page', 10);

        $query = Marca::query()->with('categoria')->orderBy('order', 'asc');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        }

        $marcas = $query->paginate($perPage);
        $categorias = Categoria::orderBy('order', 'asc')->get();


        return Inertia::render('admin/marcasAdmin', [
            'marcas' => $marcas,
            'categorias' => $categorias,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);



        Marca::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $marca = Marca::findOrFail($request->id);
        if (!$marca) {
            return redirect()->back()->with('error', 'No se encontró la marca.');
        }

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'order' => 'nullable|string|max:255',
            'categoria_id' => 'nullable|exists:categorias,id',
        ]);


        $marca->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $marca = Marca::findOrFail($request->id);
        if (!$marca) {
            return redirect()->back()->with('error', 'No se encontró la marca.');
        }


        $marca->delete();

        return redirect()->back()->with('success', 'Marca eliminada correctamente.');
    }
}
