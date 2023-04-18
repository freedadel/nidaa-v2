<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = "faculties";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'university_id',
        'percent', 'location',
        'about','category_id','department_id',
        'status','img',
        'user_id',
        'dept1','dept2','dept3','dept4','dept5',
        'dept6','dept7','dept8','dept9','website',
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
    public function department()
    {
        return $this->belongsTo('App\Department');
    }
    public function university()
    {
        return $this->belongsTo('App\University');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function state()
    {
        return $this->belongsTo('App\State','location');
    }

}
