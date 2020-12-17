<?php namespace Pensoft\Partners;

use System\Classes\PluginBase;
use Pensoft\Partners\Components\PartnersPage;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = [
        'rainlab.location',
        'rainlab.user',
        'pensoft.partners'
    ];

    public function boot()
    {
        if(class_exists('\RainLab\Location\Controllers\Locations')){
            \RainLab\Location\Controllers\Locations::extendFormFields(function($form, $model){
                if (!$model instanceof \Rainlab\Location\Models\Country) {
                    return;
                }
                $form->addFields([
                    'country_color' => [
                        'label' => 'Country color',
                        'type' => 'colorpicker',
                        'availableColors' => []
                    ]
                ]);
            });
        }
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
            PartnersPage::class => 'PartnersPage',
        ];
    }
}
