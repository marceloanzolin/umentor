<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    public function index()
    {
        $filtro = $this->input->get('filtro');
        $usuarios = $this->Usuario_model->pesquisarUsuarioFiltro($filtro);
    
        $data['usuarios'] = $usuarios;
        $this->load->view('usuarios/index', $data);
    }
    
    public function pesquisarUsuario()
    {
        $filtro = $this->input->get('filtro');
        $usuarios = $this->Usuario_model->pesquisarUsuarioFiltro( $filtro);

        $data = array_map(function($usuario) {
            return [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'situacao' => $usuario['situacao'] == "A" ? "Ativo" : "Inativo",
                'data_admissao' => $usuario['data_admissao'],
                'data_hora_cadastro' => $usuario['data_hora_cadastro'],
                'data_hora_atualizacao' => $usuario['data_hora_atualizacao']
            ];
        }, $usuarios);
    
        echo json_encode($data);
    }

    public function manutencao($id = null) {
        if($id){
            $data['usuario'] = $this->Usuario_model->getUsuarioId($id);
            $this->load->view('usuarios/form', $data);
        }else{
            $this->load->view('usuarios/form');
        }
    }
    
    public function salvar() {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'situacao' => $this->input->post('situacao') == null ? 'I' : 'A',
            'data_admissao' => $this->input->post('data_admissao')
        );

        if ($this->input->post('id') == null){
            $data['data_hora_cadastro'] = date('Y-m-d H:i:s');
            $this->Usuario_model->criarUsuario($data);
            $this->session->set_flashdata('message', 'Usuário criado com sucesso!');
         }else{
            $data['data_hora_atualizacao'] = date('Y-m-d H:i:s');
            $this->Usuario_model->atualizarUsuario($this->input->post('id'), $data);
            $this->session->set_flashdata('message', 'Usuário atualizado com sucesso!');
        }
        redirect('usuarios');
    }

    public function excluir($id) {
        $this->Usuario_model->removerUsuario($id);
        $this->session->set_flashdata('message', 'Usuário excluido com sucesso!');
        redirect('usuarios');
    }
}