<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FuncaoDAO
 *
 * @author Ricardo
 */
class FuncaoDAO extends DAO {

    public function getAll() {

        try {
            $this->open();

            $q = "
                SELECT 
                    *
                FROM 
                    funcao
                ";

            $sth = $this->conn->prepare($q);
            $sth->execute();

            $funcoes = $sth->fetchAll();
            $lista_funcoes = array();

            foreach ($funcoes as $funcao) {

                $Funcao = new Funcao();

                $Funcao->id = $funcao['id'];
                $Funcao->descricao = utf8_encode($funcao['descricao']);
                
                $lista_funcoes[] = $Funcao;
            }

            return $lista_funcoes;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    }

}

?>
