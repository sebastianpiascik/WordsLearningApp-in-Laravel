<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';

    protected $fillable = [ 'name','category_id' ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the words record associated with the subcategory.
     */
    public function words_lists()
    {
        return $this->hasMany('App\WordsList');
    }

    /**
     * Association with permission table
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
