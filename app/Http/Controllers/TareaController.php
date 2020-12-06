<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarea;
// use App\Tramite;

class TareaController extends Controller
{
    public function store(Request $request, $id)
    {
        //Autorización
        //Validación
        $data = $request->validate([
            'tareas.*.nombre' => 'required|string|distinct|min:5|max:120,',
        ]);
        if (\App\Tramite::where('id', $id)->firstOrFail()) {
            // return response()->json($tramite, 200);
            Tarea::where('tramite_id', $id)->delete();
            // $tramite_id = request()->set_id['id'];
            $tasks = $request->input('tareas');
            foreach ($tasks as $task) {
                Tarea::create(['tramite_id' => $id, 'nombre' => $task['nombre']]);
            }
        }
        return response()->json(TRUE, 201);
    }
}
