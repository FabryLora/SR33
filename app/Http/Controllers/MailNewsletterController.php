<?php

namespace App\Http\Controllers;

use App\Models\MailNewsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MailNewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = MailNewsletter::query()->orderBy('created_at', 'desc');

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where('email', 'LIKE', '%' . $searchTerm . '%');
        }

        $newsletters = $query->paginate($perPage);

        return inertia('admin/newsletterAdmin', [
            'newsletters' => $newsletters,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1) Validación con mensajes personalizados
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', 'max:255', 'unique:mail_newsletters,email'],
        ], [
            'email.required' => 'El email es obligatorio.',
            'email.email'    => 'Ingresá un email válido.',
            'email.unique'   => 'Ese email ya está suscripto.',
            'email.max'      => 'El email es demasiado largo.',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        try {
            // 2) Crear (o ignorar si ya existe por carrera)
            MailNewsletter::firstOrCreate(['email' => $request->input('email')]);

            if ($request->expectsJson()) {
                // 201 Created ayuda al front a diferenciar éxito
                return response()->json([
                    'success' => true,
                    'message' => '¡Te has suscrito correctamente al newsletter!',
                ], 201);
            }

            return back()->with('success', '¡Te has suscrito correctamente al newsletter!');
        } catch (\Throwable $e) {
            Log::error('Newsletter store error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrió un error en el servidor. Intenta nuevamente.',
                ], 500);
            }

            return back()->with('error', 'Ocurrió un error en el servidor. Intenta nuevamente.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:mail_newsletters,email,' . $request->id,
        ]);

        $mailNewsletter = MailNewsletter::findOrFail($request->id);
        $mailNewsletter->update($request->only('email'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $mailNewsletter = MailNewsletter::findOrFail($request->id);
        $mailNewsletter->delete();
    }
}
