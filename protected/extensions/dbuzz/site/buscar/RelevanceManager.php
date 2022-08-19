<?php
/*
 * This Class is used to controll all functions related the feature Relevance
 * content, in the future it needs using micro data to improve the performance
 * for search engines. 
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 * It is used to seek combinations between keywords
 * 
 * Data: 19/08/2011
 *
 */

class RelevanceManager {

    /**
     * Método para recuperar o conteúdo recomendado de uma determinado
     * conjunto de palvras-chaves
     *
     * @param string
     * @param number
     *
    */
    public function getAllArticlesRecommended($id, $keywords, $tipo, $nr_needed = 4){

        Yii::import('application.extensions.dbuzz.admin.MateriasManager');
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');   
        
        if($nr_needed == "") $nr_needed = 4;
        $select = "id, id_categoria, titulo, subtitulo, keywords, data, container_1, url";
        $sql = "SELECT ". $select ." FROM conteudo_materias WHERE tipo = '$tipo' AND MATCH (keywords) AGAINST ('". $keywords . "' IN BOOLEAN MODE) AND id != $id ORDER BY id DESC LIMIT $nr_needed";
        if($keywords == 'todos') $sql = "SELECT ". $select ." FROM conteudo_materias WHERE tipo = '$tipo' AND id != $id ORDER BY id DESC LIMIT $nr_needed";

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            $totalMateriais =  DataBaseUtils::getCountRecords('conteudo_materias', 'tipo', 'noticias');
            
            //Get some complementary items
            if ($totalMateriais > $nr_needed && count($recordset) < $nr_needed) {
                $materiasHandler = new MateriasManager();
                $count_articles = count($recordset);
                $needed = $nr_needed - $count_articles;
                $ids_selected = $this->organizeIdSelected($recordset, $id);
                $new_articles = $materiasHandler->getLastContentLimited($needed, $ids_selected, $tipo);
                
                $p = 0;
                //It blends the found items with the first one
                for($i = $count_articles; $i < $nr_needed; $i++){
                    //Caso não exista muitos banners cadastrados
                    if($p <= count($new_articles)){
                        $recordset[$i] = $new_articles[$p];
                    }
                    $p++; 
                } 
            }
            
            //Formats the items with the specifics masks
            for($z = 0; $z < count($recordset); $z++){
                $recordset[$z]['data'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$z]['data']);

                if($recordset[$z]['container_1'] != null || $recordset[$z]['container_1'] != ""){

                    $type = explode("_", $recordset[$z]['container_1']);
                    $recordset[$z]['slot_type'] = $type[0];                    

                    if($type[0] == "b"){
                        $recordset[$z]['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                    }else if($type[0] == "f"){
                        $recordset[$z]['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                    }else if($type[0] == "e"){
                        $recordset[$z]['container_1'] = GraphicsHelperUtils::getEmbededImages($type[1]);
                    }else{
                        //$recordset[$z]['container_1'] = GraphicsHelperUtils::getHtml($type[1]);
                    }

                }else{
                    $recordset[$z]['slot_type'] = "";
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: RelevanceManager - getAllArticlesRecommended() ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os banner recomendados de uma determinado
     * conjunto de palavras-chaves.
     * 
     * PS: Step são os tipos de banner que devem ser puxados caso não encontre os $tipo
     * PS: Os $tipo são ums sql line do tipo = html_lonsdale AND tipo = html_mini
     * 
     * $isActionServer = true: Pega as keywords do activity_server table
     *
     * @param number
     * @param string
     *
    */
    public function getAllBannersRecommended($id, $keywords, $tipo, $step, $nr_needed = 4, $isActionServer = true, $isExibe = ' AND exibe = 1 '){

        Yii::import('application.extensions.dbuzz.admin.BannersManager');
        Yii::import('application.extensions.utils.BannersUtils');
        
        //Verify if there are some banners loaded previously
        $id_Cookies = MethodUtils::getSessionData();
        $id_s = $id_Cookies['PPBannersIds']; if($id_s == "") $id_s = 0;
        $queued_keywords = MethodUtils::getKeywordsQueued();
        if($nr_needed == "") $nr_needed = 4;
       
        //echo $tipo . $keywords . " " .$queued_keywords . " ids: " . $id_s;
        if($id_Cookies['keywords'] == "" && $isActionServer) $keywords = $keywords . ", " . $queued_keywords;
        
        $select = "id, id_user, exibe, lance, creditos, page_views, altura, largura, link, tipo, keywords, modelo, cool";
        $sql = "SELECT $select FROM banners_data WHERE (MATCH (keywords) AGAINST ('$keywords' IN BOOLEAN MODE) AND id NOT IN ($id_s) $isExibe AND tipo = '$tipo') ORDER BY lance DESC LIMIT $nr_needed";
        if($tipo == "html_lonsdale") $sql = "SELECT $select FROM banners_data WHERE (MATCH (keywords) AGAINST ('$keywords' IN BOOLEAN MODE) $isExibe AND tipo = '$tipo') AND id NOT IN ($id_s) ORDER BY lance DESC LIMIT 1";

        try{  
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                $ct_recordset = count($recordset);
                
                for($f = 0; $f < $ct_recordset; $f++){
                    $recordset[$f]['cool2'] = BannersUtils::getBannersItems($recordset[$f]['id']);
                }
            }
            
            if(count($recordset) < $nr_needed){ 
                
                $htmlBannerHandler = new BannersManager(); 
                $count_banners = count($recordset);
                $needed = $nr_needed - $count_banners;
   
                $ids_selected = $this->organizeIdSelected($recordset, $id);
                $new_banners = $htmlBannerHandler->getLastContentLimited($needed, $ids_selected, $step, $isExibe);
                
                $p = 0;                
                for($i = $count_banners; $i < $nr_needed; $i++){
                    //Caso não exista muitos banners cadastrados
                    if($p < count($new_banners)){
                        
                        if($i < $nr_needed){
                            $recordset[$i] = $new_banners[$p];
                        }
                    }
                    $p++;
                }               
            } 
            
            for($i = 0; $i < count($recordset); $i++){
                $controllerBanner = BannersUtils::setPageViews($recordset[$i]['id'], $recordset[$i]['lance'], $recordset[$i]['creditos'], $recordset[$i]['page_views']);
            }
            
            $define_ids_selected = $this->organizeIdSelected($recordset, 0);
            
            //Prepares some ids to be saved as a cookie, it avoid repetitions on banners loaders            
            $ids_on_stage = $define_ids_selected;
            //if($id_Cookies["PPBannersIds"] != "" && $id_Cookies["PPBannersIds"] != $ids_on_stage) $ids_on_stage = $id_Cookies["PPBannersIds"] . "' AND id !='" .$define_ids_selected;
            MethodUtils::setSessionData("PPBannersIds", $ids_on_stage);
            MethodUtils::setSessionData('keywords', $keywords); 
            
            //$recordset['cookie'] = $id_Cookies['PPBannersIds'];            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR : RelevanceManager - getAllBannersRecommended() ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os banner recomendados de uma determinado
     * conjunto de palavras-chaves.
     * 
     * PS: Step são os tipos de banner que devem ser puxados caso não encontre os $tipo
     * PS: Os $tipo são ums sql line do tipo = html_lonsdale AND tipo = html_mini
     * 
     * $isActionServer = true: Pega as keywords do activity_server table
     *
     * @param number
     * @param string
     *
    */
    public function getAllRenderBanners($id, $tipo, $step, $nr_needed, $isActionServer = true){

        Yii::import('application.extensions.dbuzz.admin.BannersManager');
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, id_user, exibe, lance, creditos, page_views, altura, largura, link, tipo, keywords, cool, titulo, descricao";

        $sql = "SELECT ". $select ." FROM banners_data WHERE tipo = '$tipo' ORDER BY RAND() LIMIT $nr_needed";
        
        try{  
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                $ct_recordset = count($recordset);
                for($f = 0; $f < $ct_recordset; $f++){
                    
                    $recordset[$f]['cool3'] = BannersUtils::getBannersItems($recordset[$f]['id'], false, true);
                }
            }
           
            
            for($i = 0; $i < count($recordset); $i++){
                $controllerBanner = BannersUtils::setPageViews($recordset[$i]['id'], $recordset[$i]['lance'], $recordset[$i]['creditos'], $recordset[$i]['page_views']);
            } 
                
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR : RelevanceManager - getAllRenderBanners() ".$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os produtos recomendados de uma determinado
     * conjunto de palavras-chaves.
     * 
     *
     * @param number
     * @param string
     *
    */
    public function getAllProductsRecommended($id, $field, $tipo, $nr_needed = 4){
        
        Yii::import('application.extensions.utils.ProdutosUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        if($nr_needed == '' || $nr_needed == NULL) $nr_needed = 4;

        $select = "id, id_categoria, descricao, descricao_resumo, date_start, date_end, nome, preco_real, cidade, " .
                  "pais, parcelas, unidades_current, marca, data, tipo, lancamento, promocao, url";
        $sql = "SELECT ".$select." FROM ecommerce_produtos WHERE $field = 1 ORDER BY RAND() LIMIT $nr_needed";
        
        if(Yii::app()->params['ramo'] == "ecommerce"){
        $select = "A.id, A.id_categoria, A.descricao, A.descricao_resumo, A.date_start, A.date_end, A.nome, A.preco_real, A.cidade, A.frete_gratis, " .
                  "A.pais, A.parcelas, A.unidades_current, A.marca, A.data, A.tipo, A.lancamento, A.promocao, A.url, B.id_produto, B.id AS id_estoque";
        $sql = "SELECT * FROM (SELECT ".$select." FROM ecommerce_produtos AS A INNER JOIN ecommerce_estoque as B ON A.id = B.id_produto WHERE A.id != $id AND A.$field = 1 AND B.qtd > 0 ORDER BY B.n_index ASC LIMIT $nr_needed) AS T GROUP BY id_produto ORDER BY RAND() ";
        }

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            $type_price = ProdutosUtils::checkKindOfPrice();
            
            for($i = 0; $i < count($recordset); $i++){  
                $recordset[$i]['preco_real_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['preco_real'], true, $type_price);
                $recordset[$i]['promocao'] = CurrencyUtils::getPriceFormat($recordset[$i]['promocao'], true, $type_price);
                $recordset[$i]['date_start'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_start']);
                $recordset[$i]['date_end'] = DateTimeUtils::getDateFormateNoTime($recordset[$i]['date_end']);
                $recordset[$i]['tipo'] = ProdutosUtils::getCategoryContent($recordset[$i]['id_categoria']);
                $recordset[$i]['valores'] = ProdutosUtils::getCalculatesValues($recordset[$i]['preco_real'], $recordset[$i]['parcelas'], 0);                                 
                $recordset[$i]['valores']['parcel'] = CurrencyUtils::getPriceFormat($recordset[$i]['valores']['parcel'], true, $type_price);
                (isset($recordset[$i]['id_estoque'])) ? $recordset[$i]['id_variante'] = $recordset[$i]['id_estoque'] : $recordset[$i]['id_variante'] = 0;
                
                if(Yii::app()->params['ramo'] == "ecommerce"){
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id'], $recordset[$i]['id_variante']);
                }else{
                    $fotos = ProdutosUtils::getProdutoImageAttribute($recordset[$i]['id']);
                }   
                
                for ($f = 0; $f < 6; $f++){                                     
                    $recordset[$i]['image_' . $f] = $fotos[$f];                   
                }             
            }          
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: RelevanceManager - getAllProductsRecommended() ".$e->getMessage();
        }
    }
    
    /*
     * Organize
     * This method splits the ids select and organize it in a
     * string, that will be used to avoid some duplicated records
     * when it'll get the last records
     * 
     * @param array
     * 
     */
    public function organizeIdSelected($ids_selected, $id){
        
        if($id != '') {
            $ids_string = $id . ",";        
        }else{
            $ids_string = "0";
        }
        
        $last_item = end($ids_selected);
        
        if(count($ids_selected) > 0){
            foreach($ids_selected as $values){
                //If is the last item, it doesn't put a comma
                if ($values != $last_item) {                
                    $ids_string .= $values['id'] . ",";                
                }else{                
                    $ids_string .= $values['id'];
                } 
            }
        }
        return $ids_string;
    }

}

?>