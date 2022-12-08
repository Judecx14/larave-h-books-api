<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class CitaController extends Controller
{
    function save(Request $request){
        $cita = new Cita;
        $cita->cita = $request->cita;
        $cita->book_id = $request->book_id;

        if($cita->save()){
            return response()->json(["status"=>TRUE,"cita"=>$cita], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function get(){
        //$citas = Cita::all();
        $citas = DB::table('citas')
                ->join('books','books.id','=','citas.book_id')
                ->select('citas.*','books.titulo')->get();
        if($citas){
            return response()->json(["status"=>TRUE,"citas"=>$citas], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function getRandom(){
        $citas = DB::table('citas')->inRandomOrder()->limit(1)->get();
        if($citas){
            return response()->json(["status"=>TRUE,"citas"=>$citas], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function update(Request $request,$id){
        $cita = Cita::find($id);
        if($request->cita){
            $cita->cita = $request->cita;
        }
        if($request->book_id){
            $cita->book_id = $request->book_id;
        }
        if($cita->save()){
            return response()->json(["status"=>TRUE,"cita"=>$cita], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function delete($id){
        $cita = Cita::find($id);
        if($cita->delete()){
            return response()->json(["status"=>TRUE,"message"=>"Se elimino correctamente"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se ha podido eliminar"],200);
        }
    }
}
