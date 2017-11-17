<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Merchant
 * @package App\Models
 * @version August 14, 2017, 9:59 pm UTC
 *
 * @method static Merchant find($id=null, $columns = array())
 * @method static Merchant|\Illuminate\Database\Eloquent\Collection findOrFail($id, $columns = ['*'])
 * @property string name
 * @property string merchant_code
 * @property string api_key
 */
class Merchant extends Model
{
    use SoftDeletes;

    public $table = 'merchants';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'merchant_code',
        'api_key'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'merchant_code' => 'string',
        'api_key' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

}
