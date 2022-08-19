<?php
/*
 * This Class is used to controll all functions related the feature Avisoc
 *
 * @author CarlosGarcia
 *
 * Date: 12/07/2011
 *
 */

class EstatisticasManager{
    
    /**
     * Método para recuperar as estatísticas
     * mais gerais que não são exibidas na página de Intro 
     * 
    */
    public function getAllSitesVisits($month = null, $year = null){ 
        
        date_default_timezone_set("Brazil/East");
        
        Yii::import('application.extensions.utils.DateTimeUtils');
                
        //$sql = "SELECT id, plataforma, date, inteiro FROM date_items WHERE MONTH(date) = '$month' AND YEAR(date) = '$year' AND tipo = 'visitas'";
        $sql = "SELECT id, plataforma, date, inteiro FROM date_items WHERE date >= '$year-$month-01' AND date <= '$year-$month-31' AND tipo = 'visitas'";
        
        try{
            $command = Yii::app()->db->createCommand($sql);     
            $recordset = $command->queryAll(); 
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['day'] = DateTimeUtils::getSplitDateNoTime($recordset[$i]['date'], true);
            }
 
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para recuperar os avisos, 
     * essas estatísticas são exibidas na página de Intro do admin
     * São estatístcias comuns
     *
     *
    */
    public function getAllAvisosAdmin(){ 
        
        Yii::import('application.extensions.utils.DataBaseUtils');

        try{      
            $session = MethodUtils::getSessionData();
            
            $recordset['pedidos'] = 0;
            $recordset['propostas'] = 0;
            $recordset['avaliar'] = 0;
            $recordset['comentarios'] = 0;
            $recordset['publicidade_online_abertos'] = 0;$recordset['publicidade_online_fechados'] = 0;$recordset['publicidade_online_total'] = 0;
            $recordset['parceria_abertos'] = 0;$recordset['parceria_fechados'] = 0;$recordset['parceria_total'] = 0;            
            $recordset['associacao_abertos'] = 0;$recordset['associacao_fechados'] = 0;$recordset['associacao_total'] = 0;
            $recordset['contatos_abertos'] = 0;$recordset['contatos_fechados'] = 0;$recordset['contatos_total'] = 0;
            $recordset['clientes'] = 0;
            $recordset['provas_corrigir'] = 0;

            //Verifica quantos pedidos foram feitos pelo usuario
            $sqlRowsPedidos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_pedidos")->queryScalar();
            if($sqlRowsPedidos != '0') $recordset['pedidos'] = $sqlRowsPedidos;

            //Verifica quantos propostas foram recebidas pelo usuario
            $sqlRowsPropostas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_propostas")->queryScalar();
            if($sqlRowsPropostas != '0') $recordset['propostas'] = $sqlRowsPropostas;

            //Verifica quantos owner devem ser avaliados
            $sqlRowsAvaliar = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1")->queryScalar();
            $recordset['avaliar'] = $sqlRowsAvaliar;
            
            //Verifica quantos chamados abertos existem
            $sqlRowsChamdosAbertos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0")->queryScalar();            
            $recordset['chamados_abertos'] = $sqlRowsChamdosAbertos;            

            //Verifica quantos comentários precisam ser aprovados 
            $sqlRowsComentarios = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_comentarios WHERE exibir_comentario = 0")->queryScalar();
            $sqlTotalRowsComentarios = Yii::app()->db->createCommand("SELECT COUNT(*) FROM general_comentarios")->queryScalar();
            if($sqlRowsComentarios != '0') $recordset['comentarios'] = $sqlRowsComentarios; 
            if($sqlTotalRowsComentarios != '0') $recordset['comentarios_total'] = $sqlTotalRowsComentarios;
            
            //Verifica quantos pedidos de parceria estão abertos
            $sqlRowsParceria = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'parceria'")->queryScalar();
            $sqlRowsParceriaFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'parceria'")->queryScalar();
            $sqlTotalRowsParceria = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'parceria'")->queryScalar();
            if($sqlRowsParceria != '0')$recordset['parceria_abertos'] = $sqlRowsParceria;
            if($sqlRowsParceriaFechados != '0') $recordset['parceria_fechados'] = $sqlRowsParceriaFechados;
            if($sqlTotalRowsParceria != '0')  $recordset['parceria_total'] = $sqlTotalRowsParceria;
            
            //Verifica quantos pedidos de publicidade foram gerados 
            $sqlRowsPublicidade = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'publicidade'")->queryScalar();
            $sqlRowsPublicidadeFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'publicidade'")->queryScalar();
            $sqlTotalRowsPublicidade = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'publicidade'")->queryScalar();
            if($sqlRowsPublicidade != '0') $recordset['publicidade_online_abertos'] = $sqlRowsPublicidade;
            if($sqlRowsPublicidadeFechados != '0') $recordset['publicidade_online_fechados'] = $sqlRowsPublicidadeFechados;
            if($sqlTotalRowsPublicidade != '0')  $recordset['publicidade_online_total'] = $sqlTotalRowsPublicidade;
            
            //Verifica quantos pedidos de associaçao existem 
            $sqlRowsAssociacao = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'associar'")->queryScalar();
            $sqlRowsAssociacaoFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'associar'")->queryScalar();
            $sqlTotalRowsAssociacao = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'associar'")->queryScalar();
            if($sqlRowsAssociacao != '0') $recordset['associacao_abertos'] = $sqlRowsAssociacao; 
            if($sqlRowsAssociacaoFechados != '0') $recordset['associacao_fechados'] = $sqlRowsAssociacaoFechados;
            if($sqlTotalRowsAssociacao != '0') $recordset['associacao_total'] = $sqlTotalRowsAssociacao; 
            
            //Verifica quantos pedidos de associaçao existem 
            $sqlRowsContato = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'contato'")->queryScalar();
            $sqlRowsContatoFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'contato'")->queryScalar();
            $sqlTotalRowsContato = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'contato'")->queryScalar();
            if($sqlRowsContato != '0') $recordset['contato_abertos'] = $sqlRowsContato; 
            if($sqlRowsContatoFechados != '0') $recordset['contato_fechados'] = $sqlRowsContatoFechados; 
            if($sqlTotalRowsContato != '0') $recordset['contato_total'] = $sqlTotalRowsContato; 
            
            //Verifica quantos provas para corrigir 
            $sqlRowsProvas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM pesquisa_participantes WHERE status = '0'")->queryScalar();
            if($sqlRowsProvas != '0') $recordset['provas_corrigir'] = $sqlRowsProvas; 
            
            //Get user's data
            $recordset['user'] = Yii::app()->db->createCommand("SELECT * FROM user_data WHERE id = {$session['id']}")->queryRow();
            
            //Verifica quantos clientes novos neste mês
            date_default_timezone_set("Brazil/East");
            $month = date('m');//this month
            $year = date('Y');//this year
            $week_number = date("W") - 1;
            $day_week = 1;
            $day = date('d', strtotime($year."W".$week_number.$day_week));
            $thisDate = $year."-".$month."-".$day;
            $sqlRowsClientes = Yii::app()->db->createCommand("SELECT COUNT(*) FROM user_data WHERE creation >= '$thisDate'")->queryScalar();
            if($sqlRowsClientes != '0') $recordset['clientes'] = $sqlRowsClientes;
            $recordset['clientes_total'] = DataBaseUtils::getCountRecords("user_data", "", "", true);

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    
    /**
     * Método para recuperar as estatísticas
     * mais gerais que não são exibidas na página de Intro 
     * 
    */
    public function getAllCommons(){        

        try{                
            $recordset['reclamacoes_abertos'] = 0; 
            $recordset['reclamacoes_fechados'] = 0;
            $recordset['reclamacoes_total'] = 0; 
            $recordset['tarefas_abertos'] = 0; 
            $recordset['tarefas_fechados'] = 0; 
            $recordset['tarefas_total'] = 0;
            
            //Verifica quantos pedidos de reclamacao estão abertos
            $sqlRowsReclamar = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'reclamar'")->queryScalar();
            $sqlRowsReclamarFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'reclamar'")->queryScalar();
            $sqlTotalRowsReclamar = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'reclamar'")->queryScalar();
            if($sqlTotalRowsReclamar != '0') $recordset['reclamacoes_total'] = $sqlTotalRowsReclamar;
            if($sqlRowsReclamar != '0') $recordset['reclamacoes_abertos'] = $sqlRowsReclamar; 
            if($sqlRowsReclamarFechados != '0') $recordset['reclamacoes_fechados'] = $sqlRowsReclamarFechados;             
       
            //Verifica quantos pedidos de tarefas estão abertos
            $sqlRowsTarefas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 0 AND tipo = 'tarefa'")->queryScalar();
            $sqlRowsTarefasFechados = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE status = 1 AND tipo = 'tarefa'")->queryScalar();
            $sqlTotalRowsTarefas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE tipo = 'tarefa'")->queryScalar();
            if($sqlTotalRowsTarefas != '0') $recordset['tarefas_total'] = $sqlTotalRowsTarefas;
            if($sqlRowsTarefas != '0') $recordset['tarefas_abertos'] = $sqlRowsTarefas;
            if($sqlRowsTarefasFechados != '0')$recordset['tarefas_fechados'] = $sqlRowsTarefasFechados;
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as estatísticas
     * mais gerais que não são exibidas na página de Intro 
     * 
    */
    public function getStatisticsByType($url = '', $report = '', $month = '', $group = ''){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month);

        try{                
            if($url != '') $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM activity_log WHERE uri = '$url' AND (time >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND time < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00')")->queryScalar(); 
            
            if($report != '') $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM activity_log WHERE msg = '$report' AND (time >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND time < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00')")->queryScalar(); 
            
            if($group != '') {
                $sql = "SELECT uri, msg, COUNT(num) FROM activity_log WHERE msg = '$report' AND (time >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND time < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00')  GROUP BY $group ORDER by COUNT(num) ASC";
                $command = Yii::app()->db->createCommand($sql);
                $sqlRows = $command->queryAll();
            }
            
            return $sqlRows;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as palavras mais buscadas
     * 
    */
    public function getSearchByType($tipo, $month){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month);

        try{                
            $recordset = Yii::app()->db->createCommand("SELECT COUNT(num) as views, msg FROM activity_log WHERE tipo = '$tipo' AND (time >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND time < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00') GROUP BY msg ORDER by COUNT(num) DESC")->queryAll(); 
           
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as palavras mais buscadas
     * 
    */
    public function getCityActivity($tipo, $month){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $date = DateTimeUtils::getMonthSequence($month);
        
        ($tipo != 'todos') ? $query = "tipo = '$tipo' AND" : $query = "";

        try{                
            $recordset = Yii::app()->db->createCommand("SELECT COUNT(num), msg, cidade FROM activity_log WHERE $query (time >= '".$date['year_current']. "-".$date['month_current']. "-01 00:00:00' AND time < '".$date['year_next']. "-".$date['month_next']. "-01 00:00:00') GROUP BY cidade ORDER by COUNT(num) DESC")->queryAll(); 
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
}
?>