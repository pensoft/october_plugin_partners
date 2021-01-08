<?php

namespace Pensoft\Partners\Components;

use \Cms\Classes\ComponentBase;
use Pensoft\Partners\Models\Partners as ModelPartners;

class PartnersPage extends ComponentBase
{
	public function onRun()
	{
		$this->addJs('assets/js/def.js');
		$this->page['partners'] = $this->partners();
		$this->page['available_countries'] = $this->availableCountries();
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
			'template1' => 'Template 1 - MAIA',
			'template2' => 'Template 2 - VOODOO',
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

	public function partners()
	{
		if ((int)$this->property('limit') > 0) {
			return ModelPartners::take((int)$this->property('limit'))->get();
		}
		return ModelPartners::get();
	}


	public function onPartners()
	{
		 if (post('code')) {
		 	$this->page['partners'] = ModelPartners::where('country_code', post('code'))->get();
		 } else {
		 	$this->page['partners'] = $this->partners();
		 }
		 $this->page['template'] = $this->property('templates');
	}

}
