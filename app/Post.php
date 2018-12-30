<?php

namespace App;

use App\Category;
use App\Tag;
use App\User;
use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug','image','excerpt','title','category_id','view_count','body','published_at'
    ];

    protected $dates = ['published_at'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


    public function getImageUrlAttribute($value)
    {
    	$imageUrl = "";
    	if(! is_null($this->image)){
    		$imagePath = public_path() . "/img/" . $this->image;
    		if(file_exists($imagePath)){
    			$imageUrl = asset("img/" . $this->image);
    		}

    	}

    	return $imageUrl;
    }

    public function dateFormatted($showTimes=false)
    {

        if ($showTimes) {
            return Carbon::parse($this->created_at)->format('d/m/Y');

        }

    }

    public function publicationLabel()
    {
        if (!$this->published_at) {
            return '<span class="label label-warning">Darft</span>';
        }
        elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="label label-info">Schedule</span>';
        }
        else{
            return '<span class="label label-success">Published</span>';
        }
    }

    public function getDateAttribute($value)
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function scopeDraft($query){
        return $query->whereNull("published_at");
    }

    public function scopeScheduled($query){
        return $query->where("published_at",">",Carbon::now());
    }

    public function scopePublished($query){
        return $query->where("published_at","<=",Carbon::now());
    }

    public function scopePopular($query){
        return $query->where("view_count",">=" ,"5");
    }

    public function getBodyHtmlAttribute(){
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }

    public function getExcerptHtmlAttribute(){
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL;
    }

    public function getTagsHtmlAttribute(){
        $anchors = [];
        foreach ($this->tags as $tag) {
           $anchors[] = '<a href="' . route('tag',$tag->slug) . '">' . $tag->name .'</a>';
        }
        return implode(",", $anchors);
    }

    public function setPublishedAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function scopeFilter($query , $filter){
        //Check If Any Term entered
        if(isset($filter['month']) && $month=$filter['month']){
           $query->whereMonth('published_at',$month);
        }
        if(isset($filter['year']) && $year=$filter['year']){
           $query->whereYear('published_at', $year);
        }
        if(isset($filter['term']) && $term=$filter['term']){
            $query->where(function($q) use($term){
                $q->whereHas('user',function($qr) use($term){
                    $qr->where('name','Like',"%{$term}%");
                });
                $q->orWhereHas('category',function($qr) use($term){
                    $qr->where('title','Like',"%{$term}%");
                });
                $q->orWhere('title','LIKE',"%{$term}%");
                $q->orWhere('body','LIKE',"%{$term}%");
            });
        }
    }

    public static function archives()
    {

        return static::selectRaw('count(id) as post_count, year(published_at) year, month(published_at) month')
            ->published()
            ->groupBy('year', 'month')
            ->orderByRaw('min(published_at) desc')
            ->get();
    }


    public function createTags($tagString)
    {
        $tags = explode(",", $tagString);
        $tagIds = [];

        foreach ($tags as $tag)
        {
            $newTag = new Tag();
            $newTag->name = ucwords(trim($tag));
            $newTag->slug = str_slug($tag);
            $newTag = Tag::firstOrCreate(
                ['slug' => str_slug($tag), 'name' => ucwords(trim($tag))]
            );

            $tagIds[] = $newTag->id;
        }

        $this->tags()->detach();
        $this->tags()->attach($tagIds);
    }


}
