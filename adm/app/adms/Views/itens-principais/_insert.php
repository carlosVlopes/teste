<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Item cadastrado com sucesso!</h5>
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
                                    <h5>Cadastrar Banner</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn ?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
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
                                            <form role="form" method="POST" action="" class="form-adm" enctype="multipart/form-data">
                                                <div class="form-group col-lg-12">
                                                    <label>Titulo</label>
                                                    <input type="text" class="form-control" name="title" id="title">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Ordem</label>
                                                    <input type="number" name="orderby" id="orderby" class="form-control">
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Referente a Coleção | Categoria</label>
                                                    <select class="select2_demo_1 form-control" name="link_redirect">
                                                        <?php foreach($collections as $collection): ?>
                                                            <option value="<?=$collection['name']?>"><?= $collection['name'] ?></option>
                                                        <?php endForeach ?>
                                                        <?php foreach($categories as $category): ?>
                                                            <option value="<?=$category['name']?>"><?= $category['name'] ?></option>
                                                        <?php endForeach ?>
                                                    </select>
                                                    <span class="help-block m-b-none">Ao clicar no botão ira redirecionar a coleção escolhida.</span>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: </span>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Cadastrar</strong></button>
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
        <script src="<?= URLADM ?>app/adms/assets/js/pages/main_itens/main_itens.js"></script>
    </body>
</html>
