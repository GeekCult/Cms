<?php

/**
 * Description of PurpleStoreUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class PurpleStoreUtils{
    
    /**
     * Método para dar resize no video
     *
     * @param string
     *
    */
    public static function getAttributes($tipo){
        
        $result = array(); 
        
        switch ($tipo){
            case "componente_site":
                $result['type'] = $tipo;
                $result['path'] = "layout_aplicativo";
                $result['chamada'] = "instale aplicativos a sua plataforma";
                break;
            
            case "bloco_pagina":
                $result['type'] = $tipo;
                $result['path'] = "layout_block";
                $result['chamada'] = "adicione componentes as suas Páginas Avançadas";
                break;
            
            case "email_content":
                $result['type'] = $tipo;
                $result['path'] = "layout_email";
                $result['chamada'] = "adicione componentes as seus E-mail Marketing";
                break;
            
            default:
                $result['type'] = $tipo;
                $result['path'] = "layout_aplicativo";
                $result['chamada'] = "adicione componentes as suas Páginas Avançadas";
                break;
        }
          
        return $result;
    }   
    
    /**
     * Método retornar um item vazio
     *
    */
    public static function getClearItem(){
        
        $result = array('titulo' => '', 'descricao' => '', 'valor' => '', 'id' => '', 'thumb' => '', 'tipo' => '', 'cool' => '', 'modelo' => '',
                        'valor_total' => '', 'lancamento' => 1, 'link' => '', 'promocao' => '', 'date_string' => date('d/m/Y')); 
        return $result;
    } 
    
    /**
     * Método para checar se algo já foi comprado
     * 
     * @param array
     * @param string
     *
    */
    public static function checkItemIsPurchased($item, $type){

        $sql = "SELECT id, name, inteiro FROM preferencias_attribute WHERE id_general = {$item['id']}";
  
        try{     
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    } 
    
    /**
     * Método para mudar o status
     * 
     * @param array
     * @param string
     *
    */
    public static function setItemStatus($id, $status){

        $sql = "UPDATE preferencias_attribute SET inteiro = '{$status}' WHERE id = $id";
  
        try{     
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para pegar um item pelo id
     * 
     * @param array
     * @param string
     *
    */
    public static function getItemById($id, $isField = false){

        Yii::import('application.extensions.dbuzz.site.special.PurpleStoreManager');
        $purpleStore = new PurpleStoreManager();
        
        return $purpleStore->getItemById($id, $isField);
 
    }
    
    /**
     * Método para pegar checar se um item deve ser cobrado e qual o valor deste
     * 
     * @param array
     * @param string
     *
    */
    public static function checkItemBeforeInvoice($item){

        if(isset($item['promocao']) && $item['promocao'] != 0 && $item['promocao'] != '') $item['valor'] = $item['promocao'];
        
        return $item;
 
    }
    
    /**
     * Método para retornar formatado para invoice
     * 
     * @param array
     *
    */
    public static function getFormatToInvoice($recordset){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $valor = 0; $email_qtd = 0;
        
        if($recordset){for($i = 0; $i < count($recordset); $i++){
            $recordset['items'][$i]['date_string'] = DateTimeUtils::getDateFormateNoTime($recordset['items'][$i]['date']);
            $recordset['items'][$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['valor'], true, false);
            $recordset['items'][$i]['desconto_string'] = CurrencyUtils::getPriceFormat($recordset['items'][$i]['desconto'], true, false);
            $recordset['items'][$i]['valor_final_string'] = CurrencyUtils::getPriceFormat(($recordset['items'][$i]['valor'] - $recordset['items'][$i]['desconto']) , true, false);

            $valor = $valor + ($recordset['items'][$i]['valor'] - $recordset['items'][$i]['desconto']);
 
        }}
        
        $recordset['total'] = $valor;
        
        return $recordset;
 
    }
    
    /**
     * Método para retornar formatado para invoice
     * 
     * @param array
     *
    */
    public static function organizeHostToInvoice($recordset2){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.MonthUtils'); 
        
        $valor = 0; $p = 1;
        $recordset = json_decode($recordset2, true);
        
        $total = count($recordset);
        if($recordset['dados']){
            
            $recordset['items'][0]['titulo'] = 'Hospedagem - ' . MonthUtils::getMonth(date('n')) . '/'.date('Y');
            $recordset['items'][0]['date_string'] = DateTimeUtils::getDateFormateNoTime(date("Y-m-d H:i:s"));
            $recordset['items'][0]['data_referente'] = MonthUtils::getMonth(date("n"));
            $recordset['items'][0]['valor_string'] = CurrencyUtils::getPriceFormat($recordset['dados']['valor'], true, false);
            $recordset['items'][0]['desconto_string'] = CurrencyUtils::getPriceFormat(0, true, false);
            $recordset['items'][0]['valor_final_string'] = CurrencyUtils::getPriceFormat(($recordset['dados']['valor']) , true, false);
            $recordset['items'][0]['valor'] = $recordset['dados']['valor'];
            $recordset['items'][0]['id'] = $recordset['dados']['id'];

            $valor = $valor + $recordset['dados']['valor'];            
                    
        }
        
        if(isset($recordset['integrados']) && count($recordset['integrados']) > 0){
            foreach ($recordset['integrados'] as $values){
                $recordset['items'][$p]['titulo'] = 'Hospedagem - ' . MonthUtils::getMonth(date('n')) . '/'.date('Y') . " - " . $values['dominio'];
                $recordset['items'][$p]['date_string'] = DateTimeUtils::getDateFormateNoTime(date("Y-m-d H:i:s"));
                $recordset['items'][$p]['data_referente'] = MonthUtils::getMonth(date("n"));
                $recordset['items'][$p]['valor_string'] = CurrencyUtils::getPriceFormat($values['valor'], true, false);
                $recordset['items'][$p]['desconto_string'] = CurrencyUtils::getPriceFormat(0, true, false);
                $recordset['items'][$p]['valor_final_string'] = CurrencyUtils::getPriceFormat(($values['valor']) , true, false);
                $recordset['items'][$p]['valor'] = $values['valor'];
                $recordset['items'][$p]['id'] = $values['id'];

                $valor = $valor + $values['valor'];
                $p++;
            }
                    
        }
        
        $recordset['total'] = $valor;
        
        return $recordset;
 
    }
    
    /**
     * Returns the values from the calcules between price, parcels
     * See bellow the results
     * 
     * @param array
     *
     */
    public static function calculatePierMail($piermail, $month){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        $email_qtd = 0;

        //SUM
        if($piermail['items'] && count($piermail['items']) > 0){
            foreach($piermail['items'] as $values){
               if(isset($values['nr_parcelas'])) $email_qtd = $email_qtd + $values['nr_parcelas'];
            }            
        }
        
        $qtd_uni = ceil($email_qtd / 1000);
        $result['dolar'] = floatval(3.10);
        $result['total'] = $qtd_uni * $result['dolar'];
        
        //Strings
        $result['dolar_string'] = CurrencyUtils::getPriceFormat($result['dolar'], true, false);
        $result['valor'] = CurrencyUtils::getPriceFormat($result['total'], true, false); 
        $result['titulo'] = 'Disparos de e-mails';
       
        $result['qtd'] = $email_qtd;
        $result['date'] = $month;       
        
        return $result;
    }
}
    
?>
