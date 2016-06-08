<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user has many flyers.
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers(){
        return $this->hasMany(Flyer::class);
    }

    /**
     * Publish the flyer.
     * 
     * @param  Flyer  $flyer 
     * @return Flyer
     */
    public function publish(Flyer $flyer) {
        return $this->flyers()->save($flyer);
    }

    /**
     * A user owns a flyer. 
     * 
     * @param  Flyer $relation
     * @return boolean
     */
    public function owns($relation) {
        return $relation->user_id == $this->id;
    }
}
