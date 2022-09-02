<!DOCTYPE html>
<html lang="pt-br">
<!-- Head - BEGIN -->
<head>
	<!-- load header -->
   <?php $this->load->view("global/header") ?>

	<!-- load javasript -->
   <script src= <?= base_url() . "assets/js/usuario.js"?>></script>
</head>
<!-- Head - End  -->

<!-- Body - Begin  -->
<body>
   <section>
      <div class="container">
         <div class="row">
            <div class="col-md-12 my-4">
               <h1 class="text-center">Trabalho Banco de Dados</h1>
            </div>

            <div class="col-md-12">
               <div class="card">
                  <!-- CARD HEADER -->
                  <div class="card-header">
                     <h4 class="display-4 d-flex justify-content-between">
                        Usuarios cadastrados
                        <!-- BOTÃO PARA O MODAL -->
                        <a href="#" class="btn btn-sn btn-primary py-3" onclick="openUserModal()">Adicionar usuário</a>
                     </h4>
                  </div>
                  
                  <!-- CARD BODY -->
                  <div class="card-body">
                     <!-- Students table  -->
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center">Nome</th>
                              <th class="text-center">Email</th>
                              <th class="text-center">Logradouro</th>
										<th class="text-center">Número</th>
										<th class="text-center">Estado</th>
										<th class="text-center">Cidade</th>
                              <th class="text-center">Ações</th>
                           </tr>
                        </thead>

                        <tbody>
									<?php foreach ($usuarios as $usuario) { ?>
										<tr>
											<td class="text-center"> <?=$usuario['nome'] ?> </td>
											<td class="text-center"> <?= $usuario['email'] ?> </td>
											<td class="text-center"> <?=$usuario['logradouro'] ?> </td>
											<td class="text-center"> <?=$usuario['numero'] ?> </td>
											<td class="text-center"> <?=$usuario['estado'] ?> </td>
											<td class="text-center"> <?=$usuario['cidade'] ?> </td>
											<!-- actions  -->
											<td class="text-center" style="width: 8vw;">
												<span class="btn btn-sm btn-secondary my-2" 
													onclick="editUser(
														'<?= $usuario['id_usuario'] ?>', 
														'<?= $usuario['nome'] ?>', 
														'<?= $usuario['email'] ?>', 
														'<?= $usuario['senha'] ?>', 
														'<?= $usuario['logradouro'] ?>',
														'<?= $usuario['numero'] ?>',
														'<?= $usuario['bairro'] ?>',
														'<?= $usuario['cidade'] ?>',
														'<?= $usuario['cep'] ?>',
														'<?= $usuario['estado'] ?>',
														'<?= $usuario['complemento'] ?>'
														)" >Editar</span>
												<span class="btn btn-sm btn-danger" onclick="deleteUser(<?= $usuario['id_usuario'] ?>, '<?=$usuario['nome'] ?>')">Excluir</span>
											</td>
										</tr>
									<?php } ?>
                        </tbody>
                     </table>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- insert new user/update user modal -->
   <div class="modal fade" id="insertStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Inserir novo usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
               <!-- form  -->
               <form id="insertStudent" action='Usuario/insert_user' method="post">
                  <input type="text" id="id_usuario" hidden value="" name="id_usuario" >
                  <!-- Name  -->
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" class="form-control" id="name" name="nome_usuario" placeholder="Insira o nome completo do aluno">
                  </div>
						<!-- Email  -->
                  <div class="form_group">
						<label for="address">Email</label>
                     <input type="text" class="form-control" id="email" name="email_usuario" placeholder="Insira o endereço de email">
                  </div>
						<!-- Senha  -->
						<div class="form_group">
						<label for="address">Senha</label>
                     <input type="text" class="form-control" id="senha" name="senha_usuario" placeholder="Insira a senha">
                  </div>
                  <!-- Address  -->
                  <div class="form-group">
                     <label for="address">Logradouro</label>
                     <input type="text" class="form-control" id="address" name="endereco_usuario" placeholder="Insira o logradouro">
                  </div>
						<!-- Numero  -->
						<div class="form_group">
						<label for="address">Número</label>
                     <input type="text" class="form-control" id="numero" name="numero_usuario" placeholder="Insira o número">
                  </div>
						<!-- Bairro  -->
						<div class="form_group">
						<label for="address">Bairro</label>
                     <input type="text" class="form-control" id="bairro" name="bairro_usuario" placeholder="Insira o bairro">
                  </div>
						<!-- Estado  -->
						<div class="form_group">
						<label for="address">Estado</label>
                     <input type="text" class="form-control" id="estado" name="estado_usuario" placeholder="Insira o estado">
                  </div>
						<!-- Cidade  -->
						<div class="form_group">
						<label for="address">Cidade</label>
                     <input type="text" class="form-control" id="cidade" name="cidade_usuario" placeholder="Insira o cidade">
                  </div>
						<!-- CEP  -->
						<div class="form_group">
						<label for="address">CEP</label>
                     <input type="text" class="form-control" id="cep" name="cep_usuario" placeholder="Insira o cep">
                  </div>
						<!-- Complemento  -->
						<div class="form_group">
						<label for="address">Complemento</label>
                     <input type="text" class="form-control" id="complemento" name="complemento_usuario" placeholder="Insira o complemento">
                  </div>

                  <!-- Submit  -->
                  <span id="sendRequest" class="btn btn-primary mt-2" onclick="insertStudent()">Cadastrar aluno</span>
               </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
         </div>
      </div>
   </div>

   <!-- Load footer  -->
   <?php $this->load->view("global/footer") ?>
</body>
<!-- Body - End  -->
</html>
