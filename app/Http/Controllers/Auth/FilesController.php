<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile; 
//use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($request != ""){
            $files = File::where('name', 'like',"%{$search}%")->paginate(10);
          
        }
        else{
            $files = File::paginate(10);
        }
   
       // $posts = Post::with('gallery', 'category')->paginate(10);
        //return $posts;
	 
        return view('auth.files.index' , compact('files','search'));
    }
	 public function create()
    {    
        return view('auth.files.create');
    }
	
	 public function store(Request $request)
	 {
		  $user = auth()->user();
		  try{
           
			  $request->validate([
           			'file' => 'required|mimes:pdf,xlx,csv,xlsx,docx|max:20971520',
       			 ]);
                
				$file = $request->file;
				
               $name_gen = hexdec(uniqid());
                //ดึงและแปลงนามสกุลไฟล์เป็นตัวเล็ก
                $img_ext = strtolower($file->getClientOriginalExtension());
                //ต่อชื่อไฟล์		
			
                $fileName = $name_gen.'.'.$img_ext;
			   //  $imgePath = $file->storeAs('files', $fileName);
			  
			//	$request->file('file')->store('files', $fileName);
             
			    $imgePath = $file->move(public_path('files'), $fileName);
            
    
        		
 				//dd($fileName);
			   File::create([
               
                'name' => $request->name,
                'file' => $fileName,
                'status' => $request->status,
			    'users_id' => $user->id
                
    
				]);
			  
			}
			catch(\Exception $ex){
			//	dd($ex->getMessage());

			}
		 
		   return to_route('files.index');
	 }
	
	 public function show(string $id)
    {
        //
    }
	
	 public function edit(File $file)
    {
        return view('auth.files.edit', compact('file'));
    }
	
	 public function update(Request $request, File $file)
    {
		
		 
		 if($request->hasFile('file')){
            $file = $request->file;
			 
			 $request->validate([
           			'file' => 'required|mimes:pdf,xlx,csv,xlsx,docx|max:2048',
       			 ]);

			// dd($file);
             //gen ชื่อไฟล์
             $name_gen = hexdec(uniqid());
             //ดึงและแปลงนามสกุลไฟล์เป็นตัวเล็ก
             $img_ext = strtolower($file->getClientOriginalExtension());
             //ต่อชื่อไฟล์
             $fileName = $name_gen .'.'.$img_ext ;

            //$fileName = time(). $file->getClientOriginalName();

           $imgePath = $file->move(public_path('files'), $fileName);
            
            File::where('id',$file->id)->UploadedFile(['file' => $fileName]);

        }
        $file->update($request->all());
        // dd($request->all());
        return to_route('files.index')->with('warning', 'Edit Data Update successfully');
      
		 
	}
	public function destroy(File $file)
    {
        //dd($id);
         $file->delete();
         return to_route('files.index')->with('danger', 'Deleted Data  successfully');
    }
}
