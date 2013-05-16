<?php

class FuncionarioDAO extends DAO {

    public function inserir($Funcionario) {

        $insert = false;

        try {
            $this->open();

            $sth = $this->conn->prepare("
                            INSERT INTO funcionario
                                    (nome, funcao_id, horario_trabalho_inicio, horario_trabalho_fim)
                            VALUES
                                    (:nome, :funcao_id, :horario_trabalho_inicio, :horario_trabalho_fim)	
			");

            $params = array(
                ':nome' => $Funcionario->nome,
                ':funcao_id' => $Funcionario->Funcao->id,
                ':horario_trabalho_inicio' => $Funcionario->hora_ini,
                ':horario_trabalho_fim' => $Funcionario->hora_fim,
            );
            
            $sth->execute($params);
            
            $last_id = $this->getLastInsertedId();
            
            foreach ($Funcionario->areas_cocheira as $area_cocheira) {
                $this->insertAreaCocheira($last_id, $area_cocheira);
            }

            $insert = true;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();

        return $insert;
    }
    
    private function insertAreaCocheira($funcionario_id, $area_cocheira_id) {
        
        try {
            $this->open();
            
            $sth = $this->conn->prepare("
                            INSERT INTO area_cocheira_funcionario
                                    (funcionario_id, area_cocheira_id)
                            VALUES
                                    (:funcionario_id, :area_cocheira_id)	
			");

            $params = array(
                ':funcionario_id' => $funcionario_id,
                ':area_cocheira_id' => $area_cocheira_id
            ); 
            
            $sth->execute($params);

            
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
        
    }
    
    public function atualizar($Funcionario) {

        $update = false;

        try {
            $this->open();

            $sth = $this->conn->prepare("
                            DELETE FROM 
                                    area_cocheira_funcionario
                            WHERE
                                    funcionario_id = :id;

                            UPDATE 
                                funcionario
                            SET
                                nome = :nome,
                                funcao_id = :funcao_id,
                                horario_trabalho_inicio = :horario_trabalho_inicio,
                                horario_trabalho_fim = :horario_trabalho_fim                                
                            WHERE
                                id = :id;
			");

            $params = array(
                ':id' => $Funcionario->id,
                ':nome' => $Funcionario->nome,
                ':funcao_id' => $Funcionario->Funcao->id,
                ':horario_trabalho_inicio' => $Funcionario->hora_ini,
                ':horario_trabalho_fim' => $Funcionario->hora_fim,
            );

            $sth->execute($params);
            
            foreach ($Funcionario->areas_cocheira as $area_cocheira) {
                $this->insertAreaCocheira($Funcionario->id, $area_cocheira);
            }

            $update = true;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
        
        return $update;
    }
    
    private function getLastInsertedId() {
        try {
            $this->open();
            
            $q = "
                SELECT 
                    MAX(id) AS id
                FROM 
                    funcionario";

            $sth = $this->conn->prepare($q);
            $sth->execute();

            $result = $sth->fetchAll();
            
            return $result[0]['id'];
            
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    }

    public function listar() {

        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    func.descricao
                FROM 
                    funcionario AS f
                INNER JOIN
                    funcao AS func ON f.funcao_id = func.id
                ORDER BY
                    f.id DESC";

            $sth = $this->conn->prepare($q);
            $sth->execute();

            $result = $sth->fetchAll();
            $lista_funcionarios = array();

            foreach ($result as $func) {
                $Funcionario = new Funcionario();
                $Funcao = new Funcao();

                $Funcao->id = $func['funcao_id'];
                $Funcao->descricao = $func['descricao'];

                $Funcionario->id = $func['id'];
                $Funcionario->nome = $func['nome'];
                
                $areas = array();
                
                foreach($this->getAreasCoheiraByFuncionarioId($func['id']) as $area) {
                    $areas[] = utf8_encode($area['descricao']);
                }
                
                $Funcionario->areas_cocheira = $areas;
                
                $Funcionario->Funcao = $Funcao;
                $Funcionario->hora_ini = $func['horario_trabalho_inicio'];
                $Funcionario->hora_fim = $func['horario_trabalho_fim'];

                $lista_funcionarios[] = $Funcionario;
            }

            return $lista_funcionarios;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    }
    
    public function getById($funcionario_id) {
        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    func.descricao
                FROM 
                    funcionario AS f
                INNER JOIN
                    funcao AS func ON f.funcao_id = func.id
                WHERE
                    f.id = :funcionario_id
                ";

            $sth = $this->conn->prepare($q);
            
            $params = array(
                ':funcionario_id' => $funcionario_id
            );
            
            $sth->execute($params);

            $func = $sth->fetch();
            
            $Funcionario = new Funcionario();
            $Funcao = new Funcao();

            $Funcao->id = $func['funcao_id'];
            $Funcao->descricao = $func['descricao'];

            $Funcionario->id = $func['id'];
            $Funcionario->nome = $func['nome'];
            $Funcionario->Funcao = $Funcao;
            $Funcionario->hora_ini = $func['horario_trabalho_inicio'];
            $Funcionario->hora_fim = $func['horario_trabalho_fim'];
            
            return $Funcionario;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    }

    public function excluir($funcionario_id) {
        $delete = false;

        try {
            $this->open();

            $sth = $this->conn->prepare("
                                DELETE FROM 
					area_cocheira_funcionario
				WHERE
					funcionario_id = :funcionario_id;
                            
				DELETE FROM 
					funcionario
				WHERE
					id = :funcionario_id;
				
			");

            $params = array(':funcionario_id' => $funcionario_id);

            $sth->execute($params);

            $delete = true;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();

        return $delete;
    }
    
    public function getFuncionarioById($id) {
        
        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    func.descricao
                FROM 
                    funcionario AS f
                INNER JOIN
                    funcao AS func ON f.funcao_id = func.id
                WHERE
                   f.id = :id 
                ";

            $sth = $this->conn->prepare($q);
            
            $params = array(':id' => $id);
            
            $sth->execute($params);

            $result = $sth->fetch();
            
            $Funcionario = new Funcionario();
            $Funcao = new Funcao();
            
            $Funcionario->Funcao = $Funcao;
            
            if(!empty($result)) {                
                $Funcionario->id                = $result['id'];
                $Funcionario->nome              = $result['nome'];
                $Funcionario->areas_cocheira    = $this->getAreasCoheiraByFuncionarioId($id);
                $Funcionario->Funcao->id        = $result['funcao_id'];
                $Funcionario->Funcao->descricao = $result['descricao'];
                $Funcionario->hora_ini          = $result['horario_trabalho_inicio'];
                $Funcionario->hora_fim          = $result['horario_trabalho_fim'];
            }
            
            return $Funcionario;
            
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
        
    }
    
    public function getAreasCoheiraByFuncionarioId($funcionario_id) {
        
        try {
            $this->open();
            
            $q = "
                SELECT 
                    ac.id,
                    ac.descricao
                FROM 
                    area_cocheira_funcionario AS acf
                INNER JOIN
                    area_cocheira AS ac ON ac.id = acf.area_cocheira_id
                WHERE
                    acf.funcionario_id = :funcionario_id
                ";

            $sth = $this->conn->prepare($q);
            
            $params = array(':funcionario_id' => $funcionario_id);
            
            $sth->execute($params);
            
            $result = $sth->fetchAll();
            $lista_areas = array();

            foreach ($result as $key => $area) {
                $lista_areas[$key]['id'] = $area['id'];
                $lista_areas[$key]['descricao'] = $area['descricao'];
            }

            return $lista_areas;
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
        
    }
    
    
    public function getAllByFuncaoId($funcao_id) {
        
        try {
            $this->open();
            
            $q = "
                SELECT 
                    f.id,
                    f.nome,
                    f.funcao_id,
                    f.horario_trabalho_inicio,
                    f.horario_trabalho_fim,
                    func.descricao
                FROM 
                    funcionario AS f
                INNER JOIN
                    funcao AS func ON f.funcao_id = func.id
                WHERE
                   func.id = :id 
                ORDER BY
                    f.nome ASC
                ";

            $sth = $this->conn->prepare($q);
            
            $params = array(':id' => $funcao_id);
            
            $sth->execute($params);

            $funcionarios = $sth->fetchAll();
                    
            return $funcionarios;
            
        } catch (PDOException $e) {
            //se houver exceção, exibe
            print "<code>" . $e->getMessage() . "</code>";
        }

        $this->close();
    }
    

}