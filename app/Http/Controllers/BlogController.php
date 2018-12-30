<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
                        ->published()
                        ->filter(request()->only(['term','month','year']))
                        ->paginate(3);
        return view('blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $view_count = $post->view_count + 1;
        $post->update(['view_count' => $view_count]);
        return view('blog.show',compact('post'));
    }


    public function category(Category $category){
        $categoryName = $category->title;

        $posts = $category->posts()
                    ->published()
                    ->paginate(3);
        return view('blog.index',compact('posts','categoryName'));
    }

    public function author(User $author){

        $userName = $author->name;

        $posts = $author->posts()
                    ->published()
                    ->paginate(3);
        return view('blog.index',compact('posts','userName'));
    }

    public function tag(Tag $tag){

        $tagName = $tag->name;

        $posts = $tag->posts()
                    ->published()
                    ->paginate(3);
        return view('blog.index',compact('posts','tagName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
