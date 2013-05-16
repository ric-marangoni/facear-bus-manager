<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FolgaDAO
 *
 * @author Ricardo
 */
class FolgaDAO extends DAO {
    
    public function inserir($folga) {
        $insert = false;
        
        $data = explode('/', $folga->data);        
        $data = implode('-', (array_reverse($data)));
        
        try {
            $this->open();

            $sth = $this->conn->prepare("
                            INSERT INTO folga
                                    (funcionario_id, data)
                            VALUES
                                    (:funcionario_id, :data)	
			");

            $params = array(
                ':funcionario_id'   => $folga->funcionario->id,
                ':data'             => $data
            );

            $sth->execute($params);

            $insert = true;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();

        return $insert;
    }
    
    public function getAll() {
        
        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id AS funcionario_id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    fol.id AS folga_id,
                    fol.data
                FROM 
                    folga AS fol
                INNER JOIN
                    funcionario AS f ON fol.funcionario_id = f.id
                ORDER BY
                    f.id
                ";

            $sth = $this->conn->prepare($q);
            $sth->execute();

            $lista_folgas = $sth->fetchAll();
            
            return $lista_folgas;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    
        
    }
    
    public function getByFuncaoId($funcao_id) {
        
        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id AS funcionario_id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    fol.id AS folga_id,
                    fol.data
                FROM 
                    folga AS fol
                INNER JOIN
                    funcionario AS f ON fol.funcionario_id = f.id
                WHERE
                    f.funcao_id = :funcao_id
                ORDER BY
                    f.id
                ";

            $sth = $this->conn->prepare($q);
            
            $params = array(':funcao_id' => $funcao_id);
            
            $sth->execute($params);

            $lista_folgas = $sth->fetchAll();
            
            return $lista_folgas;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    
        
    }
    
    public function update($folga_id, $data) {
        
        $update = false;
        
        try {
            $this->open();

            $sth = $this->conn->prepare("
                            UPDATE 
                                folga
                            SET
                                data = :data
                            WHERE
                                id = :id
			");

            $params = array(
                ':id'   => $folga_id,
                ':data' => $data
            );

            $sth->execute($params);

            $update = true;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();

        return $update;
        
    }
    
}
