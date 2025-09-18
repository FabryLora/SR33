<?php

namespace App\Jobs;

use App\Models\Categoria;
use App\Models\ListaProductos;
use App\Models\Marca;
use App\Models\MarcaHelper;
use App\Models\MarcaModelo;
use App\Models\Modelo;
use App\Models\ModeloProducto;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\ProductoMarca;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportarProductosDesdeExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $archivoPath;

    public function __construct($archivoPath)
    {
        $this->archivoPath = $archivoPath;
    }

    public function handle()
    {
        $filePath = Storage::path($this->archivoPath);
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        Log::info('=== INICIO DEBUG EXCEL ===');
        Log::info('Total de filas: ' . count($rows));

        foreach ($rows as $index => $row) {
            Log::info("Fila {$index}: " . json_encode($row));

            if ($index === 0) {
                Log::info('Saltando encabezado');
                continue;
            }

            if (empty($row) || !isset($row['A']) || trim($row['C']) == "Producto") {
                Log::info("Fila {$index} vacía o incompleta");
                continue;
            }

            $codigo_sr = trim($row['B']);
            $name = trim($row['C']);
            $desc = trim($row['D']);
            $categoria_code = trim($row['E']);
            $subcategoria_code = trim($row['F']);
            $codigo_original = trim($row['G']);
            $modelos_raw = trim($row['H']);


            $normalizado = str_replace([';', '/', '|'], ',', $modelos_raw);
            $partes      = array_map(
                fn($m) => trim($m),
                explode(',', $normalizado)
            );

            $modelos = array_values(array_unique(array_filter($partes, fn($m) => $m !== '')));


            $marcasHelpers = MarcaHelper::where('code', $subcategoria_code)->first() ?? null;
            if ($marcasHelpers == null) {
                continue;
            }
            $marcaUltima = Marca::where('name', $marcasHelpers->name)->first()->id ?? null;

            if ($marcaUltima == null) {
                continue;
            }

            $producto = Producto::updateOrCreate([
                'code_sr' => $codigo_sr
            ], [
                'name' => $name,
                'desc' => $desc,
                'code' => $codigo_original,
                'categoria_id' => Categoria::where('code', $categoria_code)->first()->id ?? null,
                'marca_id' => $marcaUltima,
            ]);


            if ($modelos && $producto) {

                foreach ($modelos as $modelo) {
                    $modelo_nuevo = Modelo::updateOrCreate(
                        ['name' => $modelo],
                        ['name' => $modelo, 'marca_id' => $marcaUltima],

                    );
                    if ($modelo_nuevo) {
                        ModeloProducto::updateOrCreate(
                            [
                                'producto_id' => $producto->id,
                                'modelo_id' => $modelo_nuevo->id
                            ]
                        );
                    }
                }
            }

            if ($producto) {
                ProductoCategoria::updateOrCreate(
                    [
                        'producto_id' => $producto->id,
                        'categoria_id' => $producto->categoria_id
                    ],
                    [
                        'producto_id' => $producto->id,
                        'categoria_id' => $producto->categoria_id
                    ]
                );

                ProductoMarca::updateOrCreate(
                    [
                        'producto_id' => $producto->id,
                        'marca_id' => $marcaUltima
                    ],
                    [
                        'producto_id' => $producto->id,
                        'marca_id' => $marcaUltima
                    ]
                );
            }
        }

        Log::info('=== FIN DEBUG EXCEL ===');
    }
}
