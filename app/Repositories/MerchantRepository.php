<?php

namespace App\Repositories;

use App\Models\Merchant;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MerchantRepository
 * @package App\Repositories
 * @version August 14, 2017, 9:59 pm UTC
 *
 * @method Merchant findWithoutFail($id, $columns = ['*'])
 * @method Merchant find($id, $columns = ['*'])
 * @method Merchant first($columns = ['*'])
*/
class MerchantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'merchant_code',
        'api_key'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Merchant::class;
    }
}
