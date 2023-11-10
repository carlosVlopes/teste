<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
	    <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	        	<?php if(!$error): ?>
		            <div class="ibox-title">
		                <h5>Lista de Marcas</h5>
		                <div class="ibox-tools">
							<a href="<?=$this->pageAdd?>" class="btn btn-primary btn-m">Cadastrar</a>
		                </div>
		            </div>
		            <div class="ibox-content notification" style="display: none;">
                        <div class="alert alert-success" id="msg">
                        </div>
                    </div>
		            <div class="ibox-content">
		            	<div class="table-responsive">
			                <table class="footable table table-bordered table-hover dataTables-example">
			                    <thead>
				                    <tr>
				                        <th>Nome</th>
				                        <th style="width: 200px;">Ordem</th>
		                            	<th class="list-head-content" style="width: 200px;">Ações</th>
				                    </tr>
			                    </thead>
			                    <tbody>
	    							<?php foreach ($data as $brand): ?>
					                    <tr class="gradeX">
					                        <td class="name-brand">
					                        	<span><?=$brand['name']?></span>
					                        	<input type="text" value="<?=$brand['name']?>" name="name-brand" style="display:none;" class="form-control">
					                        </td>
					                        <td class="orderby">
                                            <span><?=$brand['orderby']?></span>
                                            <input type="number" min="1" value="<?=$brand['orderby']?>" name="orderby-brand" style="display:none;" class="form-control">
					                        </td>
					                        <td>
					                        	<form action="marcas/edit" method="POST" name="form_edit_<?= $key?>">
					                        		<input type="hidden" name="brand_id" value="<?= $brand['id_brand'] ?>">
													<a href="javascript:;" class="edit-brand btn btn-warning btn-m" title="Editar"><i class="fa fa-pencil"></i></a>
													<a href="javascript:;" class="btn btn-primary btn-m save-brand" title="Salvar" style="display:none">
                                                    <i class="fa fa-floppy-o"></i>
                                                </a>
													<a href="javascript:;" class="btn btn-danger btn-m delete" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
					                        	</form>
					                        </td>
					                    </tr>
									<?php endforeach?>
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    <?php else: ?>
			    	<div class="ibox-title">
		                <h5>Nenhuma marca encontrada</h5>
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

        <script src="<?= URLADM ?>app/adms/assets/js/pages/marcas/marcas-action.js"></script>

    </body>
</html>
