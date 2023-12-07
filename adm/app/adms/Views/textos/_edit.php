<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Quem Somos editado com sucesso!</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i>  Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="ibox-title">
                                    <h5>Editar textos da pagina Quem Somos</h5>
                                    <div class="ibox-tools">
                                        <a href="<?=$this->pageReturn?>" class="btn btn-primary btn-m"><i class="fa fa-arrow-left"></i> Voltar</a>
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
                                    <form role="form" method="POST" action="" class="form-adm-edit" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group col-lg-4">
                                                    <label>Primeiro Titulo</label>
                                                    <input type="text" class="form-control" name="title_1" id="title_1" value="<?=$data['title_1']?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Segundo Titulo</label>
                                                    <input type="text" name="title_2" id="title_2" class="form-control" value="<?=$data['title_2']?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Terceiro Titulo</label>
                                                    <input type="text" name="title_3" id="title_3" class="form-control" value="<?=$data['title_3']?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Primeira Descrição</label>
                                                    <textarea class="form-control" rows="5" name="description_1" id="description_1"><?=$data['description_1']?></textarea>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Segunda Descrição</label>
                                                    <textarea class="form-control" rows="5" name="description_2" id="description_2"><?=$data['description_2']?></textarea>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Terceira Descrição</label>
                                                    <textarea class="form-control" rows="5" name="description_3" id="description_3"><?=$data['description_3']?></textarea>
                                                </div>

                                                <div class="form-group col-lg-12">
                                                    <label>Frase</label>
                                                    <textarea class="form-control" rows="5" name="phrase" id="phrase"><?=$data['phrase']?></textarea>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label>Primeiro Valor</label>
                                                    <input type="text" class="form-control" name="amount_1" id="amount_1" value="<?=$data['amount_1']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Segundo Valor</label>
                                                    <input type="text" name="amount_2" id="amount_2" class="form-control" value="<?=$data['amount_2']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Terceiro Valor</label>
                                                    <input type="text" name="amount_3" id="amount_3" class="form-control" value="<?=$data['amount_3']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Quarto Valor</label>
                                                    <input type="text" name="amount_4" id="amount_4" class="form-control" value="<?=$data['amount_4']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Titulo</label>
                                                    <input type="text" name="title_amount_1" id="title_amount_1" class="form-control" value="<?=$data['title_amount_1']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Titulo</label>
                                                    <input type="text" name="title_amount_2" id="title_amount_2" class="form-control" value="<?=$data['title_amount_2']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Titulo</label>
                                                    <input type="text" name="title_amount_3" id="title_amount_3" class="form-control" value="<?=$data['title_amount_3']?>">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label>Titulo</label>
                                                    <input type="text" name="title_amount_4" id="title_amount_4" class="form-control" value="<?=$data['title_amount_4']?>">
                                                </div>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Salvar</strong></button>
                                            </div>
                                        </div>
                                    </form>
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

    <script src="<?= URLADM ?>app/adms/assets/js/pages/empresas-parceiras/empresas-parceiras.js"></script>

    </body>
</html>
