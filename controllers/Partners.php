<?php namespace Pensoft\Partners\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Partners extends Controller
{
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ReorderController::class
    ];

    public string $listConfig = 'config_list.yaml';
    public string $formConfig = 'config_form.yaml';
    public string $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Pensoft.Partners', 'partners', 'partners');
    }

    /**
     * New partners start with the first topic selected (it can be cleared).
     */
    public function formCreateModelObject()
    {
        $model = parent::formCreateModelObject();
        if (!$model->topic_id && ($first = \Pensoft\Partners\Models\Topics::firstTopic())) {
            $model->topic_id = $first->id;
        }
        return $model;
    }
}