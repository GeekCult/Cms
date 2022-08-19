<?php

/*
 * This Class search the content sent from a jQuery request
 * It works with a relevance content, searching into the keywords to special e 
 * co-relate content.
 *
 * @author CarlosGarcia
 *
 */

class SearchManager{
    
     /**
    * Method to retrieve the content from the follow table:
    * Paginas, materias
    * 
    * @param string
    * @param string
    *
    **/
    public function getContent($content, $type){
        try{
            if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;
            if($local_place){$json = file_get_contents('/Applications/MAMP/htdocs/purplepier/www/media/user/files/minisite_settings.json');}else{$json = file_get_contents('media/user/files/minisite_settings.json');} 

            $data = json_decode($json, true);
            
            $recordset = array();
            foreach($data['paginas'] as $values){
                
                if ((strpos($values['titulo'], $content['search']) !== false) || (strpos($values['texto_01'], $content['search']) !== false) || (strpos($values['texto_02'], $content['search']) !== false) || (strpos($values['texto_03'], $content['search']) !== false) || (strpos($values['keywords'], $content['search']) !== false)) {
                    //echo $values['nome'] . "</br>";
                    $recordset[] = $values;
                }
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: SearchManager - getContent() " . $e->getMessage();
        }
    }
    
    /**
    * Method to retrieve the content from the follow table:
    * Paginas, materias
    * 
    * @param string
    * @param string
    *
    **/
    public function getContentSupreme($content, $type){
        
        switch($type){
            case "paginas":
                $select = "id, titulo, titulo_01, texto_01, keywords, nome";
                $sql = "SELECT $select FROM paginas_data WHERE ((titulo_01 LIKE '%" . $content['search'] . "%') OR (texto_01 LIKE '%" . $content['search']  . "%') OR (keywords LIKE '%" . $content['search']  . "%'))";
                break;
            
            case "materias":
                $select = "id, tipo, titulo, subtitulo, materia, url";
                $sql = "SELECT $select FROM conteudo_materias WHERE ((titulo LIKE '%" . $content['search'] . "%') OR (subtitulo LIKE '%" . $content['search']  . "%')  OR (materia LIKE '%" . $content['search']  . "%'))";
                break;
 
             case "produtos":
                $select = "id, nome, descricao, tipo, url, descricao_resumo";
                $sql = "SELECT $select FROM ecommerce_produtos WHERE ((nome LIKE '%" . $content['search'] . "%') OR (descricao LIKE '%" . $content['search']  . "%')  OR (keywords LIKE '%" . $content['search']  . "%'))";
                break;
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
   /**
    * Method to retrieve the main user from the follow table:
    * 
    * @param string
    * @param string
    *
    **/
    public function getMainBusiness($content){
        
        //Get some aditional information
        Yii::import('application.extensions.dbuzz.site.comentarios.ComentariosManager');
        Yii::import('application.extensions.digitalbuzz.userAttribute.dbUserAttribute');
        Yii::import('application.extensions.utils.ReputationUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $select  = "id, field1, field2, avatar, frase, reputation, keywords, creation, MAX(lance)";
        $sql = "SELECT " . $select . " FROM user_data WHERE (MATCH (keywords) AGAINST ('". $content['search'] . "' IN BOOLEAN MODE)) AND (type = 1 OR type = 5) GROUP BY keywords ORDER BY MAX(lance) Desc";
        
        $select2 = "id, field1, field2, avatar, frase, reputation, keywords, creation, lance";
        $sql2 = "SELECT " . $select2 . " FROM user_data WHERE id = " . $content['id_user']. "";

        try{           
            if(!$content['action']){
                $command = Yii::app()->db->createCommand($sql);
            }else{
                $command = Yii::app()->db->createCommand($sql2); 
            }
            
            $recordset = $command->queryRow();
            
            if(!$recordset){
                return false;
            }else{
            
            $commentHandler = new ComentariosManager();
            $ua = new dbUserAttribute();
            
            $ua->setCurrentUser($recordset['id']);
            $recordset['anuncio'] = $ua->recuperar('anuncio');
            $recordset['promocao'] = $ua->recuperar('promocao');
            $recordset['site'] = $ua->recuperar('site');
            $recordset['descricao'] = $ua->recuperar('descricao', 'descricao'); 
            $recordset['google_maps'] = $ua->recuperar('googlemaps', 'descricao');
            $recordset['telefone'] = $ua->recuperar('usuario_Telefone', 'texto');
            
            //Get the address from utils, inline return the complete address, not separated
            $recordset['endereco'] = UserUtils::getAddress($recordset['id'], "inline");
            $recordset['creation'] = DateTimeUtils::getDateFormate($recordset['creation']);
            
            //Gets review
            $recordset['reputation'] = ReputationUtils::getReputationImage($recordset['reputation']);
            
            }
        
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method to retrieve the content from the follow table:
     * Paginas, materias
     * 
     * @param string
     * @param string
     *
    **/
    public function getMoreItems($data, $id_main){
        
        //It makes somes calcules
        $num_data = count($data);
        $nr_limit = 10 - $num_data;
        
        $id_s = $id_main;
        for($i = 0; $i < $num_data; $i++){   
           $id_s .= " AND id != " . $data[$i]['id'];            
        }  
        
        $select = "id, field1, field2, avatar, frase, reputation, keywords";
        $sql = "SELECT " . $select . " FROM user_data WHERE id != ". $id_s . " AND (type = 1 OR type = 5) LIMIT " . $nr_limit;      
        
        try{
            $command = Yii::app()->db->createCommand($sql);      
            $recordset = $command->queryAll();
            
            $p = 0;
            $new_nr = count($recordset);
            $nr_total = $num_data + $new_nr;
            for($i = $num_data; $i < $new_nr; $i++){
                $data[$i] = $recordset[$p];
                $p++;
            }
            
            return $data;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method to retrieve the content from the follow table:
     * Paginas, materias
     * 
     * @param string
     * @param string
     *
    **/
    public function getUserByString($string){ 
        
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.special.ProspectsUtils');
        
        $fields = "id, field1 as 'razao_social', field2 as 'nome_fantasia', birthday as 'id_user', account_locked as 'status', type as 'tipo'";
        $select1 = "SELECT id, razao_social, nome_fantasia, id_user, status, tipo FROM user_company WHERE ((razao_social LIKE '%" . $string . "%') OR (nome_fantasia LIKE '%" . $string  . "%'))";
        $select2 = "SELECT $fields FROM user_data WHERE ((field1 LIKE '" . $string . "%') OR (field2 LIKE '" . $string  . "%'))";
        $query = "$select1 UNION $select2";

        try {
            $command = Yii::app()->db->createCommand($query);      
            $recordset = $command->queryAll();

            if ($recordset) {
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['nome'] = UserUtils::getUserNameString($recordset[$i]['razao_social'], $recordset[$i]['nome_fantasia'], $recordset[$i]['tipo']);
                    $recordset[$i]['user'] = UserUtils::getUserById($recordset[$i]['id_user']);
                    $recordset[$i]['status_string'] = ProspectsUtils::getStatusString($recordset[$i]['status']);
                }
            }
            
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method to retrieve the content from the follow table:
     * Paginas, materias
     * 
     * @param string
     * @param string
     *
    **/
    public function getUsersKindOf($data){ 
        
        Yii::import('application.extensions.utils.CurrencyUtils');
        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.StatusUtils');
        
        $fields = "id, field1, field2, avatar, frase, keywords, email, lance, type, account_states_id, birthday, account_locked, creation";

        if($data['name'] != '')  $sql = "SELECT $fields FROM user_data WHERE ((field1 LIKE '" . $data['name'] . "%') OR (field2 LIKE '" . $data['name']  . "%'))";
        if($data['email'] != '') $sql = "SELECT $fields FROM user_data WHERE email LIKE '" . $data['email'] . "%'";
  
        try {
            $command = Yii::app()->db->createCommand($sql);      
            $users = $command->queryAll();
            
            $p = 0;
            $recordset = array();
            
            if($users){
                for($i = 0; $i < count($users); $i++){
                    $check = UserUtils::getAttribute($data['tag'], 'name', $users[$i]['id']);
                    if($check){
                        $recordset[$p]['id'] = $users[$i]['id'];
                        $recordset[$p]['email'] = $users[$i]['email'];
                        $recordset[$p]['lance_format'] = CurrencyUtils::getPriceFormat($users[$i]['lance'], true, false);
                        $recordset[$p]['birthday_format'] = DateTimeUtils::getDateFormatCommonNoTime($users[$i]['birthday']);
                        $recordset[$p]['name'] = UserUtils::getNameUser($users[$i]['field1'], $users[$i]['field2'], $users[$i]['type']);
                        $recordset[$p]['account_status'] =  StatusUtils::getTypeStringToIcon($users[$i]['account_states_id']);
                        $recordset[$p]['account_locked_string'] =  UserUtils::getLocked($users[$i]['account_locked']);
                        $recordset[$p]['account_locked'] = $users[$i]['account_locked'];
                        $recordset[$p]['type'] = $users[$i]['type'];
                        $recordset[$p]['tag'] = $data['tag'];

                        $recordset[$p]['account_states_id_string'] =  UserUtils::getSituation($users[$i]['account_states_id']);
                        $recordset[$p]['creation'] =  DateTimeUtils::getDateFormateNoTime($users[$i]['creation']);
                        $recordset[$p]['type_name'] = UserUtils::getUserTypeString($users[$i]['type']);
                        $p++;
                    }
                }
            }
            
            return $recordset;

        } catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Method to retrieve the content from the follow table:
     * General Profession into Manager Database
     * 
     * @param string
     *
    **/
    public function getProfessionByString($string){ 
        
        $select = "id, descricao";
        $sql = "SELECT " . $select . " FROM general_profissoes WHERE (descricao LIKE '%" . $string . "%')";      
        
        try{
            $command = Yii::app()->db2->createCommand($sql);      
            $recordset = $command->queryAll();
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
}
?>