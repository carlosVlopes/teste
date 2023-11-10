<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <?php if($success): ?>
                                <div class="ibox-title">
                                    <h5>Produto editado com sucesso!</h5>
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
                                    <h5>Editar Produto</h5>
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
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <form role="form" method="POST" action="" class="form-adm-edit" enctype="multipart/form-data">
                                                <div class="form-group col-lg-10">
                                                    <label>Nome</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?=$data['name']?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Categoria</label>
                                                    <select class="select2_demo_1 form-control" name="id_category">
                                                        <?php foreach($categories as $category): ?>
                                                            <option value="<?=$category['id_category']?>" <?= ($data['name_category'] == $category['name']) ? 'selected="selected"' : ''?> ><?= $category['name'] ?></option>
                                                        <?php endForeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Preço antigo</label>
                                                    <input type="text" name="old_price" id="old_price" class="form-control" value="<?=$data['old_price']?>">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Preço</label>
                                                    <input type="text" name="price" id="price" class="form-control" value="<?=$data['price']?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Ordem</label>
                                                    <input type="number" name="orderby" id="orderby" class="form-control" value="<?=$data['orderby']?>">
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label>Status</label>
                                                    <select class="select2_demo_1 form-control" name="status">
                                                        <option value="Normal" <?= ($data['status'] == "Normal") ? 'selected="selected"' : ''?>>Normal</option>
                                                        <option value="Novo" <?= ($data['status'] == "Novo") ? 'selected="selected"' : ''?>>Novo</option>
                                                        <option value="Promoção" <?= ($data['status'] == "Promoção") ? 'selected="selected"' : ''?>>Promoção</option>
                                                        <option value="Esgotado" <?= ($data['status'] == "Esgotado") ? 'selected="selected"' : ''?>>Esgotado</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Marca</label>
                                                    <select class="select2_demo_1 form-control" name="brand">
                                                        <?php foreach($brands as $brand): ?>
                                                            <option value="<?= $brand['name'] ?>" <?= ($data['brand'] == $brand['name']) ? 'selected="selected"' : ''?>><?= $brand['name'] ?></option>
                                                        <?php endForeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Cores</label>
                                                    <select class="select2_demo_2 form-control" name="colors[]" multiple="multiple">
                                                        <option value="blue" <?= (in_array('blue', $data['colors'])) ? 'selected="selected"' : '' ?>>Azul</option>
                                                        <option value="red" <?= (in_array('red', $data['colors'])) ? 'selected="selected"' : '' ?>>Vermelho</option>
                                                        <option value="yellow" <?= (in_array('yellow', $data['colors'])) ? 'selected="selected"' : '' ?>>Amarelo</option>
                                                        <option value="orange" <?= (in_array('orange', $data['colors'])) ? 'selected="selected"' : '' ?>>Laranja</option>
                                                        <option value="purple" <?= (in_array('purple', $data['colors'])) ? 'selected="selected"' : '' ?>>Roxo</option>
                                                        <option value="white" <?= (in_array('white', $data['colors'])) ? 'selected="selected"' : '' ?>>Branco</option>
                                                        <option value="black" <?= (in_array('black', $data['colors'])) ? 'selected="selected"' : '' ?>>Preto</option>
                                                        <option value="brown" <?= (in_array('brown', $data['colors'])) ? 'selected="selected"' : '' ?>>Marrom</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Genero</label>
                                                    <select class="select2_demo_1 form-control" name="gender">
                                                        <option value="Masculino" <?= ($data['gender'] == "Masculino") ? 'selected="selected"' : ''?>>Masculino</option>
                                                        <option value="Feminino" <?= ($data['gender'] == "Feminino") ? 'selected="selected"' : ''?>>Feminino</option>
                                                        <option value="Unisex" <?= ($data['gender'] == "Unisex") ? 'selected="selected"' : ''?>>Unisex</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <label>Descrição</label>
                                                    <textarea name="description" id="description" class="form-control" rows="5"><?=$data['description']?></textarea>
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <span>Imagem: 300x300</span>
                                                    <input type="file" name="image" class="form-control">
                                                    <span class="help-block m-b-none">Coloque a imagem só se voçe quiser mudar a image</span>
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
    <script src="<?= URLADM ?>app/adms/assets/js/pages/products/products.js"></script>

    </body>
</html>
