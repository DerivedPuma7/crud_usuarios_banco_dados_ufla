<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Usuario extends CI_Controller{

   /**
    * Construtor: carrega a model
    */
   public function __construct() {
      parent::__construct();
      $this->load->model('UsuarioModel');
   }

	/**
	 * primeira função a ser executada
	 * busca todos os usuarios do banco e mostra a tela com a tabela
	 */
	public function index(){
      if(!empty($this->input->post())) {
			$this->find_method();
			return;
		}

      $usuarios = $this->UsuarioModel->get_users();
		$data = [
			'usuarios' => $usuarios
		];

      $this->load->view("home", $data);
   }

	private function find_method() {
		$data = $this->input->post();

		if($data['method'] == 'insert' || $data['method'] == 'update') {
			$this->insert();
			return;
		}

		if($data['method'] == 'delete') {
			$this->delete();
			return;
		}
	}

   /**
    * Insere novos alunos no banco de dados
    */
   public function insert(){
      //segurança: evita o acesso por meio de uma requisição GET
      if(empty($this->input->post())){
         exit("<h3>Não é possível acessar essa URL no momento</h3>");
      }

      $data = $this->input->post();
		unset($data['method']);

      //checa erros nos campos do form
		$errors = $this->validate_request_body($data);
      
		// caso exista campos vazios 
      if(!empty($errors)){
         echo json_encode($errors);
			return;
      }

		//insere um novo aluno
		if(empty($data['usuario_id'])){
			array_shift($data);
			$response = $this->UsuarioModel->insert_user($data);
			
			$return = [
				'status'  => false,
				'message' =>'Falha ao inserir novo aluno. Por favor, tente novamente!'
			];
			
			//se o insert der certo
			if($response){
				$return = [
					'status'  => true,
					'message' =>'Aluno inserido com sucesso !'
				];
			}
			echo json_encode($return);
			return;
		}

		//Atualizar um aluno ja cadastrado
		$id = $data['usuario_id'];
		unset($data['usuario_id']);
		$this->UsuarioModel->update_user($id, $data);
		echo json_encode([
			'status'  => true,
			'message' =>'Cadastro atualizado com sucesso !'
		]);
   }

	/**
	 * valida campos vindos do front
	 * @param array $data - dados vindos da request
	 */
	private function validate_request_body($data) {
		$errors = [];

      if($data['nome'] == '' || $data['nome'] == null){
         $errors['name'] = 'O nome do aluno deve ser preenchido!';
      }
      if($data['logradouro'] == '' || $data['logradouro'] == null){
         $errors['address'] = 'O endereço do aluno deve ser preenchido!';
      }
      if($data['email'] == '' || $data['email'] == null){
         $errors['photo'] = 'A foto do aluno é obrigatória!';
      }

		return $errors;
	}

   /**
    * Deleta um usuario específico pelo seu id
    */
   public function delete(){
      //segurança: evita o acesso por meio de uma requisição GET
      if(empty($this->input->post())){
         exit("<h3>Não é possível acessar essa URL no momento</h3>");
      }

      $id = $this->input->post('id');
		$this->UsuarioModel->delete_user($id);

      echo json_encode('Usuário excluído com sucesso!');
   }

}
