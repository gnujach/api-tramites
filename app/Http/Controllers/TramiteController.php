<?php

namespace App\Http\Controllers;

use App\Tramite;
use Illuminate\Http\Request;
use App\Http\Resources\Tramite as TramiteResource;
use App\Http\Resources\TramiteCollection;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tramites = new TramiteCollection(
            Tramite::filter(request()->only('search'))
                ->paginate(10)
        );
        return $tramites;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //Autorización
        //Validación
        $data = request()->validate([
            'nombre' => 'required|min:5|max:45',
        ]);
        //Lógica
        $Tramite = Tramite::create([
            'nombre' => request()->nombre,
            'dependencia_id' => request()->dependencia_id,
            'tipousuario_id' => request()->tipousuario_id,
            'departamento_id' => request()->departamento_id,
            'objetivo' => request()->objetivo,
            'documento_obtenido' => request()->documento_obtenido,
            'datos_institucionales' => request()->datos_institucionales,
            'plazo_respuesta' => request()->plazo_respuesta,
            'costo' => request()->costo,
            'url_proceso' => request()->url_proceso,
            'activo' => request()->activo
        ]);
        $tramiteResource = new TramiteResource($Tramite);
        //Respuesta
        return $tramiteResource;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(Tramite $tramite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramite $tramite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tramite $tramite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tramite $tramite)
    {
        //
    }
}
