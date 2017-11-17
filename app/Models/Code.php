<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Code
 * @package App\Models
 * @version August 14, 2017, 10:00 pm UTC
 *
 * @method static Code find($id=null, $columns = array())
 * @method static Code|\Illuminate\Database\Eloquent\Collection findOrFail($id, $columns = ['*'])
 * @property string reference
 * @property integer merchant_id
 * @property boolean legacy
 * @property string name
 */
class Code extends Model
{
    use SoftDeletes;

    public $table = 'codes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'reference',
        'merchant_id',
        'legacy',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'reference' => 'string',
        'merchant_id' => 'integer',
        'legacy' => 'boolean',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
}
