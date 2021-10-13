<?php

namespace Pensoft\Partners\Components;

use Backend\Facades\BackendAuth;
use \Cms\Classes\ComponentBase;
use Pensoft\Partners\Models\Partners as ModelPartners;

class PartnersPage extends ComponentBase
{

	public $loggedIn;

	public function onRun()
	{
		$this->addJs('assets/js/def.js');
		$this->page['partners'] = $this->partners();
		$this->page['available_countries'] = $this->availableCountries();
		$this->page['enabled_countries'] = $this->enabledCountries();

		// by default users are not logged in
		$this->loggedIn = false;
		// end then if getUser returns other value than NULL then our user is logged in
		if (!empty(BackendAuth::getUser())) {
			$this->loggedIn = true;
		}
	}

	public function defineProperties()
	{
		return [
			'limit' => [
				'title' => 'Limit items',
				'description' => 'Limit items',
				'default' => 0,
			],
			'templates' => [
				'title' => 'Select templates',
				'type' => 'dropdown',
				'default' => 'template1'
			],
		];
	}

	public function getTemplatesOptions()
	{
		return [
			'template1' => 'Template 1',
			'template2' => 'Template 2',
			'template3' => 'Template 3',
			'template4' => 'Template 4',
			'template5' => 'Template 5',
			'template6' => 'Template 6',
		];
	}

	public function componentDetails()
	{
		return [
			'name' => 'PartnersPage',
			'description' => 'Displays a collection of partners.'
		];
	}

	public function availableCountries()
	{
		if(class_exists('\RainLab\Location\Models\Country')){
			return \RainLab\Location\Models\Country::where('is_enabled', true)->whereNotNull('country_color')->get()->pluck('country_color', 'code');
		}
		return [];
	}

	public function enabledCountries()
	{
		if(class_exists('\RainLab\Location\Models\Country')){
			return \RainLab\Location\Models\Country::where('is_enabled', true)->get()->pluck('name', 'code');
		}
		return [];
	}

	public function partners()
	{
		if ((int)$this->property('limit') > 0) {
			return ModelPartners::where('type', 1)->take((int)$this->property('limit'))->get();
		}
		return ModelPartners::where('type', 1)->get();
	}


	public function onPartners()
	{
		if (post('code')) {
			$this->page['partners'] = ModelPartners::whereRaw('country_code ILIKE \'%'.post('code').'%\'')->where('type', 1)->get();
		} else {
			$this->page['partners'] = $this->partners();
		}
		switch ($this->property('templates')){
			case 'template1':
			default:
				$this->page['show_covers_on_top'] = false;
				$this->page['is_hidden_cover'] = false;
				break;
			case 'template2':
				$this->page['show_covers_on_top'] = true;
				$this->page['is_hidden_cover'] = true;
				break;
			case 'template3':
				$this->page['show_covers_on_top'] = false;
				$this->page['is_hidden_cover'] = true;
				break;
		}
	}

	public function onSinglePartner()
	{
		if (post('partner_id')) {
			$this->page['partners'] = ModelPartners::where('id', post('partner_id'))->where('type', 1)->get();
		} else {
			$this->page['partners'] = $this->partners();
		}
		switch ($this->property('templates')){
			case 'template1':
			default:
				$this->page['show_covers_on_top'] = false;
				$this->page['is_hidden_cover'] = false;
				break;
			case 'template2':
				$this->page['show_covers_on_top'] = true;
				$this->page['is_hidden_cover'] = true;
				break;
			case 'template3':
				$this->page['show_covers_on_top'] = false;
				$this->page['is_hidden_cover'] = true;
				break;
		}
	}

}
