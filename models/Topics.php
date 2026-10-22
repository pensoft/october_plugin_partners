<?php namespace Pensoft\Partners\Models;

use Model;

/**
 * Partner topic: title + description. Partners belong to one topic
 * (optional, see Partners::$belongsTo['topic']); listed in sort order.
 */
class Topics extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_partners_topics';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required',
    ];

    public $hasMany = [
        'partners' => [Partners::class, 'key' => 'topic_id'],
    ];

    /**
     * The first topic in sort order - the default for new partners.
     */
    public static function firstTopic()
    {
        return static::orderBy('sort_order')->orderBy('id')->first();
    }
}
