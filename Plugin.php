<?php namespace Pensoft\Partners;

use System\Classes\PluginBase;
use Pensoft\Partners\Components\PartnerList;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = [
        'rainlab.location',
        'pensoft.partners'
    ];

    public function boot()
    {
        if (class_exists('\Rainlab\User\Controllers\Users') && class_exists('\Pensoft\Partners\Models\Partners')) {
            \Rainlab\User\Controllers\Users::extendFormFields(function ($form) {
                $form->addTabFields([
                    'partner' => [
                        'label' => 'Organization/Partner',
                        'nameFrom' => 'title',
                        'emptyOption' => '-- choose --',
                        'span'  => 'auto',
                        'type'  => 'dropdown',
                        'tab'  => 'rainlab.user::lang.user.account',
                        'options' => Models\Partners::lists('title', 'id')
                    ]
                ]);
            });
        }
    }
    public function registerComponents()
    {
        return [
            PartnerList::class => 'partners',
        ];
    }
}
