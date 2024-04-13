<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Administradores;

use App\Http\Requests\AdministradoresStoreRequest;

use Illuminate\Support\Facades\Hash;

class AdministradoresController extends Controller
{
    public function index(){
        $admin = Administradores::all();
        $data =[
            'admin' => $admin
        ];

        return response()->json($data, 200);
    }

  

    public function store(AdministradoresStoreRequest $request){
        try{
            Administradores::create([
                'email_ad' => $request->email_ad,
                'password_ad' =>Hash::make($request->password_ad),
                'nombre_ad' => $request->nombre_ad,
                'apellido_ad' => $request->apellido_ad,
                'cargo_ad' => $request->cargo_ad,
                'rol_ad' => $request->rol_ad,
                'modulo_1' => $request->modulo_1,
                'modulo_2' => $request->modulo_2,
                'modulo_3' => $request->modulo_3,
            ]); 
            
            return response()->json([
                'message' => 'Se ha registrado la informacion del administrador'
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
       
       $admin = Administradores::find($id);
       if(!$admin){
         return response()->json([
            'message'=>'Administrador No Encontrada.'
         ],404);
       }
      
       return response()->json([
          'admin' => $admin
       ],200);
    }


    public function destroy($id)
    {
        // Detail 
        $admin = Administradores::find($id);
        if(!$admin){
          return response()->json([
             'message'=>'Administrador no encontrada.'
          ],404);
        }
      
        // Delete Product
        $admin->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }
}
