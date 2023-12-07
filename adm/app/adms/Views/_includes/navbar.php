<?php

    use Core\helper\ConfigMenus;

    $ob = new ConfigMenus($this->model->query);

    $menus =  $ob->configMenus();

    $submenus =  $ob->configSubmenus($menus);

    $sidebarActive = '';

    if(isset($this->data['sidebarActive'])){
        $sidebarActive = $this->data['sidebarActive'];
    }

?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img src="<?=URLADM?>app/adms/Views/images/users/<?=$_SESSION['user_image']?>" class="img-circle" alt="Celke" class="logo" width="60px">
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$_SESSION['user_name']?></strong>
                             </span> <span class="text-muted text-xs block">Opções <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?= URLADM?>user-profile/index">Perfil</a></li>
                        <li><a href="<?= URLADM?>configuracao">Configuração</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= URLADM?>logout/index">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <?php foreach($menus as $menu): ?>

                <?php if(in_array($menu['id'], $submenus['ids'])): ?>

                    <li class="<?= ($sidebarActive === $menu['link']) ? 'active' : ''?>">
                        <a href="#"><i class="fa <?=$menu['icon']?>"></i> <span class="nav-label"><?=$menu['title']?></span><span class="fa arrow"></span></a>
                    <?php foreach($submenus[$menu['id']] as $submenu): ?>
                        <ul class="nav nav-second-level collapse">
                            <li class="<?= ($sidebarActive === $submenu['link']) ? 'active' : ''?>"><a href="<?= URLADM . $submenu['link']?>"><?=$submenu['title']?></a></li>
                        </ul>
                    <?php endForeach ?>
                    </li>

                <?php else: ?>

                    <li class="<?= ($sidebarActive === $menu['link']) ? 'active' : ''?>">
                        <a href="<?= URLADM . $menu['link']?>/index"><i class="fa <?=$menu['icon']?>"></i> <span class="nav-label"><?=$menu['title']?></span></a>
                    </li>

                <?php endIf ?>

            <?php endForeach ?>
        </ul>

    </div>
</nav>
<div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background: #2f4050;" >
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <a href="<?= URLADM?>logout/index" style="color: white;">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>