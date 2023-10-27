<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Post\CreateRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Post;
use App\Models\PostAbout;
use App\Models\SubAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($request != "") {
            $category = Category::all();
            $posts = Post::where('title', 'like', "%{$search}%")->orderBy('updated_at', 'DESC')->paginate(10);
            //$posts = Post::with('gallery', 'category')->paginate(10);

        } else {
            $category = Category::all();
            $posts = Post::with('category')->orderBy('updated_at', 'DESC')->paginate(10);
        }
        //return $posts;
        $category = Category::all();
        return view('auth.posts.index', compact('posts', 'search','category'));
      
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('auth.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'min:3', 'max:255', 'string'],
            'category' => ['required'],
            'file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'publish' => ['required'],

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
                $request->file('file')->storeAs('public/images/posts/thumbnail', $filenametostore);
               
                //Resize image here
                //$thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
                // $thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
                // $img = Image::make($thumbnailpath)->resize(250, 250, function($constraint) {
                //     $constraint->aspectRatio();
                // });
                //     $img->save($thumbnailpath);

                


            }

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
         // unset($dom);

           

            Post::create([
                'title' => $request->title,
                'category_id' => $request->category,
                'content' => $data,
                'publish' => $request->publish,
                'gallery_id' => $filenametostore
            ]);

             //dd($content);


        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        // dd(compact('post'));
        $post = Post::where('id', $id)->get();
        $navmenu = PostAbout::all();
       $submenu = SubAbout::all();
      //  $img = Gallery::all();
      //  $cat = Category::all();

        //dd($post);
        //return view('website.posts.index', compact('post', 'navmenu', 'submenu', 'img', 'cat'));
        return view('website.posts.index', compact('post', 'navmenu', 'submenu'));
    }

    public function showall(string $id)
    {
        // dd(compact('post'));
        $posts = Post::where('publish', 1)->orderBy('updated_at', 'DESC')->get();
        $navmenu = PostAbout::all();
       $submenu = SubAbout::all();
     //   $img = Gallery::all();
        $cat = Category::where('id', $id)->get();
        //$cat = Category::all();

        //dd($post);
       // return view('website.postsall.index', compact('posts', 'navmenu', 'submenu', 'img', 'cat'));
        return view('website.postsall.index', compact('posts','cat', 'navmenu', 'submenu'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //dd($post);
       $category = Category::all();

        return view('auth.posts.edit', compact('post', 'category'));

        //return view('auth.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $user = auth()->user();

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
            $request->file('file')->storeAs('public/images/posts/thumbnail', $filenametostore);
           
            //Resize image here
            //$thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
            $thumbnailpath = public_path('storage/images/posts/thumbnail/'.$filenametostore);
         

              //  Gallery::where('id', $post->gallery->id)->update(['image' => $filenametostore]);

           
            // echo (json_encode([
            //     'default' => asset('storage/uploads/'.$filenametostore),
            //     '400' => asset('storage/uploads/thumbnail/'.$filenametostore),
            // ]);)
     
           // return redirect('auth.editor')->with('success', "Image uploaded successfully.");

           Post::where('id', $post->id)->update(['gallery_id' => $filenametostore]);
        }
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
            $original_file_name = time().$k.'png';
            $original_file_extension='png';
 
           if (sizeof($arr) ==  2) {
                 $original_file_name = $arr[0];
                 //แปลงชื่อไฟล์
                 $name_new = md5($original_file_name);
                 $original_file_extension = $arr[1];
           }
            else
            {
                 //the file name contains extra . in itself
                 $original_file_name = implode("_",array_slice($arr,0,sizeof($arr)-1));
                 $original_file_extension = $arr[sizeof($arr)-1];
            }
            //dd(count(explode('.', $data)));
            if(count(explode('.', $data))>1){
                //dd($data);
            }else{
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                //dd($data);
                $path = $upload_base_directory.$name_new.'.'.$original_file_extension;
    
                //uploading the image to an actual file on the server and get the url to it to update the src attribute of images
                Storage::put($path, $data);
    
                $img->removeAttribute('src');       
                //you can remove the data-filename attribute here too if you want.
                $img->setAttribute('src', Storage::url($path));
            }
            // data base stuff here :
            //saving the attachments path in an array
        }
 
        //updating the summernote WYSIWYG markdown output.
        $data = $dom->saveHTML($dom->documentElement);

        $post->update([
            'category_id' => $request->category, 
            'title' => $request->title,
            'link' => $request->link,
            'content' => $data,  
            'publish' => $request->publish,           
            'users_id' => $user->id

        ]);
         


        return to_route('posts.index')->with('success', 'posts Data Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return to_route('posts.index')->with('success', 'posts Data deleted successfully');
    }
}
