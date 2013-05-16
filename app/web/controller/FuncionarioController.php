<?php

class FuncionarioController extends Controller {

    public function index() {
        $this->listar();
    }
    
    public function listar() {

        $FuncionarioDAO = new FuncionarioDAO();

        $this->view->lista_funcionarios = $FuncionarioDAO->listar();

        $this->view->load('listar.php');
    }

    public function novo() {
        
        $funcaoDAO = new FuncaoDAO();
        
        $this->view->funcoes = $funcaoDAO->getAll();
        
        $this->view->load('novo.php');
    }

    public function inserir() {

        $Funcionario = new Funcionario();
        $Funcionario->Funcao = new Funcao();

        $Funcionario->nome              = $this->request->post->nome;
        $Funcionario->Funcao->id        = $this->request->post->funcao;
        $Funcionario->areas_cocheira 	= isset($_POST['areas_cocheira']) ? $_POST['areas_cocheira'] : '';
        $Funcionario->hora_ini          = $this->request->post->hora_ini;
        $Funcionario->hora_fim          = $this->request->post->hora_fim;

        $FuncionarioDAO = new FuncionarioDAO();

        $is_inserted = $FuncionarioDAO->inserir($Funcionario);

        if ($is_inserted) {
            $this->session->setFlash('success', true);
            $this->session->setFlash('message_success', '<strong>Pronto!</strong> Seu novo funcionário foi cadastrado com sucesso.');
        } else {
            $this->session->setFlash('error', true);
        }

        $this->redirect('listar');
    }

    public function excluir() {

        $FuncionarioDAO = new FuncionarioDAO();

        $id = $_POST['funcionario_id'];

        $is_deleted = $FuncionarioDAO->excluir($id);

        $retorno = array();

        if ($is_deleted) {
            $retorno = array('error' => false, 'message' => '<strong>Funcionário</strong> excluido com sucesso.');
        } else {
            $retorno = array('error' => true, 'message' => 'Houve alguma falha ao excluir o funcionário.');
        }

        echo json_encode($retorno);
    }
    
    public function visualizar() {
        $id = $this->request->get->id;
        
        $FuncionarioDAO = new FuncionarioDAO();
        
        $this->view->funcionario = $FuncionarioDAO->getFuncionarioById($id);
        
        $areas = array();
        
        foreach($this->view->funcionario->areas_cocheira as $area) {
            $areas[] = utf8_encode($area['descricao']);
        }
        
        $this->view->areas = $areas;
        
        $this->view->load('visualizar.php');
    }
    
    public function editar() {
        
        $id = $this->request->get->id;
        
        $FuncionarioDAO = new FuncionarioDAO();
        
        $this->view->funcionario = $FuncionarioDAO->getFuncionarioById($id);
        
        $this->view->load('editar.php');
        
    }
    
    public function atualizar() {
        
        $Funcionario = new Funcionario();
        $Funcionario->Funcao = new Funcao();
        
        $Funcionario->id                = $this->request->post->id;
        $Funcionario->nome              = $this->request->post->nome;
        $Funcionario->Funcao->id        = $this->request->post->funcao;
        $Funcionario->areas_cocheira 	= isset($_POST['areas_cocheira']) ? $_POST['areas_cocheira'] : '';
        $Funcionario->hora_ini          = $this->request->post->hora_ini;
        $Funcionario->hora_fim          = $this->request->post->hora_fim;

        $FuncionarioDAO = new FuncionarioDAO();

        $is_updated = $FuncionarioDAO->atualizar($Funcionario);

        if ($is_updated) {
            $this->session->setFlash('success', true);
            $this->session->setFlash('message_success', '<strong>Feito!</strong> Seu funcionário foi atualizado com sucesso.');
        } else {
            $this->session->setFlash('error', true);
        }

        $this->redirect('listar');
        
    }
    
    public function getAllByFuncaoId() {
        
        $funcionarioDAO = new FuncionarioDAO();
        
        $funcao_id = $this->request->post->funcao_id;
        
        $funcionarios = $funcionarioDAO->getAllByFuncaoId($funcao_id);
        
        echo json_encode($funcionarios);
        
    }
    
    public function __construct() {}

}