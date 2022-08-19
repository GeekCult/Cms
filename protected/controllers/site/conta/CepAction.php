<?php

class CepAction extends CAction{

    private $action;
    private $event;
    private $user;
    private $id;    

    /**
     *
     * CEP Action
     * 
     * It handles with all action related with the CEP
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');

        switch($this->action){            
            case "webservice":          
                $this->CEP();
                break;
            default:          
                echo 'Error';
                break;
        }
    }
    
    /*
     * Cep Web Service
     * 
     * It shows the cep using the ManagerPurplePier Data Base.
     *
     */
    public function CEP($arg = false, $isReturn = false){
        
        if(!$arg) $cep = $_REQUEST['cep'];
        if( $arg) $cep = $arg;
        
        $cep_arr = explode("-", $cep);
        
        $select = "id, Cep1, Cep2, uf";
        $sql = "SELECT $select FROM general_cep_uf";

        try{          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            $uf = ""; $id_uf = "";
            foreach($recordset as $values){
                if($cep_arr[0] >= $values['Cep1'] && $cep_arr[0] <= $values['Cep2']){$uf = strtolower($values['uf']); $id_uf = $values['id'];}
            }

        
            $select = "id, cidade, bairro, logradouro, tp_logradouro";
            $sql = "SELECT $select FROM general_cep_$uf WHERE cep = '$cep'";
        
          
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow(); 
            $recordset['uf'] = strtoupper($uf);
            $recordset['id_uf'] = $id_uf;
            
            //echo $recordset['tp_logradouro']. ": " .$recordset['logradouro'] . " - " .$recordset['cidade'] . " / " . $recordset['uf'];
            if( $isReturn) return $recordset;
            if(!$isReturn) echo json_encode($recordset);

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }
}
?>