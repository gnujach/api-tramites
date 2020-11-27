<?php

namespace App\Http\Controllers;

use App\Requisito;
use Illuminate\Http\Request;
use App\Http\Resources\RequisitoCollection;
use App\Http\Resources\Requisito as RequisitoResource;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitos = new RequisitoCollection(
            Requisito::where([
                'activo'   => true
            ])->orderBy('id', 'desc')
                ->paginate(5)
        );
        return $requisitos;
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'nombre' => 'required|min:5|max:45',
        ]);
        $Requisito = Requisito::create([
            'nombre' => request()->nombre,
            'tipo' => request()->tipo,
            'observaciones' => request()->observaciones,
            'activo' => true,
        ]);
        $requisitoResource = new RequisitoResource($Requisito);
        return $requisitoResource;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function show(Requisito $requisito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function edit(Requisito $requisito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requisito $requisito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requisito  $requisito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisito $requisito)
    {
        //
    }
    /** 
     * obtener catalogo de requisitos
     * @return \Illuminate\Http\Resources
     */
    public function getRequisitos()
    {
        $requisitos = Requisito::where('activo', 1)->get();
        return response()->json(
            $requisitos
        );
        return view('home');
    }
}
