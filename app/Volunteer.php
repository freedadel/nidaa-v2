<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $table = "volunteers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'place',
        'country',
        'state_id',
        'locality_id',
        'htype_id',
        'area',
        'address',
        'phone',
        'phone2',
        'status',
        'user_id',
        'confirmed_by',
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
