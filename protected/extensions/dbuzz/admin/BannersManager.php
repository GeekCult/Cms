<?php
/*
 * This Class is used to controll all functions related the feature banners
 *
 * @author CarlosGarcia
 *
 * Date: 13/12/2010
 *
 */

class BannersManager{

    /**
     * Método para recuperar todos os registros
     * da tabela banners_data.
     * 
     * Esses dados podem tanto ser html quanto flash
     * Este método é bem flexivel
     * 
     * @param string
     *
     *
    */
    public function getAllContent($tipo, $plataforma = 'desktop', $isLimit = null, $isPurchase = false){
        
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');        
        Yii::import('application.extensions.digitalbuzz.attributes.BannersAttribute');
        
        //Prepare to save banner information
        $bn = new BannersAttribute();
        
        if(!$isPurchase) $select = "id, nome, tipo, modelo, cor, altura, largura, detalhes, exibe, link, plataforma, cool, image, image_type";
        if( $isPurchase) $select = "id, nome, tipo, modelo, cor, altura, largura, descricao, exibe, link, plataforma, valor, cool, image, image_type, thumb";
        
        if(!$isPurchase) $sql = "SELECT $select FROM banners_data WHERE id_user = 0 AND ((plataforma = '$plataforma') AND ((tipo = '$tipo' ))) ORDER BY id DESC";
        if( $isPurchase) {
            if($tipo != "html_topos') OR (tipo = 'topos" && $tipo != "html_rodapes') OR (tipo = 'rodapes") $sql = "SELECT ".$select." FROM conteudo_templates WHERE (plataforma = '$plataforma') AND (tipo = '$tipo') ORDER BY id DESC";
            if($tipo == "html_topos') OR (tipo = 'topos" || $tipo == "html_rodapes') OR (tipo = 'rodapes") $sql = "SELECT ".$select." FROM conteudo_templates WHERE (plataforma = '$plataforma') AND (tipo = '$tipo') AND tecnologia = " . Yii::app()->params['tecnologia'] . " ORDER BY id DESC";
        }
        
        if($isLimit != null) $sql .= " LIMIT 0, 10";

        try{ 
            if(!$isPurchase) $command = Yii::app()->db->createCommand($sql);
            if( $isPurchase) $command = Yii::app()->db2->createCommand($sql);
            
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['checked'] = "checked";
                $recordset[$i]['cool2'] = BannersUtils::getBannersItems($recordset[$i]['id'], $isPurchase);
                if($recordset[$i]['modelo'] == 'render_partial')$recordset[$i]['cool3'] = BannersUtils::getBannersItems($recordset[$i]['id'], $isPurchase, true);
                $recordset[$i]['attribute'] = $bn->recuperar($recordset[$i]['id'], "image_playground", "texto");
                if( $isPurchase) $recordset[$i]['valor_string'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor'], true);
            } 
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getAllContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros
     * da tabela banners_data de um usuário.
     * 
     * Esses dados podem tanto ser html quanto flash
     *
     *
    */
    public function getAllContentByUser($tipo, $isAdministrator = false){
        
        $session = new CHttpSession;
        $session->open();
        $id_user = $session['id'];
        $session->close();
        
        $select = "id, nome, tipo, modelo, cor, altura, largura, detalhes, exibe, link";
        if($tipo == "banners"){
            $sql = "SELECT ".$select." FROM banners_data WHERE id_user = $id_user";
        }else{
            if(!$isAdministrator){
            $sql = "SELECT ".$select." FROM banners_data WHERE id_user = $id_user AND tipo = '$tipo'";
            }else{
            $sql = "SELECT ".$select." FROM banners_data WHERE tipo = '$tipo'";   
            }
        }

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();     
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['cool2'] = BannersUtils::getBannersItems($recordset[$i]['id']);
            }
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR BannerManager - getAllContentByUser() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os dados realxionados as
     * estatísitcas do uso dos banners
     * 
     * @param string
     *
    */
    public function getAllStatistic($type = null){
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        
        $session = new CHttpSession;
        $session->open();
        $id_user = $session['id'];
        $session->close();
        
        $select = "id, tipo, detalhes, exibe, clicks, keywords, nome, creditos, page_views, valor_max, modelo";
        if($type == null){
        $sql = "SELECT ".$select." FROM banners_data WHERE id_user = $id_user";
        }else{
        $sql = "SELECT ".$select." FROM banners_data";   
        }

        try{          
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['creditos'] = CurrencyUtils::getPriceFormat($recordset[$i]['creditos'], true, false);  
                $recordset[$i]['creditos_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['creditos'], true, true); 
                $recordset[$i]['valor_max_format'] = CurrencyUtils::getPriceFormat($recordset[$i]['valor_max'], true, true);
            }
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getAllContentStatics() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os dados realxionados as
     * estatísitcas do uso dos banners
     * 
     * @param string
     *
    */
    public function getSettingsByIdBanner($id = 0){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, tipo, detalhes, exibe, clicks, keywords, nome, cool, altura, largura, lance, creditos, link, desconto, valor_max, image, container_1, titulo, descricao, expira, modelo";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = " . $id. "";

        try{ 
           
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
     
            $recordset['lance_format'] = CurrencyUtils::getPriceFormat($recordset['lance'], true, false);
            $recordset['creditos_format'] = CurrencyUtils::getPriceFormat($recordset['creditos'], true, false);
            $recordset['desconto_format'] = CurrencyUtils::getPriceFormat($recordset['desconto'], true, false);
            $recordset['valor_max_format'] = CurrencyUtils::getPriceFormat($recordset['valor_max'], true, false);
            $recordset['expira'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['expira'], false);
            $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id']);
            $recordset['cool3'] = BannersUtils::getBannersItems($recordset['id'], false, true);
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getSettingsByIdBanner() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar todos os registros
     * da tabela banners.
     *
     *
    */
    public function getPaginationContent($tipo, $resize){

        $select = "id, tipo, modelo, cor, cool, altura, largura, detalhes, exibe";
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = '" . $tipo. "' LIMIT 0, 10";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['largura'] = $recordset[$i]['largura'] / $resize;
                $recordset[$i]['altura'] = $recordset[$i]['altura'] / $resize;
            }

            $recordset['records'] = $this->getRows($tipo);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getPaginationContent() " . $e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados por
     * categoria
     *
     * @param $id_cat number
     *
    */
    public function getContentByCat($tipo, $resize) {

        $select = "id, tipo, modelo, cor, cool, altura, largura, detalhes, exibe";
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = '" . $tipo. "' ORDER BY id DESC LIMIT 0, 10";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            for($i=0; $i < count($recordset); $i++){
                $recordset[$i]['largura'] = $recordset[$i]['largura'] / $resize;
                $recordset[$i]['altura'] = $recordset[$i]['altura'] / $resize; 
            }

            $recordset['records'] = $this->getRows($tipo);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getContentByCat() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContent($id, $isItemIndex = false){
        
        Yii::import('application.extensions.utils.BannersUtils');
                
        $select = "id, nome, modelo, tipo, cor, altura, largura, detalhes, link, image, cool, image, image_type, titulo, descricao, link_modo";
        $sql = "SELECT $select FROM banners_data WHERE id = $id ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset['nome'] == "") $recordset['nome'] = Yii::t("adminForm", "banners_item_step");
            $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id'], false, $isItemIndex);
            
            if($recordset['modelo'] == 'render_partial'){
                $recordset['cool3'] = BannersUtils::getBannersItems($recordset['id'], false, true);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getContent() " . $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar um determindo template
     *
     * @param number
     *
    */
    public function getTemplate($id){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, nome, tipo, largura, altura, modelo, cor, cool, image";
        $sql = "SELECT ".$select." FROM conteudo_templates WHERE id = $id";

        try{
            $command = Yii::app()->db2->createCommand($sql);
            $recordset = $command->queryRow();
            
            if($recordset['nome'] == "") $recordset['nome'] = Yii::t("adminForm", "banners_item_step");
            $recordset['cool2'] = BannersUtils::getBannersItems($recordset['id'], true);
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR BannerManager - getTemplate() " . $e->getMessage();
        }
    }
    
    /**
     * Metodo para recuperar um determindo template
     *
     * @param number
     *
    */
    public function getNoResizeBannerSwf($id){

        $select = "id, tipo, largura, altura, modelo, cor, cool";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);

            $recordset = $command->queryRow();
            $resize = $this->getResizeBanner($recordset['altura'], $recordset['largura'], "banner");
            $recordset['largura'] = $resize[0];
            $recordset['altura'] = $resize[1];
            $recordset['margin'] = $resize[2];

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }


    /**
     * Metodo para recuperar um determindo template
     *
     * @param number
     *
    */
    public function getBannerSwf($id) {

        $select = "id, tipo, largura, altura, modelo, cor, cool";
        $sql = "SELECT ".$select." FROM banners_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            $resize = $this->getResizeBanner($recordset['altura'], $recordset['largura'], "container");
            $recordset['largura'] = $resize[0];
            $recordset['altura'] = $resize[1];
            $recordset['margin'] = $resize[2];

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }

    /**
     * 
     * Método para remover um registro de banners, seus items
     * e se esse banners está sendo utilizao como anuncio tambem o remove
     *
     * @param array
     *
    */
    public function deleteContent($data){
        
        Yii::import('application.extensions.utils.BannersUtils');
  
        $sql = "DELETE FROM banners_data WHERE id = " . $data['id'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Removes also the items
            $deleteItems = BannersUtils::removeItems($data['id']);
            $deleteAds = BannersUtils::removeAds($data['id']);
            
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     * Metodo para recuperar a quantidade de linhas de uma tabela
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
        }else{
            $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM banners_data")->queryScalar();
        }

        if($sqlRows > 11) $nr = ($sqlRows) / 10;

        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){
            if ($arredonda[1]>2){
                $nr = ceil($nr);
            }else{
                $nr = round($nr);
            }
        }
        return $nr;
    }

    /**
     * Metodo para alterar o tamanho dos banners e estes
     * caberem corretamente na view paginas
     *
     * @param number
     *
    */
    public function getResizeBanner($alt, $lar, $type){
        
        if($type == "container"){
            
            if($lar > $alt){
                $percentage = (120 / $lar);
            }else{
                $percentage = (120 / $alt);
            }

            $size = array();
            //gets the new value and applies the percentage, then rounds the value
            $size[0] = round($lar * $percentage);
            $size[1] = round($alt * $percentage);

            if($size[0] > $size[1]){
                $size[2] = "margin-top: -" . ($size[1] / 2)."px; position: relative; top:50%;";
            }else{
                $size[2] = "margin-left: -" . ($size[0]  /2)."px; position: relative; left:50%;";
            }
        
        }else{
            
            if($lar > $alt){
                $percentage = (450 / $lar);
            }else{
                $percentage = (200 / $alt);
            }

            $size = array();

            //gets the new value and applies the percentage, then rounds the value
            $size[0] = round($lar * $percentage);
            $size[1] = round($alt * $percentage);

            if($size[0] > $size[1]){
                
                if($type == "container"){
                    $size[2] = "margin-top: -" . ($size[1] / 2)."px; position: relative; top:50%;";
                }else{
                    $size[2] = "margin-top: 0px; position: relative; top:50%;" . " margin-left: -" . ($size[0]/ 2)."px; position: relative; left:50%;"; 
                }

            }else{
                $size[2] = "margin-left: -" . ($size[0]  /2)."px; position: relative; left:50%;";
            }
        }
        return $size;
    }

    /**
     * Método para recuperar os registros seguinter utilizando o paginar
     *
     * @param string
     * @param string
     * @param number
     *
    */
    public function getNextPaginationContent($start, $tipo, $resize) {

        $start = $start + 1;

        if ($start < 10) $start = 0;

        $select = "id, tipo, modelo, cor, cool, altura, largura, detalhes ";
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = '$tipo' LIMIT " . $start . ", 10";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i=0; $i < count($recordset); $i++){

                $recordset[$i]['largura'] = $recordset[$i]['largura'] / $resize;
                $recordset[$i]['altura'] = $recordset[$i]['altura'] / $resize;
            }

            $recordset['records'] = $this->getRows($tipo);
            return $recordset;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            return false;
            echo 'ERROR: BannersManager - getNextPaginationContent() ' .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar uma determinada quantidade
     * de registros dos ultimos banners cadastrados
     *
     * @param number
     * @param number
     * 
    */
    public function getLastContentLimited($nr_needed, $ids_selected, $tipo, $isExibe = 'AND exibe = 1'){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, id_user, tipo, altura, largura, lance, creditos, page_views, link, modelo, cool, titulo, descricao";
        $sql = "SELECT ".$select." FROM banners_data WHERE id != '$ids_selected' AND (tipo = '$tipo' $isExibe) ORDER BY id DESC LIMIT $nr_needed";
      
        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            if($recordset){
                $ct_recordset = count($recordset);
                for($i = 0; $i < $ct_recordset; $i++){
                    $recordset[$i]['cool2'] =  BannersUtils::getBannersItems($recordset[$i]['id']);
                    if(Yii::app()->params['tecnologia'] == 1) $recordset[$i]['cool3'] =  BannersUtils::getBannersItems($recordset[$i]['id'], false, true);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: BannersManager - getLastContentLimited() ' .$e->getMessage();
        }
    } 
    
    /**
     * Método para zerar o débito do dia e ativar a exibição do banner caso 
     * este ainda tenho crédito.
     *
     *
    */
    public function setDebitToZero(){
        
        Yii::import('application.extensions.utils.BannersUtils');
        
        $select = "id, tipo, largura, altura, modelo, cor, cool, expira";
        $sql = "SELECT ".$select." FROM banners_data WHERE creditos > 0";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                foreach($recordset as $values){
                    $setZero = BannersUtils::setBannerCredits($values['id'], 0, 1);
                    if($values['expira'] <= date('Y-m-d') && $values['expira'] != '0000-00-00') $setZero = BannersUtils::setBannerCredits($values['id'], 0, 0);;
                }
            }
            
            return true;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     *
     * Salvar
     * This method uses a jQuery request to save all the attributes from
     * the banner edited.
     * The values are set into Flash background.
     * Each property bellow as altura, cor or cool are complete string separate by &.
     *
     *
     */
    public function saveBanner(){
        
        $result = array();
        
        $id        = $_POST["id"];
        $nome      = $_POST["nome"];
        $altura    = $_POST["altura"];
        $largura   = $_POST["largura"];
        $cor       = $_POST["colors"];
        $cool      = $_POST["cool"];
        $modelo    = $_POST["modelo"];
        $tipo      = $_POST["tipo"];
        $action    = $_POST["action"];
        $keywords  = $_POST["keywords"];
        $descricao = $_POST["descricao"];
        $exibe     = MethodUtils::getBooleanNumber(isset($_POST["exibe"]));

        if($action != "editar" ){
            $sql  = "INSERT INTO banners_data (nome, tipo, altura, largura, cor, cool, modelo, keywords, detalhes, exibe) ";
            $sql .= "VALUES ('$nome', '$tipo', '$altura','$largura', '$cor',  '$cool', '$modelo', '$keywords', '$descricao', '$exibe')";

        }else{
            $sql  = "UPDATE banners_data SET nome = '$nome', altura = '$altura', largura = '$largura', cor = '$cor', cool = '$cool', ";
            $sql .= "modelo = '$modelo', keywords = '$keywords', detalhes = '$descricao', exibe = '$exibe' WHERE id ='$id'";
        }

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            $result['ERROR'] = 0;
            $result['message'] = $control;

        }catch(CDbException $e){
            $result['ERROR'] = 1;
            $result['message'] = $e->getMessage();
        }
        
        return $result;
    }
    
    /**
     *
     * Update
     * Main banner to de displayed at main banner
     * 
     *
     *
     */
    public function updateMainBanner($data){

        if($data['status'] == 1) $sql  = "UPDATE banners_data SET exibe = '".$data['status'] ."', creditos = 100, lance = 0, valor_max = 0.1, debito_dia = 0 WHERE id = ". $data['id'] . "";
        if($data['status'] == 0) $sql  = "UPDATE banners_data SET exibe = '".$data['status'] ."', creditos = 0, lance = 0, valor_max = 0, debito_dia = 0 WHERE id = ". $data['id'] . "";
      
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            echo $data['message'];

        }catch(CDbException $e){     
            echo 'ERROR BannerManager - updateMainBanner() ' . $e->getMessage();
        }       
    }
}
?>