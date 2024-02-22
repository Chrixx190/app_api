<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Aulas;
use App\Http\Requests\AulasStoreRequest;



class AulasController extends Controller
{
    public function index(){
        $aulas = Aulas::all();
        $data =[
            'aulas' => $aulas
        ];

        return response()->json($data, 200);
    }

  

    public function store(AulasStoreRequest $request){
        try{
            Aulas::create([
                'nombre_al' => $request->nombre_al,
            ]); 
            
            return response()->json([
                'message' => 'Se ha registrado la informacion del aula'
             ],200);

        } catch (\Exception $e){
            return response()->json([
               //'message' => 'Error en el registro'
               'message' => $e
            ],500);
        } 
    }


    public function show($id)
    {
       
       $aulas = Aulas::find($id);
       if(!$aulas){
         return response()->json([
            'message'=>'Aula No Encontrada.'
         ],404);
       }
      
       return response()->json([
          'aulas' => $aulas
       ],200);
    }


    public function destroy($id)
    {
        // Detail 
        $aulas = Aulas::find($id);
        if(!$aulas){
          return response()->json([
             'message'=>'Aula no encontrada.'
          ],404);
        }
      
        // Delete Product
        $aulas->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }
}
