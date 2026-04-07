<?php

namespace Pensoft\Partners\Components;

use \Cms\Classes\ComponentBase;
use Pensoft\Partners\Models\Partners;

class PartnerList extends ComponentBase
{
	public function componentDetails()
	{
		return [
			'name' => 'Partner List',
			'description' => 'Displays a collection of partners.'
		];
	}

	public function defineProperties()
	{
		return [
			'maxItems' => [
				'title' => 'Max items',
				'description' => 'Max items allowed',
				'default' => 10,
			]
		];
	}

	public function getPartners()
	{
		if($this->property('maxItems') > 0){
			return Partners::take($this->property('maxItems'))->where('type', 1)->get();
		}
		return Partners::where('type', 1)->get();
	}

	public function onFilterSVGMap()
	{
		if(post('country')){
			$this->page['partners'] = Partners::where('country_id', post('country'))->where('type', 1)->get();
		}else{
			$this->page['partners'] = $this->getPartners();
		}

		return [
			'#partnersListDiv' => $this->renderPartial('partnerslist')
		];
	}
}
