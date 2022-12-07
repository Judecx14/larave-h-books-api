<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email'=> 'required',
            'password'=> 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        
        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        
        if($user->rol == "admin"){
            $token = $user->createToken($request->email,['admin:admin','user:user'])->plainTextToken; //Crea el token y se asignan permisos donde el request->email sea igual al que estan en la bd, despue retornas el token en texto plano 
        }else{ 
        $token = $user->createToken($request->email,['user:user'])->plainTextToken; //Crea el token y se asignan permisos donde el request->email sea igual al que estan en la bd, despue retornas el token en texto plano 
        }
        
        return response()->json(["status"=>TRUE,"token"=>$token,"rol"=>$user->rol,"id"=>$user->id],200);
    }

    public function logout(Request $request){
        return response()->json(["status"=>TRUE,"Tokens afectados" => $request->user()->tokens()->delete()],200);
    }
    
    public function check(Request $request){
        return response()->json($request->user()->rol === 'admin' ? true : false);
    }
}
