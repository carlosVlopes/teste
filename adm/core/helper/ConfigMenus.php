<?php

namespace Core\helper;

class ConfigMenus
{

	public function __construct($querys)
	{

		$this->querys = $querys;

	}

 	public function configMenus()
    {
        $checkPermissions = new ValPermissions();

        $permissions = $checkPermissions->valPermissions($_SESSION['user_id'], true);

        $menusValues = '';

        $menusWhere = '';

        $a = 0;

        foreach($permissions as $key => $permi){

            $a++;

            $permi = explode('m_', $key);

            $menusValues .= "link{$a}={$permi[1]}&";

            $menusWhere .= " link = :link{$a} OR";

        }

        $menusValues = rtrim($menusValues, '&');
        $menusWhere = rtrim($menusWhere, 'OR');

        $this->querys['select']->exeSelect('cn_menus', "", "WHERE {$menusWhere} ORDER BY orderby", $menusValues);

        return $this->querys['select']->getResult();

    }

    public function configSubmenus($menus)
    {

    	$id_menus_with_submenu = [];

    	foreach($menus as $menu){

    		if($menu['link'] == 'menu') array_push($id_menus_with_submenu, $menu['id']);

    	}

    	if(count($id_menus_with_submenu) == 1){

            $this->querys['select']->exeSelect('cn_submenus', "", "WHERE id_menu = :id_menu ORDER BY orderby ASC", "id_menu={$id_menus_with_submenu[0]}");

            $submenus[$id_menus_with_submenu[0]] = $this->querys['select']->getResult();

            return $submenus;

    	}

    }

}