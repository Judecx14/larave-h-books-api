<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function registro(Request $request){

        $request->validate([
            'name'=>'required|string|min:1|max:30',
            'email'=>'required|min:1',
            'password'=>'required|string|min:1',
            'rol'=>'required|max:5',
        ]);

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->rol = $request->input('rol');

        if($user->save()){
            return response()->json(["status"=>TRUE,"user"=>$user],201);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"],500);
        } 

    }

    function updateInfo(Request $request){
        $user = User::where('id',$request->user()->id)->first();
        
        if ($request->input('name')){
            $user->name = $request->input('name');
        }
        if($user->save()){
            return response()->json(["status"=>TRUE,"message"=>"informacion modificada correctamente"]);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function getInfo(Request $request){
        $user = User::where('id',$request->user()->id)->first();
        
        if($user){
            return response()->json(["status"=>TRUE,"name"=>$user->name,
            "imagen"=>$user->imagen,"descripcion"=>$user->descripcion]);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }
}
