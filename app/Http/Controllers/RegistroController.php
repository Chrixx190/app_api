<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

use App\Http\Requests\RegistroStoreRequest;

use App\Models\Registro;

class RegistroController extends Controller
{
    public function index(){
        $registro = Registro::all();
        $data =[
            'registro' => $registro
        ];
        return response()->json($data, 200);
    }

  

    public function store(RegistroStoreRequest $request){
        try{
            Registro::create([
                'id_est' => $request->id_est,
                'asistencia_ad' => $request->asistencia_ad,
                'fecha_ad' => $request->fecha_ad,
            ]); 
            
            return response()->json([
                'message' => 'Se ha registrado la informacion de la asistencia'
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
       
       $registro = Registro::find($id);
       if(!$registro){
         return response()->json([
            'message'=>'Registro No Encontrado.'
         ],404);
       }
      
       return response()->json([
          'registro' => $registro
       ],200);
    }


    public function destroy($id)
    {
        // Detail 
        $registro = Registro::find($id);
        if(!$registro){
          return response()->json([
             'message'=>'Registro no encontrado.'
          ],404);
        }
      
        // Delete Product
        $registro->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }
}
