<?php

/**
 * Description of BannersUtils
 *
 * Here are some method to make easier the class banners
 *
 * @author CarlosGarcia
 */
class BannersUtils{
    
    /**
     * Método para setar as propriedas Banners
     * referentes aos page views
     *
     * @param number
     *
    */
    public static function setPageViews($id, $lance, $creditos, $page_views){
        
        $new_pageView = $page_views + 1;
        $new_credits = $creditos - $lance;
        
        //echo $creditos . " = " . $lance . " -  ". $new_credits . "/ ";
        if($new_credits <= 0){$new_credits = 0;}
        $values  = "page_views = " . $new_pageView ."";        
        if($new_credits < 0){$values .= ", exibe = 0";}
        
        $sql = "UPDATE banners_data SET ". $values ." WHERE id = ". $id . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();   
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BannerUtils - setPageViews() ". $e->getMessage();
        }
    }
    
    /*
     * Método para 
     *  
     * @param array 
     * 
     */
    public static function runPageViewsSession($value, $id_page){
        
        $session = MethodUtils::getSessionData();
 
        $set = false;
        try{
            if($value && count($value) > 0){
                for($i =0; $i < count($value); $i++){
                    if(isset($value[$i]['info']['id'])) $set = BannersUtils::setPageViews($value[$i]['info']['id'], $value[$i]['info']['lance'], $value[$i]['info']['creditos'], $value[$i]['info']['page_views'] + 1);
                    if(isset($value[$i]['info']['id'])) $value[$i]['info']['page_views'] = $value[$i]['info']['page_views'] + 1;                   
                }
            }
            
            //Set query data into session
            $setSession = MethodUtils::setSessionData('SES_ADS_'.$id_page, $value);

            return $set;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BannerUtils - runPageViewsSession() ". $e->getMessage();
        }
    }

    /**
     * Metodo para pegar as propriedas dos banners
     *
     * @param string
     *
    */
    public static function getBannerProperties($value, $plataforma = 'desktop'){

        $result = array();

        switch ($value){

            //Mini - Stripe: Banner size 200x100 / banner
            case "200":
            case "mini":
            case "htmlmini":
            case "html_mini":
                $result['type'] = "html_mini";
                $result['local'] = "mini";
                $result['base'] = "base.swf";
                $result['template'] = "41";
                $result['resize'] = "1";
                $result['largura'] = "200";
                break;            
            
            //Pequeno - Block: Banner size 250x100
            case "t250":
            case "blocks":
            case "htmlblocks":
            case "html_blocks":
                $result['type'] = "html_blocks";
                $result['local'] = "blocks";
                $result['base'] = "base.swf";
                $result['template'] = "5";
                $result['resize'] = "2";
                $result['largura'] = "250";
                break;
            //Normal - Block: Banner size 320x200
            case "t300":
            case "spark":
            case "htmlspark":
            case "html_spark":
                $result['type'] = "html_spark";
                $result['local'] = "spark";
                $result['base'] = "base7.swf";
                $result['template'] = "4";
                $result['resize'] = "3";
                $result['largura'] = "300";
                break;

            //Normal - Block: Banner size 320x200
            case "t450":
            case "corona":
            case "htmlcorona":
            case "html_corona":
                $result['type'] = "html_corona";
                $result['local'] = "corona";
                $result['base'] = "base7.swf";
                $result['template'] = "6";
                $result['resize'] = "1";
                $result['largura'] = "450";
                break;
            
            //Normal - Block: Banner size 320x200
            case "t720":
            case "lonsdale":
            case "htmllonsdale":
            case "html_lonsdale":
                $result['type'] = "html_lonsdale";
                $result['local'] = "lonsdale";
                $result['base'] = "base7.swf";
                $result['template'] = "42";
                $result['resize'] = "1";
                $result['largura'] = "720";
                break;
            
            //Banner full
            case "980":
            case "banner":
            case "htmlbanners":
            case "html_banners":
                $result['type'] = "html_banners";
                $result['local'] = "banner";
                $result['base'] = "base4.swf";
                $result['template'] = "3";
                $result['resize'] = "4";
                $result['largura'] = "980";
                break;
            
            //Main banner full
            case "980":
            case "mainbanner":
            case "htmlmainbanners":
            case "html_mainbanners":
                if($plataforma == "desktop"){
                $result['type'] = "html_mainbanners";
                $result['local'] = "mainbanner";
                $result['base'] = "base4.swf";
                $result['template'] = "3";
                $result['resize'] = "4";
                $result['largura'] = "980";
                }else{
                $result['type'] = "html_mainbanners";
                $result['local'] = "mainbanner";
                $result['base'] = "base7.swf";
                $result['template'] = "4";
                $result['resize'] = "3";
                $result['largura'] = "300"; 
                }
                break;

            //Grande - Wind: Banner size 980x350 / header
            case "topos":
            case "htmltopos":
                $result['type'] = "html_topos";
                $result['local'] = "topos";
                $result['base'] = "base4.swf";
                $result['template'] = "1";
                $result['resize'] = "4";
                $result['largura'] = "980";
                break;

            //Grande - Wind: Banner size 980x50 / footer
            case "rodapes":
            case "htmlrodapes":
                $result['type'] = "html_rodapes";
                $result['local'] = "rodapes";
                $result['base'] = "base4.swf";
                $result['template'] = "2";
                $result['resize'] = "4";
                $result['largura'] = "980";
                break;

            //Image - Image no edited: image size banner base6.swf 640x480
            case "image":
                $result['local'] = "image";
                $result['base'] = "base6.swf";
                $result['resize'] = "2";
                break;
            //Image - Image edited: Banner size banner base6.swf 640x480
            case "cool_image":
                $result['local'] = "cool_image";
                $result['base'] = "base6.swf";
                $result['resize'] = "2";
                break;
            
            //SWF - from pages container slot
            case "container_banner":
                $result['local'] = "bannerwww";
                $result['base'] = "base4.swf";
                $result['resize'] = "3";
                break;
            
            default:
                $result['local'] = "mini";
                $result['base'] = "base.swf";
                $result['template'] = "41";
                $result['resize'] = "1";
                $result['largura'] = "200";
                break;
        }
        return $result;
    }
    
    /**
     * Método para pegar as propriedas dos Html Banners
     *
     * @param string
     *
    */
    public static function getHtmlBannerProperties($value){
        
        $result = array();

        switch ($value){

            //Mini - Stripe: Banner size 200x100 / banner
            case "htmlbanner":
                $result['altura'] = "80";
                $result['largura'] = "245";
                $result['font_size'] = "4pt";
                $result['resize'] = "4.2";
                break;
            
            //Banners: Banner size 980x100 / banners
            case "htmlbanners":
            case "html_banners":
                $result['altura'] = "100";
                $result['largura'] = "310";
                $result['font_size'] = "4pt";
                $result['resize'] = "3.2";
                break;
        }
        
        $result['resize_slot'] = "4";
        return $result;
    }
    
    /**
     * Método para pegar as propriedas dos Html Banners
     *
     * @param string
     *
    */
    public static function getSQLByLayout($layout){
        
        $result = array();

        switch ($layout){
            //triple_one - 720x100
            case "triple_one":
            case "triple_one_purplebusiness":
                $result['tipo'] = "html_lonsdale";
                $result['step'] = "html_mini";
                break;     
            //container_billboard_triple - 300x200
            case "billboard_triple":
                $result['tipo'] = "html_spark";
                $result['step'] = "html_spark";
                break; 
            //container_one full - 980x100
            case "one_full":
                $result['tipo'] = "html_banners";
                $result['step'] = "html_banners";
                break; 
            //quarter -200x100
            case "quarters":
            case "quarters_purplebusiness":
            case "triple_mini":
                $result['tipo'] = "html_mini";
                $result['step'] = "html_mini";
                break;
            //blocks 250x200 ou mais de altura
            case "container_blocks_vertical":
            case "container_blocks_vertical_purplebusiness":
                $result['tipo'] = "html_blocks";
                $result['step'] = "html_blocks";
                break;
            
            case "showcase":
                $result['tipo'] = "html_corona";
                $result['step'] = "html_corona";
                break;
            
            default:
                $result['tipo'] = "html_blocks";
                $result['step'] = "html_blocks";
                break;
        }
        
        return $result;
    }
    
    /**
     * Método para setar as propriedas Banners
     * referentes aos items que já foram pagos, ou tem interesse de pagamento
     *
     * @param number
     *
    */
    public static function setPaidItemAttributes($data, $item){
        
        $values  = "creditos = " . $item['valor'] ."";        
        if($data['status'] == 3){$values .= ", exibe = 1";}
        
        $sql = "UPDATE banners_data SET ". $values ." WHERE id = ". $item['id_item'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para obter os elementos cool dos banners que agora estão 
     * separados em um nova tabela banners_items
     *
     * @param number
     *
    */
    public static function getBannersItems($id_banner, $isTemplate = false, $isItemIndex = false){
        Yii::import('application.extensions.digitalbuzz.attributes.BannersItems');
        $bIt = new BannersItems();
        
        $recordset = $bIt->recuperar($id_banner, $isTemplate, $isItemIndex);
        
        return $recordset;
    }
    
    /**
     * Método para obter os elementos cool dos banners que agora estão 
     * separados em um nova tabela banners_items
     *
     * @param number
     *
    */
    public static function setBannersItemsLoop($output, $id_banner){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BannersItems');
        $bIt = new BannersItems();
        
        $bIt->setCurrentBanner($id_banner);
        
        try{
            ///Salva os items do modelo no Manager PurplePier
            for($i = 0; $i < count($output['cool2']); $i++){               

                $result['t'][$i] =  $bIt->adicionar($output['cool2'][$i]['tipo'], $output['cool2'][$i]['src'], $output['cool2'][$i]['p_x'], 
                                    $output['cool2'][$i]['p_y'], $output['cool2'][$i]['width'], $output['cool2'][$i]['height'],
                                    $output['cool2'][$i]['color'], $output['cool2'][$i]['f_type'], $output['cool2'][$i]['s_text'],
                                    $output['cool2'][$i]['s_thumb'], $output['cool2'][$i]['link'], $output['cool2'][$i]['variante'], $output['cool2'][$i]['texto'],
                                    $output['cool2'][$i]['z_index']);

            }
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
         
    }
    
    /**
     * Método para remover os items dos banners
     *
     * @param number
     *
    */
    public static function removeItems($id_banner) {

        $query = "DELETE FROM banners_items WHERE id_banner = $id_banner";
        
        try{
            $prepare = Yii::app()->db->createCommand($query);
            $control = $prepare->execute();

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BannersUtils - removeItems() ". $e->getMessage();
        }
    }
    
    /**
     * Método para remover o banners da lista de publicidade
     * Tabela banners attributes
     *
     * @param number
     *
    */
    public static function removeAds($id_banner) {

        $query = "DELETE FROM banners_attribute WHERE banner_id = $id_banner";
        

        try{
            $prepare = Yii::app()->db->createCommand($query);
            $control = $prepare->execute();

            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BannersUtils - removeAds() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar algusn campos únicos dos banners, esses itens não repetem
     * e basicamente são setados automáticos na criação do banner. 
     * 
     * Current: background and overlay
     *
     * @param number
     * @param string
     * @param string
     *
    */
    public static function updateUniqueAttributes($id_banner, $type, $attribute){
        
        $values  = "src = '" . $attribute ."'";      
        
        $sql = "UPDATE banners_items SET ". $values ." WHERE id_banner = $id_banner AND tipo = '". $type . "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();   
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar as definições dos creditos
     * dos banners, altera o status de exibe ou não e a quantidade
     * de créditos. 
     * 
     *
     * @param number
     * @param number
     * @param number
     *
    */
    public static function setBannerCredits($id_banner, $debitos, $exibe, $creditos = 0, $isZero = false){
        
        $values  = "exibe = '" . $exibe ."', debito_dia = '" . $debitos ."'";      
        if($isZero) $values  = "exibe = '" . $exibe ."', creditos = '" . $creditos ."'";
            echo $values;
        $sql = "UPDATE banners_data SET ". $values ." WHERE id = $id_banner";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();  
            
            return $control . $id_banner;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para trocar a ordem dos banners na exibição
     *
     * @param array
     *
    */
    public static function randomBanners($banners){
        
        $num_banners = count($banners);        
    
        $keys = array_keys($banners);
        shuffle($keys);
        $random = array();
        $i = 0;
        foreach ($keys as $key){
            $random[$i] = $banners[$key];
            $i++;
        }

        return $random;
    }
    
    /**
     * Método para salvar qual banner deve ser salvo
     *
     * @param number
     * @param number
     *
    */
    public static function setBannersAdvertise($id_banner, $id_page, $status, $tipo, $index, $size, $vencimento = "0000-00-00") {

        if ($status) {
            $isExist = false; 
            if($tipo == 'flutuante' || $tipo == 'global') $isExist = BannersUtils::getBannersAdvertise($id_banner, $tipo);
            
            if(!$isExist){
                $query = "INSERT INTO banners_attribute (banner_id, page_id, tipo, n_index, size, data) VALUES ($id_banner, $id_page, '$tipo', $index, '$size', '$vencimento')";
            }else{
                $query = "UPDATE banners_attribute SET data = '$vencimento' WHERE banner_id = $id_banner AND tipo = '$tipo'";
            }
            
        }else{
            $query = "DELETE FROM banners_attribute WHERE banner_id = $id_banner AND page_id = $id_page AND tipo = '$tipo'";
        }
        
        try {
            $prepare = Yii::app()->db->createCommand($query);
            $control = $prepare->execute();

            return $control;

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * Método para obter os banners que seão exibidos nas páginas 
     *
     * @param number
     * @param string
     *
     */
    public static function getBannersAdvertise($id, $tipo = 'advertise') {

        $select = "id, page_id, banner_id, n_index, size, data";
        $sql = "SELECT $select FROM banners_attribute WHERE banner_id = '$id' and tipo = '$tipo'";

        try {
            $command = Yii::app()->db->createCommand($sql);     
            if($tipo == 'advertise') $recordset = $command->queryAll(); 
            if($tipo == 'flutuante') $recordset = $command->queryRow(); 
            if($tipo == 'global') $recordset = $command->queryRow(); 
            
            return $recordset;

        } catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BannerUtils - getBannersAdvertise() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para definir uma imagem tanto db ou db2  
     *
     * @param number
     * @param number
     *
    */
    public static function saveImagePlayground($id_banner, $file, $action){
        
        $values  = "image = '" . $file ."'";      
        $sql = "UPDATE banners_data SET ". $values ." WHERE id = $id_banner";
        if($action == "modelo") $sql = "UPDATE conteudo_templates SET ". $values ." WHERE id = $id_banner";

        try{
            if($action != "modelo") {
                $comando = Yii::app()->db->createCommand($sql);
            }else{
                $comando = Yii::app()->db2->createCommand($sql);
            }
            
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para obter os banners que 
     *
     * @param number
     * @param number
     *
    */
    public static function saveImageBackground($id, $file, $type){
       
        $sql = "UPDATE banners_data SET image = '" . $file ."', image_type = $type WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);            
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BannerUtils - saveImageBackground() ' . $e->getMessage();
        }
    }
    
    /**
     * Metodo para pegar as o tipo dos banners separa de render partials
     *
     * @param string
     *
    */
    public static function getTypeItem($type){

        switch($type){

            //Banner
            case "topos":
            case "htmltopos":
            case "html_topos":
            case "rodapes":
            case "htmlrodapes":
            case "html_rodapes":
            case "htmlmini":
            case "html_mini":
            case "htmlblock":
            case "html_block":
                $result = "banner";
                break;
            
            default:
                $result = $type;
                break;
        }
        
        return $result;
    }
    
    /**
     * Método para atualiza as propriedas Banners
     *
     * @param number
     * @param string
     * @param value
     *
    */
    public static function updateBannerAttribute($id, $field, $value){
        
        $sql = "UPDATE banners_data SET $field = '$value' WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();  
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para organizar um array
     *
     * @param number
     * @param string
     * @param value
     *
    */
    public static function organizeArray($output){
        
        Yii::import('application.extensions.utils.OrdemAlfabeticaUtils');
        
        $result = array();
        
        try{
           
            for($i = 0; $i < count($output); $i++){
                if(isset($output[$i]['id'])){
                    $result[$i] = $output[$i];
                    
                    // Damn pesky carriage returns...
                    //$text = str_replace("\r\n", "\n", $output[$i]['texto']); $text = str_replace("\r", "\n", $text); $text = str_replace("\n", "\\n", $text);
                    $text = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$output[$i]['texto'], ENT_QUOTES, 'utf-8', false)));
                    
                    if(isset($output[$i]['graphic']['zindex'])) $result[$i]['ordem'] = $output[$i]['graphic']['zindex']; else $result[$i]['ordem'] = 0;
                    if(isset($output[$i]['texto']) && $output[$i]['texto'] != "") $result[$i]['texto'] = $text;
                    if(isset($output[$i]['texto']) && $output[$i]['texto'] != "") $result[$i]['src'] = $text;
                    if(isset($output[$i]['nickname']) && $output[$i]['nickname'] != ""){
                        //$nick = str_replace("\r\n", "\n", $output[$i]['nickname']); $nick = str_replace("\r", "\n", $nick); $nick = str_replace("\n", "\\n", $nick);
                        $nick = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$output[$i]['nickname'], ENT_QUOTES, 'utf-8', false)));
                        $result[$i]['nickname'] = $nick;
                    }
                    
                    
                }else{
                    $result['nr'] =  $output['nr'];
                    $result['id'] =  $output['id'];
                    $result['action'] =  $output['action'];
                    $result['altura'] =  $output['altura'];
                    $result['largura'] =  $output['largura'];
                    $result['cor'] =  $output['cor'];
                    $result['tipo'] =  $output['tipo'];
                    $result['modelo'] =  $output['modelo'];
                    $result['image'] =  $output['image'];

                    //"nr":7,"id":"565","action":"editar","altura":300,"cor":"","largura":"400","tipo":"playground","modelo":"empty html","image":"a7dc96dea5b33e1f4b28a06fc385d907.png"
                }

            }
        
            $output = OrdemAlfabeticaUtils::sortArray($result, "ordem", SORT_ASC);
  
            return $output;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     * Método para obter os settings Flutuantes
     *
    */
    public static function getFlutuanteSettings(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        try{
            $result['flutuante_page_show'] = PreferencesUtils::getAttributes('flutuante_page_show');  
            $result['flutuante_frequency'] = PreferencesUtils::getAttributes('flutuante_frequency');  
            $result['flutuante_timer'] = PreferencesUtils::getAttributes('flutuante_timer');  
            
            return $result;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BannersUtils - getFlutuanteSttings() ". $e->getMessage();
        }
    }
    
}
?>