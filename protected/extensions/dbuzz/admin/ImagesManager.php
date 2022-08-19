<?php
/*
 * This Class is used to controll all functions related the feature Images
 *
 * @author CarlosGarcia
 *
 * Usage Notes
 *
 *
 */
class ImagesManager{

    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getAllContent($id){
        
        $select = "id, id_categoria, fotop, foto, largura, altura, titulo, ficha_tecnica";
        $sql = "SELECT $select FROM conteudo_images WHERE id_user = 0 ORDER BY id DESC LIMIT 0, 10";

        $pictures = $this->getImageContent($id);

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){

                    $pictureset = $this->verifySlots($recordset[$i]['foto'], $pictures);

                    $recordset[$i]['slot'] = $pictureset[0];
                    $recordset[$i]['slotUsed'] = $pictureset[1];
                    $recordset[$i]['id_page'] = $pictureset[2];
                    $recordset[$i]['type_file'] = $this->getTypeFile($recordset[$i]['foto']);
                    $sizePicture = $this->getSizePicture("media/user/images/thumbs_120/" . $recordset[$i]['foto']);
                    $recordset[$i]['height'] = $sizePicture[1];
                    $recordset[$i]['width'] = $sizePicture[0];
                    $recordset[$i]['margin'] = $sizePicture[2];
                }

