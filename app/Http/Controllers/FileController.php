<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function formSubmit(Request $request){
        $request->validate([
            'images' => 'required|mimes:jpg,jpeg,png,pdf|max:10240'
         ]);

        try{
            if($request->hasFile('images')){
                $image = $request->file('images');
                $filenameimage = time().'.'.$image->extension();
                $image->move(storage_path() . '/app/public/images/',$filenameimage);
                return response()->json(
                    ['message'=>$filenameimage]
                );
            }
        }catch(Exception $e){
            return response()->json(
                ['message'=>$e.getMessage()]
            );
        }
        /*return response()->json(
            ['succes'=>"ok"]
        );
        $fileName = time().'.'.$request->file->getClientOriginalExtension();
        
        $request->file->move(public_path('upload'),$fileName);
        return response()->json(
            ['succes'=>'archivo subido: '.$fileName]
        );*/
    }

    public function downloadImage($name){
        if(Storage::disk('images')->exists($name)){
            return Storage::disk('images')->get($name);
        }
    }

    public function downloadFile($name){
        if(Storage::disk('pdfs')->exists($name)){
            return Storage::disk('pdfs')->download($name);
        }
    }
}
