<?php

namespace App\Http\Controllers;

use App\Tramite;
use App\Requisito;
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
                ->orderBy('id', 'desc')
                ->with('departamento')
                ->with('dependencia')
                ->with('tipousuario')
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
        $dependencia_id = 1;

        $data = request()->validate([
            'nombre' => 'required|min:5|max:45',
        ]);
        $departamento_id = request()->set_departamento['id'];
        $tipousuario_id = request()->set_tipousuario['id'];
        //Lógica
        $Tramite = Tramite::create([
            'nombre' => request()->nombre,
            'dependencia_id' => $dependencia_id,
            'tipousuario_id' => $tipousuario_id,
            'departamento_id' => $departamento_id,
            'objetivo' => request()->objetivo,
            'documento_obtenido' => request()->documento_obtenido,
            'datos_institucionales' => request()->datos_institucionales,
            'plazo_respuesta' => request()->plazo,
            'costo' => 0,
            'url_proceso' => request()->url_proceso,
            'activo' => true
        ]);
        $tramiteResource = new TramiteResource($Tramite);
        //Respuesta
        return $tramiteResource;
    }
    /**
     * Save requisitos a tramite
     */
    public function addreqtotramite(int $id)
    {
        $req_valido = false;
        $tramite = Tramite::findOrFail($id);
        $requisitos = request()->requisitos;
        foreach ($requisitos as $requisito) {
            $req = Requisito::find($requisito);
            if ($req) {
                $req_valido = true;
            }
        }
        if ($req_valido)
            $tramite->requisitos()->sync($requisitos);
        return response()->json($requisitos);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function show(Tramite $tramite)
    {
        $tramiteResource = new  TramiteResource($tramite);
        return $tramiteResource;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tramite  $tramite
     * @return \Illuminate\Http\Response
     */
    public function edit(Tramite $tramite)
    {
        $tramiteResource = new  TramiteResource($tramite);
        return $tramiteResource;
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
