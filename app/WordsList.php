<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WordsList extends Model
{
    protected $table = 'words_lists';

    protected $fillable = [ 'name','type','subcategory_id','user_id' ];

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the words record associated with the wordsList.
     */
    public function words()
    {
        return $this->hasMany('App\Word');
    }

    /**
     * Association with results table
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
