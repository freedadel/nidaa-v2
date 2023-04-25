<?php

namespace App\Repositories;

use App\Models\Call;
use App\Repositories\BaseRepository;

/**
 * Class CallRepository
 * @package App\Repositories
 * @version April 25, 2023, 12:27 am EET
*/

class CallRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Call::class;
    }
}
