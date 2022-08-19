<?php
/*
 * This Class is used to controll all functions related the feature topos and rodapes
 *
 * @author CarlosGarcia
 *
 * Date: 14/12/2010
 *
 */

class ExtremosManager {

    /**
     * Metodo para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContent($id, $is_advanced = false) {
        
        Yii::import('application.extensions.utils.BannersUtils');

        $select = "id, modelo, tipo, cor, cool, altura, largura, detalhes, exibe, link, link_modo, titulo, descricao, lance, creditos, page_views";
        $sql = "SELECT $select FROM banners_data WHERE id= $id ";

        try{           
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset){
                $attributes = BannersUtils::getHtmlBannerProperties($recordset['tipo']);

                $recordset['largura_slot'] = $recordset['largura'] / $attributes['resize_slot'];
                $recordset['altura_slot'] = $recordset['altura'] / $attributes['resize_slot'];
                
                $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id'], false, $is_advanced);
               
            }
            
            return $recordset;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Metodo para atualizar um registro existente
     *
     * It sets the a new header into preferences table
     * The get_post variable is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateContent($get_post) {

        if($get_post['local'] == "topos"){
            $values = "topo = '" . $get_post[0]."'";
        } else {
            $values = "rodape = '" . $get_post[0]."'";
        }

        $sql =  "UPDATE preferencias_data SET ". $values ."";

        try{
            $comando = Yii::app() -> db -> createCommand($sql);
            $control = $comando -> execute();
            echo $get_post['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os registros
     * da tabela banners_data separados por categoria.
     *
     *
    */
    public function getPaginationContent($tipo, $resize, $resize_slot){
        
        Yii::import('application.extensions.utils.BannersUtils');

        $select = "id, tipo, modelo, cor, cool, altura, largura, detalhes, exibe";
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = '" . $tipo. "' ORDER BY id DESC LIMIT 0, 10";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){

                $recordset[$i]['largura'] = $recordset[$i]['largura'] / $resize;
                $recordset[$i]['altura'] = $recordset[$i]['altura'] / $resize;
                
                $recordset[$i]['largura_slot'] = $recordset[$i]['largura'] / $resize_slot;
                $recordset[$i]['altura_slot'] = $recordset[$i]['altura'] / $resize_slot;
                
                $recordset[$i]['cool2'] = BannersUtils::getBannersItems($recordset[$i]['id']);

            }            
            
            $recordset['records'] = $this->getRows($tipo);            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar os clicks do banner
     *
     * Adds a click into banner
     *
     * @param array
     *
    */
    public function updateClickBanner($get_post){        

        try{            
            $select = "id, clicks, creditos, lance, valor_max, debito_dia";
            $sql2 = "SELECT ".$select." FROM banners_data WHERE id = " . $get_post['id']. "";
        
            $command = Yii::app()->db->createCommand($sql2);
            $recordset = $command->queryRow();
            
            $click = $recordset['clicks'] + 1;
            $creditos = $recordset['creditos'] - $recordset['lance'];
            if($creditos < 0) $creditos = 0;
            
            $debitos = $recordset['debito_dia'] + $recordset['lance'];
            
            if($debitos >= $recordset['valor_max']){$exibe = 0;}else{$exibe = 1;};
            
            $values = "clicks = '" . $click ."', creditos = '" . $creditos ."', debito_dia = '" . $debitos ."', exibe = '".$exibe."'";     
            $sql =  "UPDATE banners_data SET ". $values ." WHERE id = ". $get_post['id'] . "";
            
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando -> execute();
            echo "ok";

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar a quantidade de linhas de uma tabela
     * conteudo_cool
     *
     * @param number
     *
    */
    public function getRows($tipo){

        $nr = 0;
        $select = ' id ';

        if($tipo != "todas"){
            $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM banners_data WHERE tipo ='$tipo'")->queryScalar();
        } else {
            $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM banners_data")->queryScalar();
        }

        if($sqlRows > 11) $nr = ($sqlRows) / 10;
        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){

            if ($arredonda[1]>2){
                $nr = ceil($nr);
            } else {
                $nr = round($nr);
            }
        }
        return $nr;
    }
}
?>