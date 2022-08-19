<?php

/*
 * This Class is used to controll all functions related the feature MarketPlaces
 *
 * @author CarlosGarcia
 *
 * Date: 13/10/2016
 *
 */

class MarketPlacesManager {
    
    /**
     * Método para publicar um produto em um MarketPlace
     *
    */
    public function publicarProduto($data = array(), $marketplace){
       
        Yii::import('application.extensions.utils.marketplaces.CnovaUtils');
        Yii::import('application.extensions.utils.marketplaces.B2WUtils');
        
        
        $result = false;

        try{          
            if($marketplace == C::SUBMARINO) $result = CnovaUtils::publicar($data);
            if($marketplace == C::EXTRA) $result = B2WUtils::publicar($data);
            
            return $result;     

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            MethodUtils::sendError(array('message' => 'ERROR: MarketPlacesManager - publicarProduto()', 'trace' => $e->getMessage()), true);
            echo "ERROR: MarketPlacesManager - publicarProduto() ". $e->getMessage();            
        }
    }
    
}


?>