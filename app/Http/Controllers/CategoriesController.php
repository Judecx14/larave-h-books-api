<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
class CategoriesController extends Controller
{
    function save(Request $request){
        $request->validate([
            'categoria'=>'required|string|min:1|max:50',
        ]);

        $categoria = new Category;
        $categoria->categoria = $request->input('categoria');


        if($categoria->save()){
            return response()->json(["status"=>TRUE,"categories"=>$categoria], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function get(Request $request){
        $categoria = Category::all();
        if ($categoria){
            return response()->json(["status"=>TRUE,"categories"=>$categoria],200);
         } else{
             return response()->json(["status"=>FALSE,"MESSAGE"=>"No se ha encontrado"]);
         }
    }

    function update(Request $request,$id){
        $category = Category::find($id);
        $category->categoria = $request->categoria;
        if($category->save()){
            return response()->json(["status"=>TRUE,"message"=>$category],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se ha podido actualizar"]);
            
        } 
    }

    function delete($id){
        $category = Category::find($id);
        
        if($category->delete()){
            return response()->json(["status"=>TRUE,"message"=>"Se elimino correctamente"],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se ha podido eliminar"],200);
        }
    }
    
    function books($id){
        $books = Book::where('category_id',$id)->get();
        if($books){
            return response()->json(["status"=>TRUE,"message"=>$books],200);
        }else{
            return response()->json(["status"=>FALSE,"message"=>"No se ha podido eliminar"],200);
        }
    }
}
