<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Estudiantes;

use App\Http\Requests\EstudiantesStoreRequest;

class EstudiantesController extends Controller
{
    public function index(){
        $estudiantes = Estudiantes::all();
        $data =[
            'estudiantes' => $estudiantes
        ];

        return response()->json($data, 200);
    }

  

    public function store(EstudiantesStoreRequest $request){
        try{
            Estudiantes::create([
                'nombre_es' => $request->nombre_es,
                'id_aulas' => $request->id_aulas,
            ]); 
            
            return response()->json([
                'message' => 'Se ha registrado la informacion del estudiante'
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
       
       $estudiantes = Estudiantes::find($id);
       if(!$estudiantes){
         return response()->json([
            'message'=>'Estudiante No Encontrado.'
         ],404);
       }
      
       return response()->json([
          'estudiantes' => $estudiantes
       ],200);
    }


    public function destroy($id)
    {
        // Detail 
        $estudiantes = Estudiantes::find($id);
        if(!$estudiantes){
          return response()->json([
             'message'=>'Estudiante no encontrado.'
          ],404);
        }
      
        // Delete Product
        $estudiantes->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }
}
