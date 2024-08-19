<?php
class Usuario_model extends CI_Model {

    public function __construct() {
         $this->load->database();
    }

    public function getUsuarioId($id) {
        $query = $this->db->get_where('usuarios', array('id' => $id));
        return $query->row_array();
    }

    public function criarUsuario($data) {
        return $this->db->insert('usuarios', $data);
    }

    public function atualizarUsuario($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('usuarios', $data);
    }

    public function removerUsuario($id) {
        $this->db->where('id', $id);
        return $this->db->delete('usuarios');
    }

    public function pesquisarUsuarioFiltro($filtro = '') {
        $filtro = $this->db->escape_like_str($filtro);
        $this->db->select('*');
        $this->db->from('usuarios');
        if (!empty($filtro)) {
            $this->db->like('nome', $filtro);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
