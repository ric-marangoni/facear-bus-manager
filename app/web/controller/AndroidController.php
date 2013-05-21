<?php

class AndroidController extends Controller {
    
    private $bo;
	
	public function getPeriodoSolicitacao() {
		echo $this->bo->getPeriodoSolicitacao();
	}
    
    public function getComboLinhas() {
        echo json_encode($this->bo->getComboLinhas());
    }
    
    public function solicitarVisto() {
        
        $UsuarioBO = new UsuarioBO();
        $LinhaOnibusBO = new LinhaOnibusBO();
        $VistoBO = new VistoBO();
        
        $Usuario = $UsuarioBO->getUsuarioByMatriculaOrCpf(trim($_POST['matricula']));
        
        if(!$Usuario) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Usuário não cadastrado, verifique na secretaria acadêmica.'
            ));
            
            return false;
        }
        
        $LinhaOnibusEntrada = $LinhaOnibusBO->getById((int) $_POST['onibusEntrada'] + 1);
        $LinhaOnibusSaida = $LinhaOnibusBO->getById((int) $_POST['onibusSaida'] + 1);
        
        $Usuario->LinhaOnibusEntrada = $LinhaOnibusEntrada;
        $Usuario->LinhaOnibusSaida = $LinhaOnibusSaida;
        
        $Visto = $VistoBO->getVistoByUsuario($Usuario);
        
        if(!$VistoBO->salvar($Visto)) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Houve um erro interno no servidor.'
            ));
            
            return false;
        }
        
        echo json_encode(array(
                'status' => true,
                'visto' => $VistoBO->getVistoByUsuario($Usuario, true)
            ));
        
    }
    
    public function situacaoVisto() {
        
        $UsuarioBO = new UsuarioBO();
        $VistoBO = new VistoBO();
        
        $Usuario = $UsuarioBO->getUsuarioByMatriculaOrCpf(trim($_POST['matricula']), false, trim($_POST['cpf']));
        
        if(!$Usuario) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Usuário não cadastrado, verifique na secretaria acadêmica.'
            ));
            
            return false;
        }
        
        echo json_encode(array(
                'status' => true,
                'visto' => $VistoBO->getVistoByUsuario($Usuario, true)
            ));
        
    }

    public function __construct() {
        $this->bo = new AndroidBO();
    }
	
}