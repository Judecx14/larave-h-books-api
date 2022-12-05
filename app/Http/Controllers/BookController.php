<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class BookController extends Controller
{
    function save(Request $request){
        $request->validate([
            'category_id'=>'required|integer|min:1',
            'titulo'=>'required|string|min:1|max:100',
            'autor'=>'required|string|min:1|max:100',
            'editorial'=>'required|string|min:1|max:100',
            'isbn'=>'required|string|min:1|max:13',
            'numero_paginas'=>'required|min:1',
            'edicion'=>'required|string|min:1|max:100',
            'año_lanzamiento'=>'required|string|min:1',
            'sinopsis'=>'required|min:1',
            'pdf'=>'required|mimes:pdf|min:1|max:200',
            'imagen'=>'required|mimes:jpg,jpeg,png|min:1|max:10240',
        ]);

        $book = new Book;
        $book->category_id = $request->category_id;
        $book->titulo = $request->titulo;
        $book->autor = $request->autor;
        $book->editorial = $request->editorial;
        $book->isbn = $request->isbn;
        $book->numero_paginas = $request->numero_paginas;
        $book->edicion = $request->edicion;
        $book->año_lanzamiento = $request->año_lanzamiento;
        $book->sinopsis = $request->sinopsis;
        //pdf request
        if($request->hasFile('pdf')){
            $pdf = $request->file('pdf');
            $filenamepdf = time().'.'.$pdf->extension();
            $pdf->move(storage_path().'/app/public/pdfs/',$filenamepdf);
            $book->pdf = $filenamepdf;
        }else{
            $book->pdf = 'default';
        }
        //image request
        if($request->hasFile('imagen')){
            $image = $request->file('imagen');
            $filenameimage = time().'.'.$image->extension();
            $image->move(storage_path() . '/app/public/images/',$filenameimage);
            $book->imagen = $filenameimage;
        }else{
            $book->imagen = 'default';
        }
        if($book->save()){
            return response()->json(["status"=>TRUE,"book"=>$book], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function get(Request $request){
        $books = DB::table('books')
                    ->join('categories','books.category_id','=','categories.id')
                    ->select('books.*','categories.categoria')->get();
        if($books){
            return response()->json(["status"=>TRUE,"books"=>$books], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }

    function update(Request $request,$id){
        $book = Book::find($id);
        if($request->titulo){
            $book->titulo = $request->titulo;
        }
        if($request->category_id){
            $book->category_id = $request->category_id;
        }
        if($request->autor){
            $book->autor = $request->autor;
        }
        if($request->editorial){
            $book->editorial = $request->editorial;
        }
        if($request->isbn){
            $book->isbn = $request->isbn;
        }
        if($request->numero_paginas){
            $book->numero_paginas = $request->numero_paginas;
        }
        if($request->edicion){
            $book->edicion = $request->edicion;
        }
        if($request->año_lanzamiento){
            $book->año_lanzamiento = $request->año_lanzamiento;
        }
        if($request->sinopsis){
            $book->sinopsis = $request->sinopsis;
        }
        if($request->hasFile('pdf')){
            Storage::disk('pdfs')->delete($book->pdf);
            $pdf = $request->file('pdf');
            $filenamepdf = time().'.'.$pdf->extension();
            $pdf->move(storage_path().'/app/public/pdfs/',$filenamepdf);
            $book->pdf = $filenamepdf;
        }
        if($request->hasFile('imagen')){
            Storage::disk('images')->delete($book->imagen);
            $image = $request->file('images');
            $filenameimage = time().'.'.$image->extension();
            $image->move(storage_path() . '/app/public/images/',$filenameimage);
            $book->imagen = $filenameimage;
        }
        if($book->save()){
            return response()->json(["status"=>TRUE,"book"=>$book], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
        
    }

    function name(Request $request,$name){
        $book = DB::table('books')->where('titulo','like','%'.$name.'%')
                                ->orWhere('autor','like','%'.$name.'%')
                                ->orWhere('editorial','like','%'.$name.'%')
                                ->get();
        if($book){
            return response()->json(["status"=>TRUE,"book"=>$book], 201);
        }else {
            return response()->json(["status"=>FALSE,"message"=>"Algo salio mal"]);
        }
    }


    function show($id){
        try {
            $book = Book::find($id);
            return response()->json(["status"=>TRUE,"message"=>"","libro"=>$book]);
        } catch (\Throwable $th) {
            return response()->json(["status"=>FALSE,"message"=>$th->getMessage()]);
        }
    }
}
