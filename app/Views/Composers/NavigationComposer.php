<?php
namespace App\Views\Composers;


use App\Category;
use App\Post;
use App\Tag;
use Illuminate\View\View;

class NavigationComposer{

	public function compose(View $view)
	{
		$this->composeCategories($view);
		$this->composePopularPosts($view);
		$this->composeTags($view);
		$this->composeArchives($view);
	}

	private function composeCategories(View $view){

        $categories = Category::with(['posts' => function($query){
                     $query->published();
                }])->get();
        $view->with('categories',$categories);
	}

	private function composePopularPosts(View $view){
		$popPosts = Post::published()->popular()->take(3)->get();
        $view->with('popPosts',$popPosts);
	}

	private function composeTags(View $view){
		$tags = Tag::has('posts')->get();
		$view->with('tags',$tags);
	}

	private function composeArchives(View $view){
		$archives = Post::archives();

        $view->with('archives', $archives);
	}

}



