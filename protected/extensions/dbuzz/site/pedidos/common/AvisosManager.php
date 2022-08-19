<?php
/*
 * This Class is used to controll all functions related the feature Avisos
 *
 * @author CarlosGarcia
 *
 *
 */

class AvisosManager {

    /**
     * Método para recuperar os avisos 
     * 
     *
     * @param number
     *
    */
    public function getAllAvisos($id, $type_account){
        
        Yii::import('application.extensions.utils.users.UserUtils');

        try{
            
            //Dependendo da conta verifica seus avisos, PF = 0!!!
            if($type_account == "0"){
                
                $recordset['pedidos'] = 0;
                $recordset['propostas'] = 0;
                $recordset['avaliar'] = 0;
                $recordset['eventos'] = 0;
                
                //Verifica quantos pedidos foram feitos pelo usuario
                $sqlRowsPedidos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_pedidos WHERE id_usuario = '$id'")->queryScalar();
                if($sqlRowsPedidos != '0') $recordset['pedidos'] = $sqlRowsPedidos;

                //Verifica quantos propostas foram recebidas pelo usuario
                $sqlRowsPropostas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_propostas WHERE id_usuario = '$id'")->queryScalar();
                if($sqlRowsPropostas != '0') $recordset['propostas'] = $sqlRowsPropostas;
                
                //Verifica quantos owner devem ser avaliados
                $sqlRowsAvaliar = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE id_user = '$id' AND status = 1")->queryScalar();
                if($sqlRowsAvaliar != '0') $recordset['avaliar'] = $sqlRowsAvaliar;
                
                //Verifica quantos owner devem ser avaliados
                $sqlRowsEventos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM eventos_attribute WHERE id_user = '$id' ")->queryScalar();
                if($sqlRowsEventos != '0') $recordset['eventos'] = $sqlRowsEventos;
            
            } else {
                
                $recordset['pedidos'] = 0;
                $recordset['propostas'] = 0;
                $recordset['avaliar'] = 0;
                $recordset['eventos'] = 0;
                
                //Verifica quantos propstas foram enviadas pelo owner
                $sqlRowsPedidos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_propostas WHERE id_owner = '$id'")->queryScalar();
                if($sqlRowsPedidos != '0') $recordset['pedidos'] = $sqlRowsPedidos;

                //Verifica quantos pacotes foram criados pelo owner, no banco a coluna chama id_user!!!!
                $sqlRowsPropostas = Yii::app()->db->createCommand("SELECT COUNT(*) FROM ecommerce_produtos WHERE id_user = '$id'")->queryScalar();
                if($sqlRowsPropostas != '0') $recordset['propostas'] = $sqlRowsPropostas;
                
                //Verifica quantos owner devem ser avaliados
                $sqlRowsAvaliar = Yii::app()->db->createCommand("SELECT COUNT(*) FROM controle_chamados WHERE id_owner = '$id' AND status = 1")->queryScalar();
                if($sqlRowsAvaliar != '0') $recordset['avaliar'] = $sqlRowsAvaliar;
                
                //Verifica quantos owner devem ser avaliados
                $sqlRowsEventos = Yii::app()->db->createCommand("SELECT COUNT(*) FROM eventos_attribute WHERE id_user = '$id' ")->queryScalar();
                if($sqlRowsEventos != '0') $recordset['eventos'] = $sqlRowsEventos;
                
            }
            
            //Pega os aniversariantes do mês
            $recordset['birthday'] = UserUtils::getBirthdays();
            
            //Posts Inhamer
            $sqlRowsPosts = Yii::app()->db->createCommand("SELECT COUNT(*) FROM inhamer_data WHERE id_user = $id ")->queryScalar();
            if($sqlRowsPosts != '0') {$recordset['posts'] = $sqlRowsPosts;}else{$recordset['posts']=0;};
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
}
?>