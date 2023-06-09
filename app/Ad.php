<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = "ads";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'details',
        'area',
        'address',
        'phone',
        'img',
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
    public function state()
    {
        return $this->belongsTo('App\State');
    }
    public function locality()
    {
        return $this->belongsTo('App\Locality');
    }
    public function htype()
    {
        return $this->belongsTo('App\Htype');
    }
}
