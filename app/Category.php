<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{

    use Sluggable;

    protected $guarded = [];

    protected $withCount = ['posts'];

    /** Relations */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    /** Relations */

    /** Route Model Key */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /** Route Model Key */
    
    public function isPostAttached(Post $post)
    {
        return $this->posts()->wherePivot('post_id', $post->id)->exists();
    }
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
