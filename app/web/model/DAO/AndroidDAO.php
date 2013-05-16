<?php

class AndroidDAO extends DAO {
    public function getPeriodoSolicitacao() {
        
        try {
            $this->open();

            $q = "
                SELECT 
                    per_data_inicial,
                    per_data_final
                FROM 
                    periodo_destribuicao_vistos
                WHERE
                    per_mes = ".date('n')."
                ";

            $sth = $this->conn->prepare($q);
            $sth->execute();
            
            $periodo = $sth->fetchAll(PDO::FETCH_ASSOC);
            
            return $periodo[0]['per_data_inicial'] . ' ao ' . $periodo[0]['per_data_final'];
            
        } catch (PDOException $e) {
            //se houver exceção, exibe
            //print "<code>" . $e->getMessage() . "</code>";
            return 'Erro interno no servidor.';
        }

        $this->close();
        
    }
}

