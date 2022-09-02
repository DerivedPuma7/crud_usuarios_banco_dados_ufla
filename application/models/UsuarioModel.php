<?php

class UsuarioModel extends CI_Model{
	
	private $table = 'usuario';

   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

	/**
	 * busca todos os usuarios cadastrados no banco de dados
	 * @return array - listagem dos usuários
	 */
	public function get_users() {
		$this->db->select('*');
      $this->db->from($this->table);

      return $this->db->get()->result_array();
	}

	/**
	 * insere um novo usuario no banco de dados
	 * @param array $data - dados do usuario que será incluido
	 * @return int $id - id do usuário inserido
	 */
	public function insert_user($data){
      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id();

		return $id;
   }

	/**
	 * deleta um usuario no banco de dados
	 * @param int $id - id do usuário
	 */
	public function delete_user($id){
		$this->db->where('id_usuario', $id);
		$this->db->delete($this->table);
   }

	/**
	 * atualiza um usuario no banco de dados
	 * @param int  $id - id do usuário
	 * @param array $data - dados a serem atualizados
	 */
	public function update_user($id, $data){
      $this->db->where('id_usuario', $id);
      $this->db->update($this->table, $data);
   }
}
