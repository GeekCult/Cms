<?php
/*
 * This Class is used to controll all functions related the feature Materias
 *
 * @author CarlosGarcia
 *
 * Date: 12/12/2010
 *
 */
class MateriasManager {

    /**
     * Método para recuperar todos os registros
     * da tabala materias.
     *
     * @param string
    */
    public function getAllContent($tipo = null, $isUser = false, $year = null, $month = null, $day = null, $isAll = false) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $session = MethodUtils::getSessionData();

        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, last_update, container_1, data_novidade, views, url";
        $query = "SELECT ".$select." FROM conteudo_materias WHERE id_user = 0 AND tipo = '$tipo'";
        if($isUser) $query .= " AND id_colunista = ". $session['id'];
        
        if(!$isAll){
            $query .= " AND year(data) = " . $year;
            $query .= " AND month(data) = " . $month;
        }
        
        $query .= " ORDER BY id DESC";

        try {
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();
            
            if(count($recordset) > 0){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                }
            }else{
                $recordset = false;
            }  
            
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllContent() ' . $e->getMessage();
        }
    }

    /**
     * Método usado para retornar todos os anos em que há matérias
     * cadastradas.
     */
    public function getAllYears($tipo ='noticias') {

        $query = "SELECT year(data) as 'year' FROM conteudo_materias";
        $query .= " WHERE id_user = 0 AND tipo = '$tipo' GROUP BY year";

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();
            
            if($result){
                if ($result[count($result)-1]['year'] != date('Y')) {
                    $current['year'] = 2014;
                    array_push($result, $current);
                }
            }

            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllYears() ' .$e->getMessage();
        }
    }

    /**
     * Método usado para retornar todos os meses de um determinado
     * ano em que há matérias cadastradas.
     * @param string
     */
    public function getAllMonths($year , $tipo ='noticias') {

        // Need to implement a way to set the locale everytime the application runs.
        $locale = "pt_BR";

        // Used to return formated date names.
        $format = "SET lc_time_names = '$locale';";
        $query = "SELECT month(data) as 'value', monthname(data) as 'name' FROM conteudo_materias ";
        $query .= " WHERE id_user = 0 AND tipo = '$tipo' AND year(data) = $year GROUP BY value";

        try {
            $prepare = Yii::app()->db->createCommand($format);
            $result = $prepare->execute();

            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();

            if ($year == date('Y')) {
                if (isset($result[date('m')-1])) {
                    if(isset($result[date('m')-1]['month']) && $result[date('m')-1]['month'] != date('m')){
                        $current['value'] = date('m');
                        $current['name'] = strftime('%B', time());
                        array_push($result, $current);
                    }
                }
            }

            // print_r($result); exit;
            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllMonths() ' .$e->getMessage();
        }
    }
    

    /**
     * Método usado para retornar todos os meses de um determinado
     * mês e ano em que há matérias cadastradas
     */
    public function getAllDays($year, $month, $tipo ='noticias') {

        $query = "SELECT day(data) as 'day' FROM conteudo_materias WHERE id_user = 0 AND month(data) = $month";
        $query .= " AND tipo = '$tipo' AND year(data) = $year GROUP BY day";

        // echo $query; exit;

        try {
            $prepare = Yii::app()->db->createCommand($query);
            $result = $prepare->queryAll();

            $all['day'] = 'Todos';

            array_push($result, $all);

            return $result;

        } catch (CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllDays() ' . $e->getMessage();
        }
    }

    /**
     * Método para recuperar todos os registros
     * da tabala materias.
     *
     * @param string
    */
    public function getLimitedContent($tipo, $start, $qtd, $isOriginal = 'original', $searchVal = false){  
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.GraphicsHelperUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.MateriasUtils');
        Yii::import('application.extensions.utils.users.UserUtils');  
        Yii::import('application.extensions.utils.StringUtils');
        Yii::import('application.extensions.utils.DataBaseUtils');

        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, last_update, container_1, id_colunista, data_novidade, link_special, cor, destaque, chamada, titulo_fb, descricao_fb, foto_fb, exibe, modelo, url";
        $sql = "SELECT $select FROM conteudo_materias WHERE id_user = 0 AND (tipo = '$tipo' AND exibe = 1) ORDER BY id DESC LIMIT $start, $qtd";
        if($searchVal) $sql = "SELECT ".$select." FROM conteudo_materias WHERE id_user = 0 AND (tipo = '$tipo' AND ((titulo LIKE '%$searchVal%') OR (materia LIKE '%$searchVal%') OR (keywords LIKE '%$searchVal%'))) ORDER BY titulo ASC LIMIT $start, $qtd";

        try {
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
    
            if($recordset){                
                
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data_parts'] = DateTimeUtils::getDateFormateNoTimeStampParts($recordset[$i]['data']);
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);                    
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                    $recordset[$i]['url_title'] = StringUtils::StringToUrl($recordset[$i]['titulo'], true, '-');
                    $recordset[$i]['tags'] = StringUtils::transFormStringToArray($recordset[$i]['keywords']);
                    
                    if($tipo == "colunas"){
                        $recordset[$i]['coluna'] = MateriasUtils::getColunaName($recordset[$i]['id_categoria']);
                        $recordset[$i]['colunista'] = UserUtils::getUserById($recordset[$i]['id_colunista']);
                    }
                    
                    if($tipo == "novidades"){
                        $dateSplited = DateTimeUtils::getSplitDateNoTime($recordset[$i]['data_novidade']);
                        $recordset[$i]['data_novidade_split']['month'] = DateTimeUtils::getAbreviateMonth($dateSplited['month']);
                        $recordset[$i]['data_novidade_split']['day'] = $dateSplited['day'];
                    }
                    
                    if($recordset[$i]['container_1'] != null || $recordset[$i]['container_1'] != ""){
                        
                        $type = explode("_", $recordset[$i]['container_1']);
                        $recordset[$i]['slot_type'] = $type[0];
                        
                        //Set previously
                        $recordset[$i]['picture'] = '';$recordset[$i]['image'] =  "";
                        
                        if($type[0] == "b"){
                            $recordset[$i]['container_1'] = GraphicsHelperUtils::getBanner($type[1]);
                        }else if($type[0] == "f"){
                            $recordset[$i]['container_1'] = GraphicsHelperUtils::getPhotos($type[1]);
                            $recordset[$i]['picture'] =  "//". $_SERVER['SERVER_NAME'] . "/media/user/images/" . $isOriginal . "/" . $recordset[$i]['container_1']['foto'];
                            $recordset[$i]['image'] =  $recordset[$i]['container_1']['foto'];
                        }else if($type[0] == "e"){
                            $recordset[$i]['container'] = GraphicsHelperUtils::getEmbededImages($type[1]);                            
                        }else{
                            //$recordset[$i]['container_1'] = GraphicsHelperUtils::getHtml($type[1]);
                        }
                        
                    }else{
                        $recordset[$i]['slot_type'] = "";
                        $recordset[$i]['picture'] = "";
                    }
                 
                } 
                 
                $recordset[0]['qtd'] = DataBaseUtils::getCountRecords("conteudo_materias", "tipo", $tipo);
                
            }else{
                $recordset = false;
            } 
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getLimitedContent() ' .$e->getMessage();
        }
    }

    /**
     * Método para recuperar o registro pelo id
     *
     * @param number id
     *
    */
    public function getContent($id){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, container_1, last_update, data_novidade, link_special";
        $sql = "SELECT ".$select." FROM conteudo_materias WHERE id= $id ";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            
            $recordset['data_string'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['data']);
            $recordset['last_update_string'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['last_update']);
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getContent() ' .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um registro vazio
     *
     * @param number id
     *
    */
    public function getContentEmpty(){
        
        $recordset['id'] = "";
        $recordset['id_categoria'] = "";
        $recordset['id_colunista'] = "";
        $recordset['titulo'] = "";
        $recordset['subtitulo'] = "";
        $recordset['keywords'] = "";
        $recordset['materia'] = "";
        $recordset['data'] = "";
        $recordset['container_1'] = "";
        $recordset['last_update'] = "";
        $recordset['data_novidade'] = "";
        $recordset['data_string'] = "";
        $recordset['last_update_string'] = "";
        $recordset['link_special'] = "";
        $recordset['destaque'] = "";
        $recordset['exibe'] = 1;
        $recordset['cor'] = "";
        $recordset['titulo_fb'] = "";
        $recordset['descricao_fb'] = "";
        $recordset['foto_fb'] = "";
        $recordset['chamada'] = "";
        $recordset['modelo'] = "";
        return $recordset;
 
    }

    /**
     * Método para recuperar um determinado registro
     * Usado em editar conteúdo
     *
     * @param number
     *
    */
    public function getContentById($id, $isNext = false, $tipo = "noticias"){
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.ShortUrlUtils');
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.ModulesUtils');
        Yii::import('application.extensions.utils.MateriasUtils');
        Yii::import('application.extensions.utils.StringUtils');

        $select  = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, last_update, container_1, tipo, data_novidade, link_special, views, ";
        $select .= "destaque, exibe, cor, chamada, titulo_fb, descricao_fb, foto_fb, modelo, url";
        $sql = "SELECT $select FROM conteudo_materias WHERE id = $id ";
        if($isNext) $sql = "SELECT $select FROM conteudo_materias WHERE tipo = '$tipo' AND id < $id";

        try{
            if($id != ""){
                $command = Yii::app()->db->createCommand($sql);            
                $recordset = $command->queryRow();
            
                if($recordset) {
                    $recordset['data_parts'] = DateTimeUtils::getDateFormateNoTimeStampParts($recordset['data']);
                    $recordset['data_novidade'] = DateTimeUtils::getDateFormatCommonNoTime($recordset['data_novidade']);
                    $recordset['url_title'] = StringUtils::StringToUrl($recordset['titulo']);
                    $recordset['last_update_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['last_update']);
                    $recordset['shorturl'] = ShortUrlUtils::getShortUrl($recordset['id']);
                    $recordset['graphic'] = GraphicsUtils::getCoolContent($recordset['container_1']);
                    $recordset['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['data']);
                    
                    $recordset['picture'] = '';
                    if(isset($recordset['graphic']['container']['foto']))$recordset['picture'] =  "//". $_SERVER['SERVER_NAME'] . "/media/user/images/original/" . $recordset['graphic']['container']['foto'];
                    
                    if($recordset['tipo'] == 'colunas') $recordset['titulo_coluna'] = MateriasUtils::getColunaName($recordset['id_categoria']);
            
                    //Applies a special content and/or styled comment
                    if(Yii::app()->controller->id != 'admin') $recordset['materia'] = ModulesUtils::defineComment($recordset['materia']);
                    if(Yii::app()->controller->id != 'admin') $recordset['materia'] = ModulesUtils::getModule($recordset['materia']);

                    $recordset['num'] = 2;
                }
            
            }else{
                $recordset = MateriasUtils::getDataClearArticle();
            }          
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getContentById() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar uma determinada imagem do regsitro
     * Este método é utilizado dentro da sessão Admin.
     * Portanto não apague!
     *
     * @param number
     *
    */
    public function getPictureArticleById($id){

        $select = "id, id_categoria, container_1";
        $sql = "SELECT ".$select." FROM conteudo_materias WHERE id = $id ";

        try{
            if($id != ""){
                $command = Yii::app()->db->createCommand($sql);            
                $recordset = $command->queryRow();
            }else{
                $recordset = false;
            }
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getPictureArticleById() ' . $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param string page
     *
    */
    public function submitContent($data){
        
        Yii::import('application.extensions.dbuzz.site.shorturl.ShortUrlManager');        
        $shortUrlHandler = new ShortUrlManager();

        $select  = "titulo, materia, keywords, data, container_1, last_update, subtitulo, tipo, id_colunista, id_categoria, data_novidade, ";
        $select .= "link_special, destaque, cor, exibe, chamada, modelo, titulo_fb, descricao_fb, foto_fb, url";

        $values  = "'{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}', ";
        $values .= "'{$data[3]}', '{$data[5]}', '{$data[6]}', '{$data[7]}', '{$data[8]}', '{$data[9]}', '{$data[10]}', ";
        $values .= "'{$data['destaque']}', '{$data['cor']}', '{$data['exibe']}', '{$data['chamada']}', '{$data['modelo']}',";
        $values .= "'{$data['fb_titulo']}', '{$data['fb_texto']}', '{$data['slot_fb_1']}', '{$data['url']}'";

        $sql =  "INSERT INTO conteudo_materias ($select) VALUES ($values)";

        try{

            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();            
            $shortUrlHandler->submitShortUrl($data[6]);
            
            //Separates some results to be passed for ajax.
            $data['ERROR'] = 0;
            $data['message'] = $data['message'];
            $data['local'] = $data['local'];
            
            echo json_encode($data);

        }catch(CDbException $e) {
            Yii::trace("ERROR ". $e->getMessage());
            $error = array("ERROR" =>  1, "message" => MethodUtils::getErrorMessage($e->getCode()), "id" => $e->getCode());
            echo json_encode($error);
        }
    }

    /**
     * Método para excluir um registro existente
     * TODO: It uses a GET http request: Change it!
     *
     * @param number
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM conteudo_materias WHERE id ='{$data['id']}'";
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR MateriasManager - deleteContent() ' .  $e->getMessage();
        }
    }

    /**
     * Método para atualizar um registro existente
     *
     * It updates the selected content 
     * The get_post array is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateContent($data){

        $values  = "titulo = '{$data[0]}', materia = '{$data[1]}', keywords = '{$data[2]}', ";
        $values .= "last_update = '{$data[3]}', container_1 = '{$data[4]}', subtitulo = '{$data[5]}', ";
        $values .= "id_colunista = '{$data[7]}', id_categoria = '{$data[8]}', data_novidade = '{$data[9]}', ";
        $values .= "link_special = '{$data[10]}', destaque = '{$data['destaque']}', exibe = '{$data['exibe']}', cor = '{$data['cor']}', ";
        $values .= "chamada = '{$data['chamada']}', modelo = '{$data['modelo']}', titulo_fb = '{$data['fb_titulo']}', descricao_fb = '{$data['fb_texto']}', foto_fb = '{$data['slot_fb_1']}', ";
        $values .= "url = '{$data['url']}'";
        
        $sql = "UPDATE conteudo_materias SET $values WHERE id = {$data['id_article']}";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Separates some results to be passed for ajax.
            $data['ERROR'] = 0;
            $data['message'] = $data['message'];
            $data['local'] = $data['local'];
            
            //Limpa o cache dos componentes
            $clear = MethodUtils::cleanSessionDataByCategory('SES_ROWS_');
            
            echo json_encode($data);

        }catch(CDbException $e){
           $error = array("ERROR" =>  1, "message" => MethodUtils::getErrorMessage($e->getCode()), "id" => $e->getCode());
           echo json_encode($error);
        }
    }
    
    /**
     * Método para recuperar a ultima matéria postada
     * Usado dentro do site se vir vazio esse método faz uma
     * pesquisa pela ultima notícia cadastrada.
     * 
     * @param string
     *
    */
    public function getLastContent($tipo = "noticias", $isFull = true, $isOriginal = 'original'){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');        
        Yii::import('application.extensions.utils.ShortUrlUtils');
        
        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, container_1, last_update, data_novidade, link_special, views, cor, destaque, chamada, titulo_fb, descricao_fb, foto_fb, exibe, modelo, url";
        if(!$isFull) $select = "id, id_categoria, id_colunista, titulo, subtitulo, data, container_1, last_update";
        
        $sql = "SELECT ".$select." FROM conteudo_materias WHERE id_user = 0 AND (tipo != 'colunas' AND tipo != 'dicas' AND tipo != 'novidades') ORDER BY id DESC";
        if($tipo != "")$sql = "SELECT ".$select." FROM conteudo_materias WHERE id_user = 0 AND tipo = '$tipo' ORDER BY id DESC";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            
            if($recordset){
                $recordset['shorturl'] = ShortUrlUtils::getShortUrl($recordset['id']);
                $recordset['graphic'] = GraphicsUtils::getCoolContent($recordset['container_1']);
                $recordset['last_update_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['last_update']);
                $recordset['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset['data']);
                (isset($recordset['graphic']['container']['foto'])) ? $recordset['picture'] =  "//". $_SERVER['SERVER_NAME'] . "/media/user/images/" . $isOriginal . "/" . $recordset['graphic']['container']['foto'] : $recordset['picture'] = '';
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getLastContent() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar uma determinada quantidade
     * de registros das ultimas matéria postada
     *
     * @param number
     * 
    */
    public function getLastContentLimited($nr_needed, $ids_selected, $tipo, $isFull = true){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');        
        Yii::import('application.extensions.utils.ShortUrlUtils');

        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, container_1, last_update, data_novidade, link_special, cor, destaque, chamada, titulo_fb, descricao_fb, foto_fb, exibe, modelo, url";
        if(!$isFull)$select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, data, container_1, last_update, link_special";
        $sql = "SELECT ".$select." FROM conteudo_materias WHERE id_user = 0 AND (id != '$ids_selected' AND tipo = '$tipo') ORDER BY id DESC LIMIT $nr_needed";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['graphic'] = GraphicsUtils::getCoolContent($recordset[$i]['container_1']);
                    $recordset[$i]['last_update_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                    $recordset[$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                }
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getLastContentLimited() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar uma determinada quantidade
     * de registros com o scroll de page
     *
     * @param number
     * 
    */
    public function loadContentLimited($nr_needed, $nr, $tipo, $isFull = true){
        
        Yii::import('application.extensions.utils.GraphicsUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');        
        Yii::import('application.extensions.utils.ShortUrlUtils');

        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, container_1, last_update, data_novidade, link_special, cor, destaque, chamada, titulo_fb, descricao_fb, foto_fb, exibe, modelo, url";
        $sql = "SELECT $select FROM conteudo_materias WHERE id_user = 0 AND tipo = '$tipo' ORDER BY id DESC LIMIT $nr, $nr_needed";

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['graphic'] = GraphicsUtils::getCoolContent($recordset[$i]['container_1']);
                    $recordset[$i]['last_update_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                    $recordset[$i]['data_string'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                }
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - loadContentLimited() ' .  $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os colunistas
     * 
     * Existe um método que pega os usuários pelo id, use
     * UserUtils::getUserById();
     *
    */
    public function getWriters(){

        Yii::import('application.extensions.utils.users.UserUtils');
        
        try{        
            $recordset = UserUtils::getAllKindUsers('colunistas');
           
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getWriters() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para contar as materias
     * 
     * Separados por tipo: Notices, Blog, Articles
     *
    */
    public function countContent($tipo){
        
        Yii::import('application.extensions.utils.DataBaseUtils');
        
        $to = date("Y")."-".date('m')."-".date('t');
        $from = date("Y")."-".date('m')."-"."01";

        $records['total'] = DataBaseUtils::getCountRecords("conteudo_materias", "tipo", $tipo);
        $records['month'] = DataBaseUtils::getCountRecordsPeriod("conteudo_materias", "tipo", $tipo, $from, $to);
        
        return $records;
    }
    
    /**
     * Método para recuperar todos os registros de uma categoria
     *
     * @param string
     *
    */
    public function getAllContentByAttributes($categoria){

        $sql = "SELECT id, titulo, url FROM conteudo_materias WHERE id_user = 0 AND tipo = '$categoria' ORDER BY titulo ASC";

        try{           
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();           
            
            return $recordset;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllContentByAttributes() ' . $e->getMessage();
        }
    }
    
    /**
     * Método adicionar uma view ao item exibido
     *
     * @param number
     *
    */
    public function setVisit($id, $views){
        
        $views = $views + 1;   
        $sql = "UPDATE conteudo_materias SET views = $views WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;

        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - setVisit() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar todos os registros via id da categoria e tipo
     * 
     * @param number
     * @param string
    */
    public function getAllContentRelated($id_categoria, $tipo) {
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        $select = "id, id_categoria, id_colunista, titulo, subtitulo, keywords, materia, data, last_update, container_1, data_novidade, views, url";
        $query = "SELECT $select FROM conteudo_materias WHERE id_categoria = $id_categoria AND tipo = '$tipo' ORDER BY titulo ASC";

        try {
            $command = Yii::app()->db->createCommand($query);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['data'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['data']);
                    $recordset[$i]['last_update'] = DateTimeUtils::getDateFormateNoTimeStamp($recordset[$i]['last_update']);
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getAllContentRelated() ' . $e->getMessage();
        }
    }
    
    /**
     * Url
     *
     * @param string
     *
    */
    public function getContentByUrl($url){

        $sql = "SELECT id FROM conteudo_materias WHERE url = '$url'";

        try{     
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR MateriasManager - getContentByUrl() ' . $e->getMessage();
        }
    }
}

?>