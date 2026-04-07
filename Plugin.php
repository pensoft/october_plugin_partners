<?php namespace Pensoft\Partners;

use RainLab\User\Models\User;
use System\Classes\PluginBase;
use Schema;
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

    public function boot(): void
    {

        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'partner_id')) {
            Schema::table('users', function ($table) {
                $table->integer('partner_id')->nullable();
            });
        }

        if (Schema::hasTable('users') && !Schema::hasColumn('users', 'is_visible')) {
            Schema::table('users', function ($table) {
                $table->boolean('is_visible')->default(false);
                $table->text('insider_description')->nullable();
                $table->text('position')->nullable();
            });
        }

        if (Schema::hasTable('rainlab_location_countries') && !Schema::hasColumn('rainlab_location_countries', 'country_color')){
            Schema::table('rainlab_location_countries', function ($table) {
                $table->string('country_color')->nullable();
            });
        }

        if(class_exists(\RainLab\Location\Controllers\Locations::class)){
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
        if (class_exists(\Rainlab\User\Controllers\Users::class) && class_exists(\Pensoft\Partners\Models\Partners::class)) {
            \Rainlab\User\Controllers\Users::extendFormFields(function ($form) {
                $form->addTabFields([
                    'partner_id' => [
                        'label' => 'Organization/Partner',
                        'nameFrom' => 'instituion',
                        'span'  => 'auto',
                        'type'  => 'dropdown',
                        'tab'  => 'rainlab.user::lang.user.account',
						'options' => Models\Partners::all()->lists('instituion', 'id')
                    ],
                    'is_visible' => [
                        'label' => 'Visible in insider members list',
                        'span'  => 'left',
                        'type'  => 'checkbox',
                        'tab'  => 'rainlab.user::lang.user.account',
                    ],
                    'insider_description' => [
                        'label' => 'Insider member description',
                        'span'  => 'left',
                        'type'  => 'richeditor',
                        'size'  => 'large',
                        'tab'  => 'rainlab.user::lang.user.account',
                    ],
                    'position' => [
                        'label' => 'Insider member position',
                        'span'  => 'right',
                        'type'  => 'text',
                        'tab'  => 'rainlab.user::lang.user.account',
                    ]
                ]);
            });
        }

        if (class_exists(\RainLab\User\Models\User::class)) {
            User::extend(function ($model) {
                $model->addDynamicMethod('getPartnerIdOptions', function() {
                    $partners = Models\Partners::all()->lists('instituion', 'id');
                    $partners = [' -- choose --', ...$partners];
                    return $partners;
                });

                $model->addDynamicMethod('getAuthPasswordName', function () {
                    return 'password';
                });
            });
        }
    }
    public function registerComponents(): array
    {
        return [];
    }

	/**
	 * Twig extensions
	 */
	public function registerMarkupTags(): array
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

    public function registerPermissions(): array
    {
        return [
            'pensoft.partners.permission' => [
                'tab' => 'Partners',
                'label' => 'Permission to edit partners'
            ],
        ];
    }

    public function registerNavigation(): array
    {
        return [
            'partners' => [
                'label'       => 'Partners',
                'url'         => \Backend::url('pensoft/partners/partners'),
                'icon'        => 'icon-hand-o-up',
                'permissions' => ['pensoft.partners.*'],
                'sideMenu' => [
                    'partners' => [
                        'label' => 'Partners',
                        'icon'  => 'icon-hand-o-up',
                        'url'   => \Backend::url('pensoft/partners/partners'),
                        'permissions' => ['pensoft.partners.*'],
                    ],
                    'partner-types' => [
                        'label' => 'Types',
                        'icon'  => 'icon-tags',
                        'url'   => \Backend::url('pensoft/partners/partnertypes'),
                        'permissions' => ['pensoft.partners.*'],
                    ],
                ],
            ],
        ];
    }
}