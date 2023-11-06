<?php

namespace Core\helper;

class ConfigMenu
{

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function configMenu()
	{
		$this->model->query['select']->exeSelect("pr_categories", '', 'ORDER BY orderby', '');

    	return $this->model->query['select']->getResult();
	}

}