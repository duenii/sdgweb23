<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categorire;
use App\Models\Category;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     

       $search = $request['search'] ?? "";
       
        if ($request != "") {
            //$cat = Category::all();
            $category = Category::where('name', 'like', "%{$search}%")->paginate(10);
            //$posts = Post::with('gallery', 'category')->paginate(10);

        } else {
            $category = Category::orderBy('updated_at', 'DESC')->paginate(10);
        }
        //return $posts;
        //$cat = Category::all();
       // return view('auth.posts.index', compact('posts', 'search','cat'));
       return view('auth.category.index',compact('category', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required',
        ]);

        if($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
     
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
     
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
     
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            //$request->file('file')->storeAs('public/images/posts', $filenametostore);
            $request->file('file')->storeAs('public/images/category/thumbnail', $filenametostore);
           
            //Resize image here
            //$thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
            // $thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
            // $img = Image::make($thumbnailpath)->resize(250, 250, function($constraint) {
            //     $constraint->aspectRatio();
            // });
            //     $img->save($thumbnailpath);

        }

        if($request->content==''){
            $data = 'รายละเอียดข้อมูลเนื้อหา';
        }
        else
        {

        $data = $request->content;

        //loading the html data from the summernote editor and select the img tags from it
        $dom = new \DOMDocument();            
           
        $dom->loadHtml(mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8')); 
      // $dom->encoding = 'utf-8';
        $images = $dom->getElementsByTagName('img');
 
     
      foreach($images as $k => $img){
          //for now src attribute contains image encrypted data in a nonsence string
          $data = $img->getAttribute('src');
         
          //getting the original file name that is in data-filename attribute of img
          $file_name = $img->getAttribute('data-filename');
 
          //extracting the original file name and extension
          
          $arr = explode('.', $file_name);
          $upload_base_directory = 'public/upEditor/';
 
           ///** change name file upload */        
 
         // $original_file_name=$k.time();
          $original_file_name = time().rand(000,999).$k;
          $original_file_extension='png';
 
          if (sizeof($arr) ==  2) {
               $original_file_name = $arr[0];
               //แปลงชื่อไฟล์
               //$name_new = md5($original_file_name);
               $original_file_extension = $arr[1];
          }
          else
          {
               //the file name contains extra . in itself
               $original_file_name = implode("_",array_slice($arr,0,sizeof($arr)-1));
               $original_file_extension = $arr[sizeof($arr)-1];
          }
 
          list($type, $data) = explode(';', $data);
          list(, $data)      = explode(',', $data);
 
          $data = base64_decode($data);
 
          $path = $upload_base_directory.$original_file_name.'.'.$original_file_extension;
 
          //uploading the image to an actual file on the server and get the url to it to update the src attribute of images
          Storage::put($path, $data);
 
          $img->removeAttribute('src');       
          //you can remove the data-filename attribute here too if you want.
          $img->setAttribute('src', Storage::url($path));
          // data base stuff here :
          //saving the attachments path in an array
      }
 
      //updating the summernote WYSIWYG markdown output.
      $data = $dom->saveHTML($dom->documentElement);
      //unset($dom);
 
    }

        Category::create([            
              'name' => $request->name,
              'content' => $data,
              'cover' => $filenametostore,
          ]);
 
          return to_route('category.index')->with('success', 'Create Data Update successfully');
     
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       // $navmenu = PostAbout::all();
       // $submenu = SubAbout::all();
        $category = Category::where('id',$id)->get();
       // return view('website.category.index',compact('category','navmenu','submenu'));
        return view('website.category.index',compact('category'));
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       // $category = category::all();

        return view('auth.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {        
        $user = auth()->user();
      
        $category->update([
        'name' => $request->name

    ]);

    if($request->hasFile('file')) {
        //get filename with extension
        $filenamewithextension = $request->file('file')->getClientOriginalName();
 
        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
        //get file extension
        $extension = $request->file('file')->getClientOriginalExtension();
 
        //filename to store
        $filenametostore = $filename.'_'.time().'.'.$extension;
 
        //Upload File
        //$request->file('file')->storeAs('public/images/posts', $filenametostore);
        $request->file('file')->storeAs('public/images/category/thumbnail', $filenametostore);
       
        //Resize image here
        //$thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
        $thumbnailpath = public_path('storage/images/category/thumbnail/'.$filenametostore);
     

          //  Gallery::where('id', $post->gallery->id)->update(['image' => $filenametostore]);

       
        // echo (json_encode([
        //     'default' => asset('storage/uploads/'.$filenametostore),
        //     '400' => asset('storage/uploads/thumbnail/'.$filenametostore),
        // ]);)
 
       // return redirect('auth.editor')->with('success', "Image uploaded successfully.");
       Category::where('id', $category->id)->update(['cover' => $filenametostore]);
    }  

     
    if($request->content==''){
        $data = 'รายละเอียดข้อมูลเนื้อหา';
    }
    else
    {

    $data = $request->content;

    //loading the html data from the summernote editor and select the img tags from it
    $dom = new \DOMDocument();            
       
    $dom->loadHtml(mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8')); 
  // $dom->encoding = 'utf-8';
    $images = $dom->getElementsByTagName('img');

 
  foreach($images as $k => $img){
      //for now src attribute contains image encrypted data in a nonsence string
      $data = $img->getAttribute('src');
     
      //getting the original file name that is in data-filename attribute of img
      $file_name = $img->getAttribute('data-filename');

      //extracting the original file name and extension
      
      $arr = explode('.', $file_name);
      $upload_base_directory = 'public/upEditor/';

       ///** change name file upload */        

     // $original_file_name=$k.time();
      $original_file_name = time().rand(000,999).$k;
      $original_file_extension='png';

      if (sizeof($arr) ==  2) {
           $original_file_name = $arr[0];
           //แปลงชื่อไฟล์
           //$name_new = md5($original_file_name);
           $original_file_extension = $arr[1];
      }
      else
      {
           //the file name contains extra . in itself
           $original_file_name = implode("_",array_slice($arr,0,sizeof($arr)-1));
           $original_file_extension = $arr[sizeof($arr)-1];
      }

      list($type, $data) = explode(';', $data);
      list(, $data)      = explode(',', $data);

      $data = base64_decode($data);

      $path = $upload_base_directory.$original_file_name.'.'.$original_file_extension;

      //uploading the image to an actual file on the server and get the url to it to update the src attribute of images
      Storage::put($path, $data);

      $img->removeAttribute('src');       
      //you can remove the data-filename attribute here too if you want.
      $img->setAttribute('src', Storage::url($path));
      // data base stuff here :
      //saving the attachments path in an array
  }

  //updating the summernote WYSIWYG markdown output.
  $data = $dom->saveHTML($dom->documentElement);
  //unset($dom);

}
//dd($filenametostore);
$category->update([
    'name' => $request->name,
    'content' => $data,
]);
        // dd($request->all());
        return to_route('category.index')->with('warning', 'Edit Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //dd($category);
         $category->delete();

        return to_route('category.index')->with('danger', 'category Data Delete successfully');
    }
}