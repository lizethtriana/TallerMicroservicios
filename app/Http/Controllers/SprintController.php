<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Sprint;
class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Sprint::all();
        return response()->json(
            [ 'data'=> $rows],200
        );
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newModel = new Sprint();
        $newModel->nombre = $data['nombre'];
        $newModel->fecha_inicio = $data['fecha_inicio'];
        $newModel->fecha_fin = $data['fecha_fin'];
        $newModel->save();
        return response()->json(
            ['data' =>  'Datos guardados'],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $row = Sprint::find($id);
        // $row = ProgramacionTema::where('nombre', 'Pepe')->get();
        return response()->json(
            ['data' => $row],
            200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
           $data = $request->all();
        $row = Sprint::find($id);
        $row->nombre = $data['nombre'];
    
        $row->save();
        return response()->json(
            ['data' => $row],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $row = Sprint::find($id);
        $row->delete();
        return response()->json(
            ['data' => "Registro eliminado"],
            200
        );
    }
}
