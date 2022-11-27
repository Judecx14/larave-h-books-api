<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedBooks;

class SavedBookController extends Controller
{
    function save(Request $request){
        $request->validate([
            'book_id'=>'required|integer|min:1',
        ]);

        $bookSaved = new SavedBooks;
        $bookSaved->user_id = $request->user()->id;
        $bookSaved->book_id = $request->book_id;

        if($bookSaved->save()){
            return response()->json(["status"=>TRUE, "message"=>$bookSaved],200);
        }else{
            return response()->json(["status"=>FALSE, "message"=>"Algo salio mal"],500);
        }
    }

    function delete(Request $request,$id){
        $book = SavedBooks::where('book_id',$id)->where('user_id',$request->user()->id);
        if($book->delete()){
            return response()->json(["status"=>TRUE, "message"=>$book],200);
        }else{
            return response()->json(["status"=>FALSE, "message"=>"Algo salio mal"],500);
        }
    }

    function get(Request $request){
        $list = SavedBooks::where('user_id',$request->user()->id)->get();
        if($list){
            return response()->json(["status"=>TRUE, "message"=>$list],200);
        }else{
            return response()->json(["status"=>FALSE, "message"=>"Algo salio mal"],500);
        }
    }
}
