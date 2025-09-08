<?php

namespace App\Jobs;

use App\Models\ListaDePrecios;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\SucursalCliente;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImportarClientesJob implements ShouldQueue
{
    use Queueable;
    protected $archivoPath;
    /**
     * Create a new job instance.
     */
    public function __construct($archivoPath)
    {
        $this->archivoPath = $archivoPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filePath = Storage::path($this->archivoPath);
        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        Log::info('=== INICIO DEBUG EXCEL ===');
        Log::info('Total de filas: ' . count($rows));


        foreach ($rows as $index => $row) {

            if ($index === 0 || trim($row['G']) == 'CUIT') {
                Log::info('Saltando encabezado');
                continue;
            }

            $razon = trim($row['B']);
            $domicilio = trim($row['C']);
            $localidad = trim($row['D']);
            $provincia = trim($row['E']);
            $telefono = trim($row['F']);
            $cuit = trim($row['G']);
            $email = trim($row['H']);
            $descuento_uno = (int) trim($row['I']);
            $nombre_lista = trim($row['J']);
            $pass = trim($row['L']);

            if (!empty($nombre_lista)) {
                $lista_id = ListaDePrecios::where('name', $nombre_lista)->value('id');
            } else {
                $lista_id = ListaDePrecios::where('name', 'MAYORISTA')->value('id');
            }

            $password_final = !empty($pass) ? bcrypt($pass) : bcrypt(trim($cuit));

            $user = User::updateOrCreate([
                'name' => $razon,
                'email' => $email,
                'password' => $password_final,
                'razon_social' => $razon,
                'cuit' => $cuit,
                'direccion' => $domicilio,
                'provincia' => $provincia,
                'localidad' => $localidad,
                'telefono' => $telefono,
                'descuento_uno' => $descuento_uno ?? 0,
                'lista_de_precios_id' => $lista_id,
                'autorizado' => true,

            ]);
        }
    }
}
