<?php namespace Pensoft\Partners\Models;

use Database\Tester\Models\Country;
use Pensoft\Cardprofiles\Models\Profiles;
use RainLab\Location\Models\Country as CountryModel;
use Model;
use BackendAuth;

/**
 * Model
 */
class Partners extends Model
{
    use \October\Rain\Database\Traits\Validation;
	use \October\Rain\Database\Traits\NestedTree;
	// For Revisionable namespace
	use \October\Rain\Database\Traits\Revisionable;

	public $timestamps = false;

	// Add  for revisions limit
	public $revisionableLimit = 200;

	// Add for revisions on particular field
	protected $revisionable = ["id","content", "country_id", "country_code", "title", "city_id", "email", "institution"];

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

	public $hasMany = [
		'cardprofiles' => [ Profiles::class, 'key' => 'partner_id' ],
	];

    // Add  below relationship with Revision model
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
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
    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }
    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }
}
