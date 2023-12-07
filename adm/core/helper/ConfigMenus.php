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

        return $this->querys['fullRead']->query("SELECT * FROM cn_menus WHERE {$menusWhere} ORDER BY orderby", [], $menusValues, ['s']);

    }

    public function configSubmenus($menus)
    {

        $id_menus_with_submenu = $this->querys['fullRead']->query("SELECT m.id
                                                FROM cn_submenus
                                                as s
                                                INNER JOIN cn_menus
                                                as m
                                                ON m.id = s.id_menu
                                                GROUP BY m.link", [], '', ['s']);

        $submenus = [];

        $a = [];

        foreach($id_menus_with_submenu as $id_menu){

            $submenus[$id_menu['id']] = $this->querys['fullRead']->query("SELECT * FROM cn_submenus WHERE id_menu = :id_menu ORDER BY orderby ASC", [], "id_menu={$id_menu['id']}", ['s']);

            array_push($a, $id_menu['id']);

        }

        $submenus['ids'] = $a;

        return $submenus;

    }

}