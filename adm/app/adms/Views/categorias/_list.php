<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
			<div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
				    <div class="col-lg-12">
				        <div class="ibox float-e-margins">
				        	<?php if(!$error): ?>
					            <div class="ibox-title">
					                <h5>Lista de Categorias</h5>
					                <?php if(isset($this->sessionPermi['u_add'])): ?>
						                <div class="ibox-tools">
											<a href="<?=$this->pageAdd?>" class="btn btn-primary btn-m">Cadastrar</a>
						                </div>
						            <?php endIf ?>
					            </div>
					            <?php
	                                if(isset($_SESSION['msg'])){
	                                    echo $_SESSION['msg'];
	                                    unset($_SESSION['msg']);
	                                }
	                            ?>
	                        	<span class="col-lg-12 bg-success" id="msg"></span>
					            <div class="ibox-content">
					            	<div class="table-responsive">
						                <table class="footable table table-bordered table-hover dataTables-example">
						                    <thead>
							                    <tr>
							                        <th>Nome</th>
							                        <th style="width: 200px;">Ordem</th>
													<?php if(isset($this->sessionPermi['u_delete']) === false && isset($this->sessionPermi['u_edit']) === false && isset($this->sessionPermi['u_add']) === false && isset($this->sessionPermi['u_view']) === false) :?>
						                            	<th class="list-head-content" style="width: 200px;">Sem permiçoes</th>
						                            <?php else: ?>
						                            	<th class="list-head-content" style="width: 200px;">Ações</th>
						                            <?php endif?>
							                    </tr>
						                    </thead>
						                    <tbody>
				    							<?php foreach ($data as $category): ?>
								                    <tr class="gradeX">
								                        <td class="name-category">
								                        	<span><?=$category['name']?></span>
								                        	<input type="text" value="<?=$category['name']?>" name="name-category" style="display:none;" class="form-control">
								                        </td>
								                        <td class="orderby">
		                                                    <span><?=$category['orderby']?></span>
		                                                    <input type="number" min="1" value="<?=$category['orderby']?>" name="orderby-category" style="display:none;" class="form-control">
								                        </td>
								                        <td>
								                        	<form action="products-galeria/edit" method="POST" name="form_edit_<?= $key?>">
								                        		<input type="hidden" name="category_id" value="<?= $category['id_category'] ?>">
																<a href="javascript:;" class="edit-category btn btn-warning btn-m" title="Editar"><i class="fa fa-pencil"></i></a>
																<a href="javascript:;" class="btn btn-primary btn-m save-category" title="Salvar" style="display:none">
		                                                            <i class="fa fa-floppy-o"></i>
		                                                        </a>
																<a href="javascript:;" class="btn btn-danger btn-m delete" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
								                        	</form>
								                        </td>
								                    </tr>
												<?php endforeach?>
						                    </tbody>
						                    <tfoot>
					                            <tr>
					                                <td colspan="5">
					                                    <ul class="pagination pull-right"></ul>
					                                </td>
					                            </tr>
				                            </tfoot>
						                </table>
						            </div>
						        </div>
						    <?php else: ?>
						    	<div class="ibox-title">
					                <h5>Nenhuma categoria encontrada</h5>
					            </div>
					            <div class="ibox-content">
	                                <div class="row">
	                                	<a href="<?= $this->pageAdd ?>" class="btn btn-primary btn-m"><i class="fa fa-plus"></i> Cadastrar</a>
	                                	<a href="<?=$this->pageReturn ?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
	                                </div>
	                            </div>
						    <?php endIf?>
				    	</div>
					</div>
				</div>
			</div>
        </div>
    </div>
>
        <script src="<?= URLADM ?>app/adms/assets/js/pages/categorias/categorias-action.js"></script>

    </body>
</html>
