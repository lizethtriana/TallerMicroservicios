<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class retro_itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $rows= retro_items::all();
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
        $newRetro_Item = new Retro_item();
        $newRetro_Item->id = $data['id'];
        $newRetro_Item->nombre = $data['sprint_id'];
        $newRetro_Item->categoria = $data['categoria'];
        $newRetro_Item->descripcion = $data['descripcion'];
        $newRetro_Item->cumplida = $data['cumplida'];
        $newRetro_Item->fecha_revision = $data['fecha_revision'];
        $newRetro_Item->created_at = $data['created_at'];
        $newRetro_Item->updated_at = $data['updated_at'];
        $newRetro_Item->email = $data['email'];
        $newRetro_Item->edad = $data['age'];
        $newRetro_Item->save();
        return response()->json(['data' => 'Datos guardados'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
             $row = Retro_item::find($id);
        if (empty($row)) {
            return response()->json(['data' => 'No existe'], 404);
        }
        return response()->json(['data' => $row], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,string $id)
    {
        $row = Retro_item::find($id);
        if (empty($row)) {
            return response()->json(['data' => 'No existe'], 404);
        }
        $data = $request->all();
        $row->nombre = $data['sprints_id'];
        $row->categoria = $data['categoria'];
        $row->descripcion = $data['descripcion'];
        $row->cumplida = $data['cumplida'];
        $row->fecha_revision = $data['fecha_revision'];
        $row->created_at = $data['created_at'];
        $row->updated_at = $data['updated_at'];
        $row->email = $data['email'];
        $row->edad = $data['age'];
        $row->save();
        return response()->json(['data' => 'Datos guardados'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $row = Retro_item::find($id);
        if (empty($row)) {
            return response()->json(['data' => 'No existe'], 404);
        }
        $row->delete();
        return response()->json(['data' => 'Datos eliminados'], 200);
    }
}
