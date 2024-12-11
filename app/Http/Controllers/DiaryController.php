<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;

class DiaryController extends Controller
{

    //instructor
    public function cronograma()
    {
        return view('trainer.cronograma');
    }
    //aprendiz
    public function calendar()
    {
        return view('apprentice.calendar');
    }


    public function index()
    {
        // Recupera agendas, aplicando los scopes incluidos y de ordenamiento
        $diaries = Diary::included()->sort()->get();
        return response()->json($diaries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'telephone' => 'required|max:255',
            'followup_id' => 'required|exists:followups,id', // Cambiado a followup_id
        ]);

        $diary = Diary::create($request->all());
        return response()->json($diary, 201); // Respuesta con código 201
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Recupera una agenda en específico, aplicando el scope de inclusión
        $diary = Diary::included()->findOrFail($id);
        return response()->json($diary);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diary  $diary
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Diary $diary)
    {
        // Validación de los datos de entrada
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'telephone' => 'required|max:255',
            'followup_id' => 'required|exists:followups,id', // Cambiado a followup_id
        ]);

        // Actualización de agenda
        $diary->update($request->all());
        return response()->json($diary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diary  $diary
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Diary $diary)
    {
        // Elimina agenda
        $diary->delete();
        return response()->json(null, 204); // Respuesta vacía con código 204
    }
}
