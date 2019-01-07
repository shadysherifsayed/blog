<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

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

    public function getContentAttribute($content)
    {
        return htmlspecialchars_decode($content);
    }
    /** Accessors */

    /** Route Model Key */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /** Route Model Key */

    
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
