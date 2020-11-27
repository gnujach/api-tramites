<?php

namespace App\Http\Controllers;

use App\Tipousuario;
use Illuminate\Http\Request;

class TipousuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function gettipousuarios()
    {
        $tipousuarios = Tipousuario::all();
        return response()->json(
            $tipousuarios
        );
        return view('home');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tipousuario  $tipousuario
     * @return \Illuminate\Http\Response
     */
    public function show(Tipousuario $tipousuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tipousuario  $tipousuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipousuario $tipousuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tipousuario  $tipousuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipousuario $tipousuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tipousuario  $tipousuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipousuario $tipousuario)
    {
        //
    }
}
