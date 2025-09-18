<?php

namespace App\Jobs;

use App\Models\Categoria;
use App\Models\ListaProductos;
use App\Models\Marca;
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

class CargarCategoriasJob implements ShouldQueue
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

            if (empty($row) || !isset($row['A']) || $row['B'] == "CODIGO SUBCATEGORIA") {
                Log::info("Fila {$index} vacía o incompleta");
                continue;
            }

            $codigo = trim($row['A']);
            $nombre = trim($row['B']);

            if ($codigo === '') {
                Log::warning("Fila {$index}: sin código de marca (columna A vacía).");
                continue;
            }

            if ($nombre === '') {
                Log::warning("Fila {$index}: sin modelos (columna B vacía).");
                continue;
            }


            Categoria::updateOrCreate(
                ['code' => $codigo],
                ['name' => $nombre]
            );
        }

        Log::info('=== FIN DEBUG EXCEL ===');
    }
}
