<?php namespace Pensoft\Partners\Models;

use Database\Tester\Models\Country;
use RainLab\Location\Models\Country as CountryModel;
use Model;

/**
 * Model
 */
class Partners extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\NestedTree;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_partners_partners';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	protected $jsonable = [
		'country_code'
	];

    public $attachOne = [
        'cover' => 'System\Models\File'
    ];

	public $belongsTo = [
		'city' => 'RainLab\Location\Models\State'
	];

	public $belongsToMany = [
		'country' => [
			'RainLab\Location\Models\Country',
			'table' => 'pensoft_partners_countries',
			'order' => 'name'
		],
	];

    public function getCountryCodeOptions()
    {
		return CountryModel::whereNotNull('is_enabled')->where('is_enabled', true)->lists('code', 'code');
    }

    public function getCountryOptions()
    {
		return CountryModel::whereNotNull('is_enabled')->where('is_enabled', true)->lists('name', 'id');
    }

	public function getFullNameAttribute()
	{
		return $this->instituion . " - " . $this->type;
	}

}
