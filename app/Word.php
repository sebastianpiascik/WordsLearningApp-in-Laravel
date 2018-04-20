<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';


    /**
     * Get the WordsList that has word.
     */
    public function words_list()
    {
        return $this->belongsTo('App\WordsList');
    }

    protected $fillable = [ 'word','words_list_id' ];
}
