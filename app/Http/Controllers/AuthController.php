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

<<<<<<< HEAD
    public function createBackup()
    {
    
        Artisan::call('backup:run');
        
        $backupPath = storage_path('app/backup/' . now()->format('Y-m-d-His'));

        
        return new BinaryFileResponse($backupPath);
=======

    public function allUsers(){
        $usuarios = User::all();
        $data =[
            'usuarios' => $usuarios
        ];
        return response()->json($data, 200);
>>>>>>> 9d5c9080ecb3596085047bb93ab546a37ddc8a39
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

    public function user(){
        return response([
           'user'=>auth()->user()
        ],200);
    }
}