                $recordset[0]['slotLastUsed'] = $this->verifyLastSlots($pictures);
            }
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar o caminho de uma imagem 
     *
     * @param number
     *
    */
    public function getContentById($id){

        $select = "id, id_categoria, foto, titulo";
        $sql = "SELECT $select FROM conteudo_images WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;
            
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros organizados por
     * categoria
     *
     * @param $id_cat number
     *
    */
    public function getContentByCat($id_cat){
        
        $select = "id, id_categoria, foto, titulo";

        if($id_cat != "todas" && $id_cat != "00"){
            $sql = "SELECT $select FROM conteudo_images WHERE id_categoria = $id_cat  LIMIT 0, 10";

        } else {
            $sql = "SELECT $select FROM conteudo_images ORDER BY id DESC LIMIT 0, 10";
        }

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
           
            for($i = 0; $i < count($recordset); ++$i){
                $sizePicture = $this->getSizePicture("media/user/images/thumbs_120/" . $recordset[$i]['foto']);
                $recordset[$i]['height'] = $sizePicture[1];
                $recordset[$i]['width'] = $sizePicture[0];
                $recordset[$i]['margin'] = $sizePicture[2];
            }
            
            $recordset['records'] = $this->getRows($id_cat, "galeria");
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }


    /**
     * Método para recuperar os textos
     * $pictures images usadas em alguma página
     *
     * @param string page
     *
    */
    public function getTransformedContent($start, $idpag, $id_user = false){

        if($start < 10) $start = 0;

        $select = "id, id_categoria, fotop, foto, largura, altura, titulo, tipo, descricao";
        $sql = "SELECT $select FROM conteudo_images WHERE modelo = 0 ORDER BY id DESC LIMIT $start, 10";
        if($id_user)$sql = "SELECT $select FROM conteudo_images WHERE id_user = $id_user AND modelo = 0 ORDER BY id DESC LIMIT $start, 10";
        //$pictures = $this->getImageContent($idpag);

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['type_file'] = $this->getTypeFile($recordset[$i]['foto']);
                $sizePicture = $this->getSizePicture("media/user/images/thumbs_120/" . $recordset[$i]['foto']);
                $recordset[$i]['height'] = $sizePicture[1];
                $recordset[$i]['width'] = $sizePicture[0];
                $recordset[$i]['margin'] = $sizePicture[2];
            } 

            //$recordset[0]['slotLastUsed'] = $this->verifyLastSlots($pictures);
            $recordset['records'] = $this->getRows("todas", "galeria");
         
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar os registros da tabela conteudo_imagens
     *
     * @param number
     *
    */
    public function getContent($id){
        
        $select = "id, id_categoria, fotop, foto, largura, altura, descricao, ficha_tecnica, data, titulo";
        $sql = "SELECT $select FROM conteudo_images WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getPicture($id){

        $select = "id, id_categoria, tipo, foto, titulo, ficha_tecnica";
        $sql = "SELECT $select FROM conteudo_images WHERE id = $id";

        try{

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
            if (is_file("http://". $_SERVER['HTTP_HOST'] . "/media/user/images/" . $recordset['foto'])) {
                $img = "http://". $_SERVER['HTTP_HOST'] . "/media/user/images/" . $recordset['foto'];
                $imgSize = $this->getImageSize($img);
                $recordset['largura'] = $imgSize[0];
                $recordset['altura'] = $imgSize[1];
            } 
            
            if($recordset){ if($recordset['tipo'] == 'embeded'){
                Yii::import('application.extensions.utils.special.ImagesUtils');
                $recordset['embeded'] = ImagesUtils::resizeIframe($recordset['ficha_tecnica'], 'small');
            }}

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar as imagens que podem ser utilizadas no
     * banner
     *
     * @param string page
     *
    */
    public function getPictureContent($type='', $id = NULL, $content='playground', $start = 0) {

        $select = "id, id_categoria, fotop, foto, largura, altura, titulo, descricao, tipo, ficha_tecnica";

        $query = "SELECT $select FROM conteudo_images ";
        if ($type != 'grid' && $id != NULL && $content == "playground") $query .= "WHERE id_user = $id AND modelo = 0";
        if ($content == "noplayground" && $id != NULL) $query .= "WHERE id_user = $id AND tipo != 'playground'";
        $query .= " ORDER BY id DESC LIMIT $start, 10";

        try {
           
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){            
                    $recordset[$i]['slotUsed'] = false;
                    $recordset[$i]['id_page'] = false;
                    $recordset[$i]['type_file'] = $this->getTypeFile($recordset[$i]['foto']);
                    $sizePicture = $this->getSizePicture("media/user/images/thumbs_120/" . $recordset[$i]['foto']);
                    $recordset[$i]['height'] = $sizePicture[1];
                    $recordset[$i]['width'] = $sizePicture[0];
                    $recordset[$i]['margin'] = $sizePicture[2];

                    if($recordset[$i]['tipo'] == 'embeded'){
                        Yii::import('application.extensions.utils.special.ImagesUtils');
                        $recordset[$i]['embeded'] = ImagesUtils::resizeIframe($recordset[$i]['ficha_tecnica'], 'small');
                    }
                }

                if($id == NULL) $recordset['records'] = $this->getRows("todas", "galeria");
                if($id != NULL) $recordset['records'] = $this->getRows("user", "galeria", $id, $content);
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ImagesManager - getPictureContent() " . $e->getMessage();
        }
    }

    /**
     * Método para recuperar as imagens que foram editas no bannerMaker
     * Este método é meio fora de lugar
     *
     * TODO: Conferir localização
     *
     * @param string page
     *
    */
    public function getCoolContent(){

        $select = "id, modelo, cor, cool, altura, largura, detalhes, exibe";
        $sql = "SELECT ".$select." FROM banners_data WHERE tipo = 'img_landscape' ORDER BY id DESC LIMIT 0, 10";
        try{

            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){

                $resize = $this->setResize($recordset[$i]['largura'], $recordset[$i]['altura']);
                $recordset[$i]['largura'] = $resize[0];
                $recordset[$i]['altura']  = $resize[1];
                $recordset[$i]['margin']  = $resize[2];
            }
            $recordset['records'] = $this->getRows("todas", "img_landscape");
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    public function setResize($lar, $alt){

        if($lar > $alt){
            $percentage = (120 / $lar);
        } else {
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

        return $size;
    }

    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function submitContent($get_post){

        $select = "titulo, foto, descricao, id_categoria, tipo, data, id_user";
        $values = $get_post[0]."', '".$get_post[1]."', '".$get_post[2]."', '".$get_post[3]."', '".$get_post[4]."', '".$get_post[5]."', '".$get_post[7];
        $sql =  "INSERT INTO conteudo_images (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
  
            //return Yii::app()->db->getLastInsertID();
            echo Yii::t('messageStrings', 'message_result_gallery');

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }  
    
    /**
     * Método para atualizar um registro existente
     *
     * @param array
     *
    */
    public function updateContent($get_post){
        
        if($get_post[1] != ""){
        $values = "titulo = '" . $get_post[0] ."', " ."foto = '" . $get_post[1] ."', " . "descricao = '" . $get_post[2] ."', " .
                  "id_categoria = '" . $get_post[3] ."', tipo = '" . $get_post[4] ."', data = '" . $get_post[5] ."' ";
        }else{
        $values = "titulo = '" . $get_post[0] ."', " . "descricao = '" . $get_post[2] ."', " . "id_categoria = '" . $get_post[3] ."', tipo = '" . $get_post[4] .
                  "', data = '" . $get_post[5] ."' ";
        }

        $sql =  "UPDATE conteudo_images SET ". $values ." WHERE id = " .$get_post[6] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo Yii::t("messageStrings", "message_result_images_update");

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }  
    
    /**
     * Método para adicionar uma imagem
     * a um especifico conteudo ou usuário.
     *
     * @param array
     *
    */
    public function addContent($get_post){
        
        $select = "foto, id_categoria, tipo, id_user, data";
        $values = $get_post['image']."', '".$get_post['id_categoria']."', '".$get_post['tipo']."', '".$get_post['id_user']."', '".$get_post['data'];
        $sql =  "INSERT INTO conteudo_images (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            $result['control'] = $control;
            $result['id_image'] = Yii::app()->db->getLastInsertID();
            
            return $result;   

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            return $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os avatares cadatrados pelo
     * usuário.
     *
     *
    */
    public function getAllUserAvatars(){
        
        $session = new CHttpSession;
        $session->open();
        $id_user = $session['id'];
        $session->close();
        
        $select = "id, foto";
        $sql = "SELECT ".$select." FROM conteudo_images WHERE tipo = 'avatar' AND id_user = '$id_user' LIMIT 0, 19";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();            
            //$recordset['records'] = $this->getRows($id_cat, "galeria");
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para verificar qual block deve estar oculto
     * ao abrir a página
     *
     * @param string page
     *
     */
    public function verifyText($text) {

        $display = "";

        if($text == ""){
            $display = "displayNone";            
        }
        return $display;
    }

    /**
     * Método para recuperar as imagens dos Slots
     *
     * @param string page
     *
    */
    public function getImageContent($id){

        $select = "id, nome, menu, n_index, ".
                  "container_1, container_2, container_3, container_4, container_5, container_6, ".
                  "container_7, container_8, container_9, container_10";

        $sql = "SELECT ".$select." FROM paginas_data WHERE id = $id";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR ".$e->getMessage();
        }
    }

    /**
     * Método para recuperar a quantidade de linhas de uma tabela
     * conteudo_images
     *
     * @param number
     *
    */
    public function getRows($id_cat, $local, $id = "", $content = 'playground'){

        $nr = 0;
        $select = ' id ';

        if($id_cat != "todas" && $id_cat != 'user'){           
            $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM conteudo_images WHERE id_categoria ='$id_cat' AND modelo = 0")->queryScalar();
        }else if($id_cat == "user"){
            $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM conteudo_images WHERE id_user = $id AND tipo ='$content' AND modelo = 0")->queryScalar();
        }else{
             if($local == "galeria"){
                $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM conteudo_images WHERE modelo = 0")->queryScalar();
             }else{
                $sqlRows = Yii::app()->db->createCommand("SELECT COUNT(*) FROM banners_data WHERE tipo ='$local' AND modelo = 0")->queryScalar();                
            }
        }
        
        if($sqlRows > 11) $nr = ($sqlRows) / 10;
        $arredonda = explode(".",  $nr);

        if(count($arredonda) > 1){

            if ($arredonda[1] > 5){
                $nr = ceil($nr);
            } else {
                $nr = round($nr);
            }
        }
        return $nr;
    }

    /**
     * Método para recuperar o tipo de um documento
     * ideal para verificar se é imagem ou flash file
     *
     * @param string page
     *
    */
    public function getTypeFile($arquivo){
        
        if($arquivo != ""){ 

            $tam = strlen($arquivo);

            //ext de 3 chars
            if( $arquivo[($tam)-4] == '.' ){
                $extensao = substr($arquivo,-3);
            }

            //ext de 4 chars
            elseif( $arquivo[($tam)-5] == '.' ){
                $extensao = substr($arquivo,-4);
            }

            //ext de 2 chars
            elseif( $arquivo[($tam)-3] == '.' ){
                $extensao = substr($arquivo,-2);
            }

            //Caso a extensão não tenha 2, 3 ou 4 chars ele não aceita e retorna Nulo.
            else{
                $extensao = NULL;
            }
        
        }else{
            $extensao = NULL;
        }

        return $extensao;
    }

    public function getImageSize($img){

        $size = array();
        $size = getimagesize($img);
        
        if(count($size) < 1){
            $size[0] = "";
            $size[1] = "";
            $size[2] = "";         
        }
        return $size;
    }

    public function getSizePicture($img){

        $size = array();
        
        if(is_file($img)) {
           $size = getimagesize($img);
        }        

        if(count($size) > 1){

            if ($size[0] > $size[1]) {
                $percentage = (120 / $size[0]);
            } else {
                $percentage = (120 / $size[1]);
            }
            //gets the new value and applies the percentage, then rounds the value
            $size[0] = round($size[0] * $percentage);
            $size[1] = round($size[1] * $percentage);

            if($size[0] > $size[1]){
                $size[2] = "margin-top: -" . ($size[1] / 2)."px; position: relative; top:50%;";
            }else{
                $size[2] = "margin-left: -" . ($size[0]  /2)."px; position: relative; left:50%;";
            }

        } else {
            $size[0] = "";
            $size[1] = "";
            $size[2] = "";           
        }
        //returns the new sizes in html image tag format...this is so you
        return $size;
    }

    /**
     *
     * Método para remover um registro
     *
     * @param array
     *
    */
    public function deleteContent($get_post){

        $sql = "DELETE FROM conteudo_images WHERE id ='" . $get_post['id'] . "'";

        try {

            $imageFolders = array('','original/', 'thumbs_50/', 'thumbs_120/', 'thumbs_200/', 'thumbs_250/', 'thumbs_350/', 'thumbs_650/');

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();

            foreach ($imageFolders as $folder) {

                if (is_file($_SERVER['DOCUMENT_ROOT'] . "/media/user/images/$folder" . $get_post['image_name'])) {
                   unlink($_SERVER['DOCUMENT_ROOT'] . "/media/user/images/$folder" . $get_post['image_name']);
                }

            }
            

            echo $get_post['message'];

        } catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}
?>