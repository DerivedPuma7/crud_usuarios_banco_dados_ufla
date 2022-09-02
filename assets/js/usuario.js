const BASEURL = "http://localhost/banco_dados_ufla/";

/**
 * Abre modal de inserir/atualizar usuario
 */
function openUserModal() {
   $('#id_usuario').val('') //limpa o value do input onde está o id do usuario

	$('#sendRequest').html('Salvar Usuário');
   $('#insertStudentModal').modal('show');
}

/**
 * abre modal com os dados do usuário que desejamos editar
 * @param {int} id id do usuario que desejamos editar
 * @param {string} nome nome do usuario que desejamos editar
 * @param {string} email email do usuario
 * @param {string} senha senha do usuario
 * @param {string} logradouro logradouro
 * @param {string} numero numero
 * @param {string} bairro bairro
 * @param {string} cidade cidade
 * @param {string} cep cep
 * @param {string} estado estado
 * @param {string} complemento complemento
 */
function editUser(id, nome, email, senha, logradouro, numero, bairro, cidade, cep, estado, complemento) {
	$('#id_usuario').val(id);

   $('#name').val(nome);
	$('#email').val(email);
   $('#address').val(logradouro);
	$('#senha').val(senha);
	$('#numero').val(numero);
	$('#bairro').val(bairro);
	$('#estado').val(estado);
	$('#cidade').val(cidade);
	$('#cep').val(cep);
	$('#complemento').val(complemento);

	$('#sendRequest').html('Editar Usuário');
	$('#insertStudentModal').modal('show');
}


/**
 * Insere/Atualiza usuarios
 */
function insertStudent() {
   let id = $('#id_usuario').val();
   let nome = $('#name').val();
   let logradouro = $('#address').val();
	let email = $('#email').val();
	let numero = $('#numero').val();
	let estado = $('#estado').val();
	let cidade = $('#cidade').val();
	let senha = $('#senha').val();
	let bairro = $('#bairro').val();
	let cep = $('#cep').val();
	let complemento = $('#complemento').val();

	data = {
		'usuario_id': id,
		nome,
		logradouro,
		email,
		numero,
		estado,
		cidade,
		senha,
		bairro,
		cep,
		complemento,
		'method': 'insert'
	}
   
	//chama o controller(backend) passando os dados do usuario
   $.ajax({
      type: "POST",
      url: BASEURL,
      data,
      dataType: "json",
      success: function (response) {
			
         if(response.status){
            info('success', response.message); //chama função generica de alertas
            timeOutRedirect();
         }
         else{
            info('error', response.message); //chama função generica de alertas
         }
      }
   });
}

/**
 * Deleta um usuario específico
 * @param {string} id id do usuario que será excluído
 * @param {string} name nome do usuario que será excluído
 */
function deleteUser(id, name) {
   Swal.fire({  
      title: 'Deseja excluir o usuário "' + name + '" ?',
      icon: 'error',
      showDenyButton: true,
      confirmButtonText: `Sim`,
      denyButtonText: `Não`,
   })
   .then((result) => {
		//se o usuário deseja realmente excluir
      if (result.isConfirmed) {
			//chama o controller(backend)
         $.ajax({
            type: "post",
            url: BASEURL,
            data: {
               id,
					'method': 'delete'
            },
            dataType: "json",
            success: function (response) {
               info('success', response);
               timeOutRedirect();
            }
         });
      }
   })
}

/**
 * Função genérica que exibe alertas
 * @param {string} icon icone que será utilizados
 * @param {string} title mensagem a ser exibida
 */
function info(icon, title){
   Swal.fire({
      position: 'top-end',
      icon,
      title,
      showConfirmButton: false,
      timer: 3500
   })
}

/**
 * Redireciona o usuário para uma página
 * @param {string} page pagina a ser redirecionado
 */
function redirectPage(page = '') {
   window.location.replace(BASEURL + page);
}

function timeOutRedirect() {
	const myTimeout = setTimeout(redirectPage, 2000);
}
