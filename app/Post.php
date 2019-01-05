<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Post extends Model
{
    use Sluggable;
        
    protected $guarded = [];

    protected $with = ['categories'];

    /** Relations */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    /** Relations */


    /** Accessors */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->toDateString();
    }
    /** Accessors */
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
