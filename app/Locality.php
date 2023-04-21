<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    protected $table = "localities";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'state_id',
        'status',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
