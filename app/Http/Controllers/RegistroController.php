<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;

use App\Http\Requests\RegistroStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\RegistroAsistenciaStoreRequest;
use Carbon\Carbon;
use App\Models\Registro;
use App\Models\DetalleRegistros;

class RegistroController extends Controller
{
    public function index(){
        $registro = Registro::all();
        $data =[
            'registro' => $registro
        ];
        return response()->json($data, 200);
    }

  
    public function storeRegistro(Request $request) {
        try {
            // Obtener los datos del cuerpo de la solicitud
            $datos = json_decode($request->getContent(), true);
    
            // Preparar un arreglo para almacenar los detalles de asistencia
            $detallesAsistenciaInsert = [];
    
            // Iterar sobre el mapa de datos
            foreach ($datos as $key => $detallesAsistencia) {
                // Iterar sobre la lista de detalles de asistencia
                foreach ($detallesAsistencia as $detalle) {
                    // Agregar cada detalle de asistencia al arreglo de inserción
                    $detallesAsistenciaInsert[] = [
                        'id_est' => $detalle['id_est'],
                        'asistencia_ad' => $detalle['asistencia_ad'],
                        'id_registro_persona' => $detalle['id_registro_persona'],
                        'created_at' => now(), // Opcional: establecer la fecha de creación
                        'updated_at' => now(), // Opcional: establecer la fecha de actualización
                    ];
                }
            }
    
            // Insertar los detalles de asistencia en la base de datos
            Registro::insert($detallesAsistenciaInsert);
    
            return response()->json([
                'message' => 'Detalles de asistencia guardados correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en el registro de los detalles de asistencia: ' . $e->getMessage()
            ], 500);
        }
    }
    
    
    public function store(RegistroStoreRequest $request){
        try {
            $registro = DetalleRegistros::where('fecha_registro', '=',$request->fecha_registro )
            -> where('id_aula', '=',$request->id_aula)
            ->first();
                if(!Empty($registro)){
                    return response()->json([
                        'message' => 'Existe un registro con la fecha de Hoy',
                    ], 404);
                    return;
                }else{
                    $registroUltimo = DetalleRegistros::create([
                        'id_aula' => $request->id_aula,
                        'fecha_registro' => $request->fecha_registro,
                    ]); 
                    
                    return response()->json([
                        'registro' => $registroUltimo, // Devuelve el registro recién creado como parte de la respuesta
                    ], 200);
                }
                
            }
         catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en el registro: ' . $e->getMessage(), // Incluye el mensaje de error en la respuesta
            ], 500);
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
    public function showReporte($fecha,$curso)
    {
       
        $registros = Registro::join('registro_persona', 'registro_persona.id', '=', 'registro.id_registro_persona')
        ->join('estudiantes', 'registro.id_est', '=', 'estudiantes.id')
        ->where('fecha_registro', '=', $fecha)
        ->where('id_aula', '=', $curso)
        ->get();
        return response()->json([
            'registro' => $registros
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

    public function todosRegistrosPorAula($id){
        if($id!=0){
            $aulas = DetalleRegistros::where('id_aula',$id)->get();
            $data=$data =[
                'registro' => $aulas
            ];
            return response()->json($data);
          }
          
          return response([
            'status' => 'error',
            'description' => 'Error al traer el estudiante por el id de `aula`',
       ], 422); 
    }





    public function deleteRegister($id)
    {
        // Detail 
        $register = DetalleRegistros::find($id);
        if(!$register){
          return response()->json([
             'message'=>'Registro no encontrado.'
          ],404);
        }
      
        // Delete Product
        $register->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }

  
}
