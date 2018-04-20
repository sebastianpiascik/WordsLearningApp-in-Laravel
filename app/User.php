<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Association with permission table
     */
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    /**
     * Get the words_list connected with user. Used for creating own words_lists by users.
     */
    public function words_listss()
    {
        return $this->hasMany('App\WordsList');
    }

    /**
     * Association with results table. To get results
     */
    public function words_lists()
    {
        return $this->belongsToMany(WordsList::class);
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }


    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}
