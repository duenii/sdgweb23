<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PostAbout;
use App\Models\SubAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if($request != ""){
            $subabouts = SubAbout::where('title', 'like',"%$search%")->paginate(10);
            //$posts = Post::with('gallery', 'category')->paginate(10);
            $postabouts = PostAbout::all();

        }
        else{
            $postabouts = PostAbout::all();
            $subabouts = SubAbout::with('postabouts', 'users')->orderBy('postabouts_id')->paginate(10);
        }
       
        //return $posts; 
       
        return view('auth.subabouts.index', compact('subabouts','search','postabouts'));


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postabouts = PostAbout::all();

        return view('auth.subabouts.create',compact('postabouts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
       // $postabouts = SubAbout::with('postabouts')->get();
       
       $this->validate($request, [
        'title' => 'required',
    ]);

       //dd($postabouts->id);
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
      // dd($data);

      PostAbout::where('id',  $request->postabouts)->update(['status' => 1]);


        SubAbout::create([
            'postabouts_id' => $request->postabouts,
            'title' => $request->title,
            'link' => $request->link,
            'content' => $data,             
            'users_id' => $user->id

        ]);


        return to_route('subabouts.index')->with('success', 'Create Data Update successfully');
    
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //dd($id);
        $cat = Category::all();
        $navmenu = PostAbout::all();
        $submenu = SubAbout::all();
        $subabouts = SubAbout::where('id',$id)->get();
        return view('website.subabouts.index',compact('subabouts','navmenu','submenu','cat'));
       
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubAbout $subabout)
    {
        $postabouts = PostAbout::all();
        return view('auth.subabouts.edit', compact('subabout','postabouts'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubAbout $subabout)
    {
        $user = auth()->user();

        if($request->content)

          $data = $request->content;

        //loading the html data from the summernote editor and select the img tags from it
        $dom = new \DOMDocument();
        //$dom->loadHtml($data, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD); 
        $dom->loadHtml(mb_convert_encoding($data, 'HTML-ENTITIES', 'UTF-8')); 
        //$dom->encoding = 'utf-8';

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
        //unset($dom);

        $subabout->update([
            'postabouts_id' => $request->postabouts,
            'title' => $request->title,
            'link' => $request->link,
            'content' => $data,             
            'users_id' => $user->id

        ]);
        // dd($request->all());
        return to_route('subabouts.index')->with('warning', 'Edit Data Update successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubAbout $subabout)
    {
        $subabout->delete();

        return to_route('subabouts.index')->with('danger', 'SubMenu Data Delete successfully');
    }
}
