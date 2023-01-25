<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FileUpload;
class FileController extends Controller
{
    
      public function upload(Request $request){
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileUpload = new FileUpload;
    
            if($request->file()) {
                echo "hola";
                $file_name = time().'_rosa';
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
    
                $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->path = '/storage/' . $file_name;
                $fileUpload->save();
    
                return response()->json(['success'=>'File uploaded successfully.']);
            }
       }
}