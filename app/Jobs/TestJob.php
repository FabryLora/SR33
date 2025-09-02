<?php

namespace App\Jobs;


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

class TestJob implements ShouldQueue
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

            $marca_code = trim($row['F']);
            $modelos_raw = trim($row['H']);

            if ($marca_code === '') {
                Log::warning("Fila {$index}: sin código de marca (columna F vacía).");
                continue;
            }

            if ($modelos_raw === '') {
                Log::warning("Fila {$index}: sin modelos (columna H vacía).");
                continue;
            }


            // Normalizamos la lista de modelos: tolera ',', ';', '/', '|'
            $normalizado = str_replace([';', '/', '|'], ',', $modelos_raw);
            $partes      = array_map(
                fn($m) => trim($m),
                explode(',', $normalizado)
            );

            // Limpiamos vacíos y duplicados (por si vienen "modelo, modelo ")
            $modelos = array_values(array_unique(array_filter($partes, fn($m) => $m !== '')));


            foreach ($modelos as $modelo) {
                $marca_id = Marca::where('code', $marca_code)->first()->id ?? null;
                if ($marca_id) {
                    Modelo::updateOrCreate(
                        [
                            'name' => $modelo
                        ],
                        [
                            'marca_id' => $marca_id
                        ]
                    );
                }
            }
        }

        Log::info('=== FIN DEBUG EXCEL ===');
    }
}
