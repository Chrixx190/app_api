<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\User;

class AuthController extends Controller
{


    public function allUsers(){
        $usuarios = User::all();
        $data =[
            'usuarios' => $usuarios
        ];
        return response()->json($data, 200);
    }

    public function register(Request $request){
        $attrs = $request->validate([
           'nombre'=> 'required|string',
           'apellido'=> 'required|string',
           'cargo'=> 'required|string',
           'rol'=> 'required|string',
           'email'=> 'required|email|unique:users,email',
           'password'=> 'required|min:6',
        ]);

        $user = User::create([
            'nombre' => $attrs['nombre'],
            'apellido' => $attrs['apellido'],
            'cargo' => $attrs['nombre'],
            'rol' => $attrs['rol'],
            'email' => $attrs['email'],
            'password' => bcrypt($attrs['password']),
        ]);

        return response([
            'user'=> $user,
            'token' => $user->createToken('secret')->plainTextToken
        ],200);
    }


    public function login(Request $request){
        $validated = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        if(!Auth::attempt($validated)){
            return response()->json([
                'message'=> 'Informacion invalida'
            ]);
        }

        $user = User::where('email',$validated['email'])->first();

        return response()->json([
            'token' => $user->createToken('secret')->plainTextToken,
            'user'=> $user,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request){
        //$user = User::where('email',$request->email)->first();
        $request->tokens()->delete();
        return response()->json([
            "message"=>"Se ha cerrado la sesion"
        ]);
    }


    public function userDelete($id){
        // Detail 
        $usuario = User::find($id);
        if(!$usuario){
          return response()->json([
             'message'=>'Usuario no encontrado.'
          ],404);
        }
      
        // Delete Product
        $usuario->delete();
      
        // Return Json Response
        return response()->json([
            'message' => "Se ha eliminado correctamente."
        ],200);
    }

    public function user(){
        return response([
           'user'=>auth()->user()
        ],200);
    }
}
