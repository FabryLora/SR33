<?php

namespace App\Jobs;

use App\Models\Categoria;
use App\Models\CategoriaMarca;
use App\Models\ListaProductos;
use App\Models\Marca;
use App\Models\MarcaHelper;
use App\Models\Modelo;
use App\Models\Producto;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CargarSubCategoriasJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $archivo;

    public function __construct($archivo)
    {
        $this->archivo = $archivo;
    }

    public function handle()
    {
        $filePath = Storage::path($this->archivo);
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

            if (empty($row) || !isset($row['A']) || !isset($row['B'])) {
                Log::info("Fila {$index} vacía o incompleta");
                continue;
            }

            $codigo_categoria = trim($row['A']);
            $codigo_subcategoria = trim($row['B']);
            $nombre_subcategoria = trim($row['C']);

            if ($codigo_categoria === '') {
                Log::warning("Fila {$index}: sin código de categoría (columna A vacía).");
                continue;
            }

            if ($codigo_subcategoria === '') {
                Log::warning("Fila {$index}: sin código de subcategoría (columna B vacía).");
                continue;
            }

            if ($nombre_subcategoria === '') {
                Log::warning("Fila {$index}: sin nombre de subcategoría (columna C vacía).");
                continue;
            }

            $categoria = Categoria::where('code', $codigo_categoria)->first();
            if (!$categoria) {
                Log::warning("Fila {$index}: categoría con código '{$codigo_categoria}' no encontrada.");
                continue;
            }

            $marca = Marca::updateOrCreate(
                ['name' => $nombre_subcategoria],
                ['code' => $codigo_subcategoria]

            );

            MarcaHelper::updateOrCreate(
                ['code' => $codigo_subcategoria],
                ['name' => $nombre_subcategoria]
            );

            if ($marca) {
                CategoriaMarca::updateOrCreate(
                    [
                        'categoria_id' => $categoria->id,
                        'marca_id' => $marca->id
                    ],
                    [
                        'categoria_id' => $categoria->id,
                        'marca_id' => $marca->id
                    ]
                );
            }
        }

        Log::info('=== FIN DEBUG EXCEL ===');
    }
}
