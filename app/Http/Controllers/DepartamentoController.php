<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;
use App\Http\Resources\Departamento as DepartamentoResource;
use App\Http\Resources\DepartamentoCollection;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return response()->json(request('search'), 200);
        // $departamentoQuery = Departamento::filter(request()->only('search'))
        //     ->get();

        $departamentos = new DepartamentoCollection(
            Departamento::filter(request()->only('search'))
                ->paginate(10)
        );
        // $departamentos = new DepartamentoCollection(
        //     Departamento::all()
        //         ->filter(request()->only('search'))
        // );
        // $q = strlen(request('search')) ? request('search') : '';
        // $departamentos = new DepartamentoCollection(
        //     Departamento::where('nombre_departamento', 'like', '%' . $q . '%')
        //         ->get()
        // );

        // $departamentos = new DepartamentoCollection(Departamento::all());
        return $departamentos;
    }
    public function getdepartamentos()
    {
        $departamentos = Departamento::where('activo', 1)->get();
        return response()->json(
            $departamentos
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
        // $data = request()->validate([
        //     'nombre_departamento' => '',
        // ]);
        // $departamento = Departamento::create($data);
        // $departamentoCol = new DepartamentoResource($departamento);
        // return $departamentoCol;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            // 'nombre_departamento' => 'required|unique:departamentos|max:25|min:5',
            'nombre_departamento' => 'required|max:45|min:5',
        ]);
        $departamento = Departamento::create($data);
        $departamentoCol = new DepartamentoResource($departamento);
        return $departamentoCol;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        $departamentoR = new  DepartamentoResource($departamento);
        return $departamentoR;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $data = request()->validate([
            'nombre_departamento' => 'required|unique:departamentos|max:25|min:5',
        ]);
        $departamento->update(request()->all());
        $departamentoUpdate = new DepartamentoResource($departamento);
        return $departamentoUpdate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
