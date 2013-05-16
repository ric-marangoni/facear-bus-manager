<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FolgaController
 *
 * @author Ricardo
 */
class FolgaController {

    public function index() {
        
    }

    public function incluir() {

        $funcaoDAO = new FuncaoDAO();

        $this->view->funcoes = $funcaoDAO->getAll();

        $this->view->load('incluir.php');
    }

    public function inserir() {

        $folga = new Folga();
        $folgaDAO = new FolgaDAO();
        $funcionarioDAO = new FuncionarioDAO();
        $retorno = array();

        $folga->data = $this->request->post->data_folga;
        $funcionarios = $this->request->post->funcionarios_a_folgar;

        foreach ($funcionarios as $funcionario_id) {

            $folga->funcionario = $funcionarioDAO->getById($funcionario_id);

            $is_inserted = $folgaDAO->inserir($folga);

            if (!$is_inserted) {
                $retorno = array('error' => true, 'message' => 'Houve alguma falha ao inserir a folga.');
                echo json_encode($retorno);
                exit;
            }
        }

        $retorno = array('error' => false, 'message' => '<strong>Folga</strong> inserida com sucesso.');

        echo json_encode($retorno);
    }

    public function getAll() {

        $folgaDAO = new FolgaDAO;

        return $folgaDAO->getAll();
    }

    public function getAllWithJsonFormat() {

        $lista_folgas = $this->getAll();

        $calendar_folgas = array();

        foreach ($lista_folgas as $folga) {

            $link = '';


            $calendar_folgas[] = array(
                'id' => $folga['folga_id'],
                'title' => 'Folga de ' . $folga['nome'] . $link,
                'start' => $folga['data']
            );
        }

        echo json_encode($calendar_folgas);
    }

    public function getAllByByFuncaoId() {
        
        $funcao_id = $this->request->post->funcao_id;
        
        $folgaDAO = new FolgaDAO;
        
        $lista_folgas = $folgaDAO->getByFuncaoId($funcao_id);

        $folgas = array();
        $funcionario_id_anterior = 0;

        foreach ($lista_folgas as $folga) {

            $mes = (int)date('m', strtotime($folga['data']));

            if ($funcionario_id_anterior != $folga['funcionario_id']) {

                for($i = 0; $i <= 12; $i++) {
                    $folgas[$folga['funcionario_id']]['dados'][$i]['count'] = 0;
                    $folgas[$folga['funcionario_id']]['dados'][$i]['description'] = '';
                }
            }

            $folgas[$folga['funcionario_id']]['nome'] = $folga['nome'];
            $folgas[$folga['funcionario_id']]['id'] = $folga['funcionario_id'];
            
            $folgas[$folga['funcionario_id']]['dados'][$mes]['count']++;

            $folgas[$folga['funcionario_id']]['dados'][$mes]['description'] .= '<br /><b>' . date('d/m/Y', strtotime($folga['data'])) . '</b>';

            $funcionario_id_anterior = $folga['funcionario_id'];
        }

        echo json_encode($folgas);
    }

    public function update() {

        $folgaDAO = new FolgaDAO();

        $id = $this->request->post->id;
        $data = date('Y-m-d', strtotime($this->request->post->new_date));

        $folgaDAO->update($id, $data);
    }

    public function __construct() {
        
    }

}