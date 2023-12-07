<?php include 'app/adms/Views/_includes/head.php';?>
<?php include 'app/adms/Views/_includes/navbar.php';?>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
	    <div class="col-lg-12">
	        <div class="ibox float-e-margins">
	        	<?php if(!$error): ?>
		            <div class="ibox-title">
		                <h5>Lista de Contatos</h5>
		                <div class="ibox-tools">
							<a href="<?= $this->deleteAllContacts?>" class="btn btn-danger btn-m" onclick="return confirm('Deseja excluir todos os registros?')"><i class="fa fa-trash-o"></i> Excluir todos os registros</a>
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
				                        <th>Data de Contato</th>
				                        <th>Nome</th>
				                        <th>Email</th>
		                            	<th class="list-head-content" style="width: 200px;">Ações</th>
				                    </tr>
			                    </thead>
			                    <tbody>
	    							<?php foreach ($data as $contact): ?>
					                    <tr class="gradeX">
					                        <td><?= implode("/",array_reverse(explode("-",$contact['date_contact']))) ?></td>
					                        <td><?= $contact['name'] ?></td>
					                        <td><?= $contact['email'] ?></td>
					                        <td>
				                        		<input type="hidden" name="contact_id" value="<?= $contact['id_contact'] ?>">
				                        		<button type="button" class="btn btn-success btn_modal" data-toggle="modal" data-target="#myModal5"><i class="fa fa-envelope"></i></button>
												<a href="<?=$this->pageDelete .'/'. $contact['id_contact'] ?>" class="btn btn-danger btn-m delete" onclick="return confirm('Deseja excluir esse registro?')" title="Excluir"><i class="fa fa-trash-o"></i></a>
					                        </td>
					                    </tr>
									<?php endforeach?>
			                    </tbody>
			                </table>
			            </div>
			        </div>
			    <?php else: ?>
			    	<div class="ibox-title">
		                <h5>Nenhum contato encontrada</h5>
		            </div>
		            <div class="ibox-content">
                <div class="row">
                	<a href="<?=$this->pageReturn ?>" class="btn btn-success btn-m"><i class="fa fa-refresh"></i>  Atualizar</a>
                </div>
            </div>
			    <?php endIf?>
	    	</div>
	    	<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Dados do Contato</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong>Data de Contato: </strong></p> <p class="date_contact"></p><br>
                            <p><strong>Nome: </strong></p> <p class="name_contact"></p><br>
                            <p><strong>Email: </strong></p> <p class="email_contact"></p><br>
                            <p><strong>Mensagem: </strong></p> <p class="msg_contact"></p><br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	</div>
        </div>
    </div>

        <script src="<?= URLADM ?>app/adms/assets/js/pages/marcas/marcas-action.js"></script>

    </body>
</html>
