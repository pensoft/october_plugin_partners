<?php namespace Pensoft\Partners\Models;

use Model;

class PartnerType extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    public $timestamps = false;

    public $table = 'pensoft_partners_types';

    public $rules = [
        'name' => 'required',
    ];

    public $hasMany = [
        'partners' => [Partners::class, 'key' => 'type'],
    ];
}
