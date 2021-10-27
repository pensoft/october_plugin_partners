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
        'pensoft.partners',
        'pensoft.cardprofiles'
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
                    'partner_id' => [
                        'label' => 'Organization/Partner',
                        'nameFrom' => 'instituion',
                        'emptyOption' => '-- choose --',
                        'span'  => 'auto',
                        'type'  => 'dropdown',
                        'tab'  => 'rainlab.user::lang.user.account',
						'options' => Models\Partners::all()->lists('instituion', 'id')
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

	/**
	 * Twig extensions
	 */
	public function registerMarkupTags()
	{
		return [
			'filters' => [
				// A global function, i.e str_plural()
				'image_width' => [$this, 'getImageWidth'],
				'image_height' => [$this, 'getImageHeight'],
			],
		];
	}

	private $images = [];

	public function getImageWidth($url) {
		return $this->getImageSize($url) ? $this->getImageSize($url)['width'] : null;
	}

	public function getImageHeight($url) {
		return $this->getImageSize($url) ? $this->getImageSize($url)['height'] : null;
	}

	private function getImageSize($url) {
		if (!isset($this->images[$url])) {
			$data = @getimagesize($url);
			if ($data) {
				$this->images[$url] = [
					'width'     => $data[0],
					'height'    => $data[1],
				];
			}else{
				$this->images[$url] = false;
			}
		}
		return $this->images[$url];
	}
}
