<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Usuário editado com sucesso!</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageReturn?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ibox-title">
                                    <h5>Editar Usuário</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m">Listar</a>
                                        <a href="<?=$this->pageEditPass .'/'. $data['id']?>" class="btn btn-primary btn-m">Editar Senha</a>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);
                                    }
                                ?>
                                <div class="ibox-content">
                                    <span class="col-lg-7" id="msg"></span>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form role="form" method="POST" action="" id="form-add-user" enctype="multipart/form-data" class="form-adm">
                                                <div class="form-group col-lg-5">
                                                    <label>Nome</label>
                                                    <input type="text" placeholder="Nome completo" class="form-control" name="name" id="name" value="<?= $data['name'] ?>">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" placeholder="Melhor e-mail" class="form-control" value="<?= $data['email'] ?>">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>User</label>
                                                    <input type="text" name="user" id="user" class="form-control" value="<?= $data['user'] ?>">
                                                </div>
                                                <div class="form-group col-lg-7">
                                                    <label>Permissões: </label><br>
                                                    <select class="select2 form-control" multiple="multiple" name="permissions[]">
                                                        <option value="u_delete" id="delete" <?= (isset($userPermi["u_delete"])) ? 'selected="selected"' : ''?> >Deletar</option>
                                                        <option value="u_edit" id="edit" <?= (isset($userPermi["u_edit"])) ? 'selected="selected"' : ''?> >Editar</option>
                                                        <option value="u_add" id="add" <?= (isset($userPermi["u_add"])) ? 'selected="selected"' : ''?> >Adicionar</option>
                                                        <option value="u_view" id="view" <?= (isset($userPermi["u_view"])) ? 'selected="selected"' : ''?> >Visualizar</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Menus permitidos:</label><br>
                                                    <select class="select2 form-control" multiple="multiple" name="menus[]">
                                                        <?php foreach($all_menus as $menu): ?>
                                                            <option value="m_<?=$menu['link']?>" id="<?=$menu['link']?>" <?= (isset($menusActive["m_{$menu['link']}"])) ? 'selected="selected"' : ''?> ><?=$menu['title']?></option>
                                                        <?php endForeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: 300x300</span>
                                                    <input type="file" name="image"><br>
                                                    <span>Coloque a imagem só se voçe quiser mudar a image</span><br><br>
                                                </div>

                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="SendEditUser" value="Editar"><strong>Editar</strong></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endIf?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/jquery.validate.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/validate/localization/messages_pt_BR.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/user/editUser.js"></script>

    </body>
</html>
