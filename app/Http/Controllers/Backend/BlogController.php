<?php

namespace App\Http\Controllers\Backend;


use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;


class BlogController extends BackendController
{

    protected $uploadPath;

    public function __construct(){
        parent::__construct();
        $this->uploadPath = public_path('img');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = false;
        if (($status = $request->get('status')) && $status == 'trash') {
            $posts = Post::onlyTrashed()->paginate(5);
            $onlyTrashed = true;
        }
        elseif($status == 'published'){
            $posts = Post::published()->paginate(5);
        }
        elseif($status == 'scheduled'){
            $posts = Post::scheduled()->paginate(5);
        }
        elseif($status == 'draft'){
            $posts = Post::draft()->paginate(5);
        }
        elseif($status == 'own'){
            $posts = $request->user()->posts()->paginate(5);
        }
        else{
            $posts = Post::latest()->paginate(5);
        }

        $statusList = $this->statusList();
        return view('backend.blog.index',compact('posts','onlyTrashed','statusList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {

        return view('backend.blog.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $data = $this->handleRequest($request);

        $newPost = $request->user()->posts()->create($data);

        $newPost->createTags($data["post_tags"]);

        return redirect(route('blog.index'))->with('message','Post Created SuccessFully');

    }

    private function handleRequest($request)
    {
      $data = $request->all();
      if($request->hasFile('image')){
         $image = $request->file('image');
         $fileName = $image->getClientOriginalName();
         $destination = $this->uploadPath;

         $image->move($destination,$fileName);
         $data['image'] = $fileName;
      }

      return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.blog.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $oldImage = $post->image;
        $data = $this->handleRequest($request);
        $post->update($data);
        $post->createTags($data['post_tags']);
        if($oldImage !== $post->image){
            $this->removeImage($oldImage);
        }
        return redirect(route('blog.index'))->with('message','Post Updated SuccessFully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();

        return redirect(route('blog.index'))->with('trash-message',['Your Post Moved To Trash',$id]);
    }

    public function restore($id){
        $post = Post::withTrashed()->findorFail($id);
        $post->restore();
        return redirect(route('blog.index'))->with('message','Post Restored SuccessFully');

    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image);

        return redirect('/backend/blog?status=trash')->with('message','Permanently Deleted');
    }

    private function removeImage($image){
        if(!empty($image)){
            $imagePath = $this->uploadPath . '/' . $image;
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }
    }

    private function statusList(){
        return [
            'own' => auth()->user()->posts()->count(),
           'all' => Post::count(),
           'published' => Post::published()->count(),
           'scheduled' => Post::scheduled()->count(),
           'draft' => Post::draft()->count(),
           'trash' => Post::onlyTrashed()->count(),
        ];
    }
}
