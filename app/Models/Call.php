<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Call
 * @package App\Models
 * @version April 25, 2023, 12:27 am EET
 *
 * @property integer $type
 * @property integer $state_id
 * @property integer $locality_id
 * @property integer $htype_id
 * @property string $sec_status
 * @property string $details
 * @property string $area
 * @property string $address
 * @property string $phone
 * @property string $phone2
 * @property string $img
 * @property integer $status
 * @property integer $comment
 * @property integer $updated_by
 * @property integer $assigned_by
 * @property integer $completed_by
 * @property integer $confirmed_by
 * @property integer $user_id
 */
class Call extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'ads';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'type',
        'state_id',
        'locality_id',
        'htype_id',
        'sec_status',
        'details',
        'area',
        'address',
        'phone',
        'phone2',
        'img',
        'status',
        'comment',
        'updated_by',
        'assigned_by',
        'completed_by',
        'confirmed_by',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
        'state_id' => 'integer',
        'locality_id' => 'integer',
        'htype_id' => 'integer',
        'sec_status' => 'string',
        'details' => 'string',
        'area' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'phone2' => 'string',
        'img' => 'string',
        'status' => 'integer',
        'comment' => 'integer',
        'updated_by' => 'integer',
        'assigned_by' => 'integer',
        'completed_by' => 'integer',
        'confirmed_by' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required|integer',
        'state_id' => 'required|integer',
        'locality_id' => 'required|integer',
        'htype_id' => 'required|integer',
        'sec_status' => 'required|string|max:191',
        'details' => 'required|string',
        'area' => 'required|string|max:191',
        'address' => 'required|string|max:191',
        'phone' => 'required|string|max:191',
        'phone2' => 'required|string|max:191',
        'img' => 'required|string|max:191',
        'status' => 'required|integer',
        'comment' => 'required|integer',
        'updated_by' => 'required|integer',
        'assigned_by' => 'required|integer',
        'completed_by' => 'required|integer',
        'confirmed_by' => 'required|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'user_id' => 'nullable'
    ];

    
}
