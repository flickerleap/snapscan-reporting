<?php

namespace App\Repositories;

use App\Models\Code;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CodeRepository
 * @package App\Repositories
 * @version August 14, 2017, 10:00 pm UTC
 *
 * @method Code findWithoutFail($id, $columns = ['*'])
 * @method Code find($id, $columns = ['*'])
 * @method Code first($columns = ['*'])
*/
class CodeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'reference',
        'merchant_id',
        'legacy',
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Code::class;
    }
}
