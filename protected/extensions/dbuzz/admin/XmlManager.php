<?php
/*
 * This Class is used to deal with XML files
 *
 * @author CarlosGarcia
 *
 * Date: 13/05/2008
 *
 */

class XmlManager{

    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed.
     *
    */
    public function updateMateriasRSS(){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, subtitulo, data, titulo, container_1, last_update";
        $sql = "SELECT $select FROM conteudo_materias";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            // Variavel que armazena o numero de loops
            $dados = HelperUtils::getTitleSite();
            
            $xml = new DOMDocument("1.0", "UTF-8");
            
            //Add RSS elements
            $rss = $xml->createElement('rss');           
            
            // We now add a new attribute to the rss element.  We name this new 
            // attribute version and give it a value of 0.91.
            $rss->setAttribute('version', 0.91);
            $xml->appendChild($rss);

            $root = $xml->createElement("channel");
            $rss->appendChild($root);
            
            $titleMain   = $xml->createElement("title");
            $titleMainText = $xml->createTextNode($dados['titulo']);
            $titleMain->appendChild($titleMainText);
            
            $descMain   = $xml->createElement("description");
            $descMainText = $xml->createTextNode($dados['descricao']);
            $descMain->appendChild($descMainText);
            
            $linkMain   = $xml->createElement("link");
            $linkMainText = $xml->createTextNode("http://www.". Yii::app()->params['userName'] .".com.br");
            $linkMain->appendChild($linkMainText);
            
            $copyRight   = $xml->createElement("copyright");
            $copyRightText = $xml->createTextNode("Copyright (C) 2010". Yii::app()->params['userName'] .".com.br");
            $copyRight->appendChild($copyRightText);
            
            $root->appendChild($titleMain);
            $root->appendChild($descMain);
            $root->appendChild($linkMain);
            $root->appendChild($copyRight);
            
            for($i = 0; $i < count($recordset); $i++){
               
                $idText = $xml->createTextNode($i);

                $title   = $xml->createElement("title");
                $titleText = $xml->createTextNode($recordset[$i]['titulo']);
                $title->appendChild($titleText);
                
                $desc   = $xml->createElement("description");
                $descText = $xml->createTextNode($recordset[$i]['subtitulo']);
                $desc->appendChild($descText);
                
                $date = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                
                $pubdate   = $xml->createElement("pubDate");
                $pubdateText = $xml->createTextNode($date);
                $pubdate->appendChild($pubdateText);
                
                if($recordset[$i]['container_1'] != null || $recordset[$i]['container_1'] != ""){
                        
                    $type = explode("_", $recordset[$i]['container_1']);
                    $recordset[$i]['slot_type'] = $type[0];                       
                    $recordset[$i]['picture'] = '';

                    if($type[0] == "b"){
                        $recordset[$i]['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                    }else if($type[0] == "f"){
                        $recordset[$i]['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                        $recordset[$i]['picture'] =  "http://". $_SERVER['SERVER_NAME'] . "/media/user/images/original/" . $recordset[$i]['container_1']['foto'];
                    }else if($type[0] == "e"){
                        $recordset[$i]['container'] = GraphicsHelperUtils::getEmbededImages($type[1]);
                        $recordset[$i]['picture'] =  "";                            
                    }else{
                        //$recordset[$i]['container_1'] = GraphicsHelperUtils::getHtml($type[1]);
                    }

                }else{
                    $recordset[$i]['slot_type'] = "";
                    $recordset[$i]['picture'] = "";
                }
                
                $thumbnail   = $xml->createElement("thumbnail");
                $thumbnailText = $xml->createTextNode($recordset[$i]['picture']);
                $thumbnail->appendChild($thumbnailText);
                
                $link   = $xml->createElement("link");
                $linkText = $xml->createTextNode("http://" . $_SERVER['SERVER_NAME'] . "/noticias/listar/" . $recordset[$i]['id']);
                $link->appendChild($linkText);

                $item = $xml->createElement("item");

                $item->appendChild($title);
                $item->appendChild($pubdate);
                $item->appendChild($desc);
                $item->appendChild($thumbnail);
                $item->appendChild($link);

                $root->appendChild($item);
            }

            $xml->formatOutput = true;
            //echo "<xmp>". $xml->saveXML() ."</xmp>";

            $xml->save("media/user/rss/blog.xml") or die("Error");
           

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XMLManager - updateMateriasRSS() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed.
     *
    */
    public function updateEventosRSS(){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, titulo, container_1, descricao, subtitulo, last_update";
        $sql = "SELECT $select FROM eventos_data";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            // Variavel que armazena o numero de loops
            $dados = HelperUtils::getTitleSite();
            
            $xml = new DOMDocument("1.0", "UTF-8");
            
            //Add RSS elements
            $rss = $xml->createElement('rss');           
            
            // We now add a new attribute to the rss element.  We name this new 
            // attribute version and give it a value of 0.91.
            $rss->setAttribute('version', 0.91);
            $xml->appendChild($rss);

            $root = $xml->createElement("channel");
            $rss->appendChild($root);
            
            $titleMain   = $xml->createElement("title");
            $titleMainText = $xml->createTextNode($dados['titulo']);
            $titleMain->appendChild($titleMainText);
            
            $descMain   = $xml->createElement("description");
            $descMainText = $xml->createTextNode($dados['descricao']);
            $descMain->appendChild($descMainText);
            
            $linkMain   = $xml->createElement("link");
            $linkMainText = $xml->createTextNode("http://www.". Yii::app()->params['userName'] .".com.br");
            $linkMain->appendChild($linkMainText);
            
            $copyRight   = $xml->createElement("copyright");
            $copyRightText = $xml->createTextNode("Copyright (C) 2010". Yii::app()->params['userName'] .".com.br");
            $copyRight->appendChild($copyRightText);
            
            $root->appendChild($titleMain);
            $root->appendChild($descMain);
            $root->appendChild($linkMain);
            $root->appendChild($copyRight);
            
            for($i = 0; $i < count($recordset); $i++){
               
                $idText = $xml->createTextNode($i);

                $title   = $xml->createElement("title");
                $titleText = $xml->createTextNode($recordset[$i]['titulo']);
                $title->appendChild($titleText);
                
                $desc   = $xml->createElement("description");
                $descText = $xml->createTextNode($recordset[$i]['subtitulo']);
                $desc->appendChild($descText);
                
                $date = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                
                $pubdate   = $xml->createElement("pubDate");
                $pubdateText = $xml->createTextNode($date);
                $pubdate->appendChild($pubdateText);
                
                if($recordset[$i]['container_1'] != null || $recordset[$i]['container_1'] != ""){
                        
                    $type = explode("_", $recordset[$i]['container_1']);
                    $recordset[$i]['slot_type'] = $type[0];                       
                    $recordset[$i]['picture'] = '';

                    if($type[0] == "b"){
                        $recordset[$i]['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                    }else if($type[0] == "f"){
                        $recordset[$i]['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                        $recordset[$i]['picture'] =  "http://". $_SERVER['SERVER_NAME'] . "/media/user/images/original/" . $recordset[$i]['container_1']['foto'];
                    }else if($type[0] == "e"){
                        $recordset[$i]['container'] = GraphicsHelperUtils::getEmbededImages($type[1]);
                        $recordset[$i]['picture'] =  "";                            
                    }else{
                        //$recordset[$i]['container_1'] = GraphicsHelperUtils::getHtml($type[1]);
                    }

                }else{
                    $recordset[$i]['slot_type'] = "";
                    $recordset[$i]['picture'] = "";
                }
                
                $thumbnail   = $xml->createElement("thumbnail");
                $thumbnailText = $xml->createTextNode($recordset[$i]['picture']);
                $thumbnail->appendChild($thumbnailText);
                
                $link   = $xml->createElement("link");
                $linkText = $xml->createTextNode("http://" . $_SERVER['SERVER_NAME'] . "/eventos/listar/" . $recordset[$i]['id']);
                $link->appendChild($linkText);

                $item = $xml->createElement("item");

                $item->appendChild($title);
                $item->appendChild($pubdate);
                $item->appendChild($desc);
                $item->appendChild($thumbnail);
                $item->appendChild($link);

                $root->appendChild($item);
            }

            $xml->formatOutput = true;
            //echo "<xmp>". $xml->saveXML() ."</xmp>";

            $xml->save("media/user/rss/eventos.xml") or die("Error");
           

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XMLManager - updateEventosRSS() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed.
     *
    */
    public function updateProdutosRSS(){
        
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, nome, slot1, descricao, descricao_resumo, last_update";
        $sql = "SELECT $select FROM ecommerce_produtos WHERE exibe_produtos = 1 OR exibe_ecommerce = 1";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll(); 
            
            // Variavel que armazena o numero de loops
            $dados = HelperUtils::getTitleSite();
            
            $xml = new DOMDocument("1.0", "UTF-8");
            
            //Add RSS elements
            $rss = $xml->createElement('rss');           
            
            // We now add a new attribute to the rss element.  We name this new 
            // attribute version and give it a value of 0.91.
            $rss->setAttribute('version', 0.91);
            $xml->appendChild($rss);

            $root = $xml->createElement("channel");
            $rss->appendChild($root);
            
            $titleMain   = $xml->createElement("title");
            $titleMainText = $xml->createTextNode($dados['titulo']);
            $titleMain->appendChild($titleMainText);
            
            $descMain   = $xml->createElement("description");
            $descMainText = $xml->createTextNode($dados['descricao']);
            $descMain->appendChild($descMainText);
            
            $linkMain   = $xml->createElement("link");
            $linkMainText = $xml->createTextNode("http://www.". Yii::app()->params['userName'] .".com.br");
            $linkMain->appendChild($linkMainText);
            
            $copyRight   = $xml->createElement("copyright");
            $copyRightText = $xml->createTextNode("Copyright (C) 2010". Yii::app()->params['userName'] .".com.br");
            $copyRight->appendChild($copyRightText);
            
            $root->appendChild($titleMain);
            $root->appendChild($descMain);
            $root->appendChild($linkMain);
            $root->appendChild($copyRight);
            
            for($i = 0; $i < count($recordset); $i++){
               
                $idText = $xml->createTextNode($i);

                $title   = $xml->createElement("title");
                $titleText = $xml->createTextNode($recordset[$i]['nome']);
                $title->appendChild($titleText);
                
                $desc   = $xml->createElement("description");
                $descText = $xml->createTextNode($recordset[$i]['descricao_resumo']);
                $desc->appendChild($descText);
                
                $date = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                
                $pubdate   = $xml->createElement("pubDate");
                $pubdateText = $xml->createTextNode($date);
                $pubdate->appendChild($pubdateText);
                
                if($recordset[$i]['slot1'] != null && $recordset[$i]['slot1'] != "" && $recordset[$i]['slot1'] != 0){
                        
                    $type = explode("_", $recordset[$i]['slot1']);
                    $recordset[$i]['slot_type'] = $type[0];                       
                    $recordset[$i]['picture'] = '';

                    if($type[0] == "b"){
                        $recordset[$i]['slot1'] = GraphicsHelperUtils::getBanner($type[1]);
                    }else if($type[0] == "f"){
                        $recordset[$i]['slot1'] = GraphicsHelperUtils::getPhotos($type[1]);
                        $recordset[$i]['picture'] =  "http://". $_SERVER['SERVER_NAME'] . "/media/user/images/original/" . $recordset[$i]['slot1']['foto'];
                    }else if($type[0] == "e"){
                        $recordset[$i]['container'] = GraphicsHelperUtils::getEmbededImages($type[1]);
                        $recordset[$i]['picture'] =  "";                            
                    }else{
                        //$recordset[$i]['container_1'] = GraphicsHelperUtils::getHtml($type[1]);
                    }

                }else{
                    $recordset[$i]['slot_type'] = "";
                    $recordset[$i]['picture'] = "";
                }
                
                $thumbnail   = $xml->createElement("thumbnail");
                $thumbnailText = $xml->createTextNode($recordset[$i]['picture']);
                $thumbnail->appendChild($thumbnailText);
                
                $link   = $xml->createElement("link");
                $linkText = $xml->createTextNode("http://" . $_SERVER['SERVER_NAME'] . "/produtos/detalhes/" . $recordset[$i]['id']);
                $link->appendChild($linkText);

                $item = $xml->createElement("item");

                $item->appendChild($title);
                $item->appendChild($pubdate);
                $item->appendChild($desc);
                $item->appendChild($thumbnail);
                $item->appendChild($link);

                $root->appendChild($item);
            }

            $xml->formatOutput = true;
            //echo "<xmp>". $xml->saveXML() ."</xmp>";

            $xml->save("media/user/rss/produtos.xml") or die("Error");
           

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XMLManager - updateProdutosRSS() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed da Publicidade Digital.
     *
    */
    public function updatePublicidadeDigital(){
    
        $select = "id, nome, detalhes, cool, modelo";
        $sql = "SELECT $select FROM banners_data WHERE tipo = 'publicidade_digital' AND exibe = 1";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }

        // Variavel que armazena o numero de loops

        $varURL = "<?xml version='1.0'?>";
        $varURL.= "<publicidades version='2.0'>";

        // Mostrando valores
        for($i = 0; $i < count($recordset); $i++){
            $varURL.= "<publicidade id='$i'>";
            $varURL.= "<title>";
            //$varURL.= $recordset[$i]['nome'];
            $varURL.= "</title>";
            $varURL.= "<desc>";
            $varURL.= "<content>";
            $varURL.= $recordset[$i]['cool'];
            $varURL.= "</content>";
            $varURL.= "<type>";
            $varURL.= $recordset[$i]['modelo'];
            $varURL.= "</type>";
            $varURL.= "<brief>";
            //$varURL.= $recordset[$i]['modelo'];
            $varURL.= "</brief>";
            $varURL.= "<long>";
            //$varURL.= $recordset[$i]['modelo'];
            $varURL.= "</long>";
            $varURL.= "</desc>";
            $varURL.= "</publicidade>";
        }

        $varURL.= "</publicidades>";

        $nome = "publicidade";
        $cria = fopen("media/user/files/".$nome . ".xml", "w+");

        $dados = $varURL;

        if(!file_exists($nome . ".xml")){
        $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
        }

        fclose($cria);
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed de Previsão do tempo.
     *
    */
    public function updateWeatherGoogleAPI($xml){
        
        Yii::import('application.extensions.utils.DateTimeUtils'); 
        
        date_default_timezone_set("Brazil/East");
        $condition = $xml->weather->current_conditions->condition['data'];
        $temp_c = $xml->weather->current_conditions->temp_c['data'];
        $humidity = $xml->weather->current_conditions->humidity['data'];
        $icon = $xml->weather->current_conditions->icon['data'];
        $vento = $xml->weather->current_conditions->wind_condition['data'];

        // Variavel que armazena o numero de loops

        $varURL = "<?xml version='1.0'?>";
        $varURL.= "<weather version='2.0'>";
        
        $varURL.= "<current_day>";
        $varURL.= "<umidade>";
        $varURL.= $humidity;
        $varURL.= "</umidade>";
        $varURL.= "<vento>";
        $varURL.= $vento;
        $varURL.= "</vento>";
        $varURL.= "</current_day>";

        // Mostrando valores
        for ($i = 0; $i < count($xml->weather->forecast_conditions); $i++){
            
            $data = $xml->weather->forecast_conditions[$i];
            
            $varURL.= "<day id='$i'>";
            $varURL.= "<low>";
            $varURL.= $data->low['data'];
            $varURL.= "</low>";
            $varURL.= "<high>";
            $varURL.= $data->high['data'];
            $varURL.= "</high>";            
            $varURL.= "<day_week>";
            $varURL.= utf8_decode($data->day_of_week['data']);
            $varURL.= "</day_week>";
            $varURL.= "<date>";
            $varURL.= (date('d') + $i) . "/". date('m');
            $varURL.= "</date>";
            $varURL.= "<condition>";
            $varURL.= $data->condition['data'];
            $varURL.= "</condition>";
            $varURL.= "<icon>";
            $varURL.= DateTimeUtils::getPictureWeather($data->condition['data']);
            $varURL.= "</icon>";
            $varURL.= "<long>";
            //$varURL.= $recordset[$i]['modelo'];
            $varURL.= "</long>";
           
            $varURL.= "</day>";
            
            
        }

        $varURL.= "</weather>";

        $nome = "weather";
        $cria = fopen("media/user/files/".$nome . ".xml", "w+");

        $dados = $varURL;

        if(!file_exists($nome . ".xml")){
        $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
        }

        fclose($cria);
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed de cotação.
     *
    */
    public function updateCotacaoUOl($xml){
        
        Yii::import('application.extensions.utils.DateTimeUtils'); 
        
        date_default_timezone_set("Brazil/East");
         

        // Variavel que armazena o numero de loops

        $varURL = "<?xml version='1.0'?>";
        $varURL.= "<cotacao version='2.0'>";
        
        $varURL.= "<currency>";
        $varURL.= "<tipo>";
        $varURL.= $xml[0]->tipo;;
        $varURL.= "</tipo>";
        $varURL.= "</currency>";

        $varURL.= "</cotacao>";

        $nome = "cotacao";
        $cria = fopen("media/user/files/".$nome . ".xml", "w+");

        $dados = $varURL;

        if(!file_exists($nome . ".xml")){
        $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
        }

        fclose($cria);
    }
    
    /**
     * Método para criar ou editar um XML
     * Neste caso esse método cria um arquivo XML para
     * ser lido como feed de cotação.
     *
    */
    public function updateSiteMap(){
        
         
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.site.produtos.EcommerceManager');
        
        $session = MethodUtils::getSessionData();
        
        $paginasHandler = new PaginasManager();
        $produtosHandler = new EcommerceManager();
        
        $result['paginas'] = $paginasHandler->getPagesInfoEdit($session);
        $result['produtos'] = $produtosHandler->getAllContent(false, 'produto');
        
        date_default_timezone_set("Brazil/East");                

        $varURL = "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";
        
        //Paginas
        foreach($result['paginas'] as $values){
            $varURL.= "<url>";

            $varURL.= "<loc>";
            $varURL.=  'http://' . $_SERVER['SERVER_NAME'] . '/'. $values['nome'];
            $varURL.= "</loc>";

            $varURL.= "<changefreq>";
            $varURL.= 'weekly';
            $varURL.= "</changefreq>";

            $varURL.= "<priority>";
            $varURL.= '0.7';
            $varURL.= "</priority>";

            $varURL.= "</url>";
        }
        
        //Paginas
        if($result['produtos']){
        foreach($result['produtos'] as $values){
            $varURL.= "<url>";

            $varURL.= "<loc>";
            if(Yii::app()->params['ramo'] == 'ecommerce') $varURL.=  'http://' . $_SERVER['SERVER_NAME'] . '/loja/'. $values['url'];
            if(Yii::app()->params['ramo'] == 'common')    $varURL.=  'http://' . $_SERVER['SERVER_NAME'] . '/produtos/detalhes/'. $values['url'];
            if(Yii::app()->params['ramo'] == 'educacao')  $varURL.=  'http://' . $_SERVER['SERVER_NAME'] . '/loja/'. $values['url'];
            $varURL.= "</loc>";

            $varURL.= "<changefreq>";
            $varURL.= 'weekly';
            $varURL.= "</changefreq>";

            $varURL.= "<priority>";
            $varURL.= '0.8';
            $varURL.= "</priority>";

            $varURL.= "</url>";
        }}

        try{
   
            
            $xml = new DOMDocument("1.0", "UTF-8");
            
            //Add RSS elements
            $sitemap = $xml->createElement('urlset');           
            
            // We now add a new attribute to the rss element.  We name this new 
            // attribute version and give it a value of 0.91.
            $sitemap->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
            $xml->appendChild($sitemap);
 
            
            foreach($result['paginas'] as $values){
               
                $loc   = $xml->createElement("loc");
                $locText = $xml->createTextNode('http://' . $_SERVER['SERVER_NAME'] . '/'.$values['nome']);
                $loc->appendChild($locText);
                
                $changefreq   = $xml->createElement("changefreq");
                $changefreqText = $xml->createTextNode('weekly');
                $changefreq->appendChild($changefreqText);
              
                $priority   = $xml->createElement("priority");
                $priorityText = $xml->createTextNode(0.7);
                $priority->appendChild($priorityText);

                $item = $xml->createElement("url");

                $item->appendChild($loc);
                $item->appendChild($changefreq);
                $item->appendChild($priority);

                $sitemap->appendChild($item);
            }
            
            foreach($result['produtos'] as $values){
               
                $loc   = $xml->createElement("loc");
                if(Yii::app()->params['ramo'] == 'ecommerce') $locText = $xml->createTextNode('http://' . $_SERVER['SERVER_NAME'] . '/loja/'. $values['url']);
                if(Yii::app()->params['ramo'] == 'common')    $locText = $xml->createTextNode('http://' . $_SERVER['SERVER_NAME'] . '/produtos/detalhes/'. $values['url']);
                if(Yii::app()->params['ramo'] == 'associacao')    $locText = $xml->createTextNode('http://' . $_SERVER['SERVER_NAME'] . '/produtos/detalhes/'. $values['url']);
                if(Yii::app()->params['ramo'] == 'educacao')  $locText = $xml->createTextNode('http://' . $_SERVER['SERVER_NAME'] . '/loja/'. $values['url']);
                $loc->appendChild($locText);
                
                $changefreq   = $xml->createElement("changefreq");
                $changefreqText = $xml->createTextNode('weekly');
                $changefreq->appendChild($changefreqText);
              
                $priority   = $xml->createElement("priority");
                $priorityText = $xml->createTextNode(0.7);
                $priority->appendChild($priorityText);

                $item = $xml->createElement("url");

                $item->appendChild($loc);
                $item->appendChild($changefreq);
                $item->appendChild($priority);

                $sitemap->appendChild($item);
            }

            $xml->formatOutput = true;

            $xml->save("sitemap.xml") or die("Error");
           

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: XMLManager - updateSiteMap() ' . $e->getMessage();
        }
    }
    
    
 
}
?>