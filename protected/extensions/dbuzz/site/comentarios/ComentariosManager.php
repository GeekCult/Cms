<?php

/*
 * Comentários Manager
 * Antigo FAQ - Frequently Answers and Questions
 *
 * This Class is used to set and retrieve the questions and answers
 * from the table conteudo_comentarios
 *
 * @author Carlosgarcia
 *
 *
 */

class ComentariosManager{
    
    
    /**
     * Método para recuperar os textos
     *
     * @param string page
     *
    */
    public function getAllContent($id_moderator) {

        Yii::import('application.extensions.digitalbuzz.utils.DateTimeUtils');
        $select = "id, id_user, id_pool, date_question, date_answer, moderator, title, question, answer, file";

        //Verifies if the request is a pool faq request or a compracomum faq request - 0 means Compra Comum - FAQ
        if($id_moderator == 0){
            $sql = "SELECT ".$select." FROM faq WHERE id_moderator =  ".$id_moderator ." AND moderator = 'true'";
        }else{
            $sql = "SELECT ".$select." FROM faq WHERE (id_moderator =  ".$id_moderator ." AND moderator = 'false') AND id_moderator != 0";
        }

        $recordset = false;

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryAll();

            if(count($recordset) > 0 ){

                for($i = 0; $i < count($recordset); $i++){
                   $brand_name = $this->getProductDesc($recordset[$i]['id_pool']);
                   $recordset[$i]['name'] = $brand_name["name"];
                   $recordset[$i]['date_question'] = DateTimeUtils::getDateFormate($recordset[$i]['date_question']);
                   $recordset[$i]['date_answer'] = DateTimeUtils::getDateFormate($recordset[$i]['date_answer']);
                }

            }else{                    
                $recordset = false;                    
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ComentariosManager - getAllContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os comentários de um determinado conteudo.
     * Usado no site
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getCommentsByIdGeneral($data, $tipo = "materias", $isAll = false, $query = ''){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CommentsUtils');
        Yii::import('application.extensions.utils.users.UserUtils');

        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, likes, unlikes, answer, file";
        $sql = "SELECT ".$select." FROM general_comentarios WHERE id_general = {$data['id']} AND (exibir_comentario = 1 AND reply_to = '' AND tipo = '$tipo') $query";
        if($isAll) $sql = "SELECT $select FROM general_comentarios WHERE (exibir_comentario = 1 AND tipo = '$tipo') ORDER BY id DESC";
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            
            if($recordset){
                for($i = 0; $i < count($recordset); $i++){
                    $recordset[$i]['review_status'] = $this->getCookieReview("Rv_" . $recordset[$i]['id']);
                    $recordset[$i]['date_comment'] = DateTimeUtils::getDateFormate($recordset[$i]['date_comment']);
                    $recordset[$i]['likes'] = CommentsUtils::getPhrase($recordset[$i]['likes'], "like");
                    $recordset[$i]['unlikes'] = CommentsUtils::getPhrase($recordset[$i]['unlikes'], "unlike");
                    $recordset[$i]['replies'] = $this->getReplies($recordset[$i]['id']);
                    $recordset[$i]['user'] = UserUtils::getUserFullById($recordset[$i]['id_user']);
                }            
            }
                           
            return $recordset;            

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ComentariosManager - getCommentsByIdGeneral() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um comentário de um determinado conteudo.
     * Usado no site
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getCommentByIdGeneral($id, $tipo = 'review'){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CommentsUtils');

        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, likes, unlikes, answer, file";
        $sql = "SELECT ".$select." FROM general_comentarios WHERE id_general = " . $id . " AND exibir_comentario = 1 AND reply_to = '' ORDER BY id DESC";
     
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            if($recordset){               
                $recordset['review_status'] = $this->getCookieReview("Rv_" . $recordset['id']);
                $recordset['date_comment'] = DateTimeUtils::getDateFormate($recordset['date_comment']);
                $recordset['likes'] = CommentsUtils::getPhrase($recordset['likes'], "like");
                $recordset['unlikes'] = CommentsUtils::getPhrase($recordset['unlikes'], "unlike");
                $recordset['replies'] = $this->getReplies($recordset['id'], $tipo);            
            }
            
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ComentariosManager - getCommentByIdGeneral() ' .$e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um um determinado comentário.
     * Usado no admin
     * 
     *
     * @param number
     *
    */
    public function getCommentById($id){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.CommentsUtils');

        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, answer, email, tipo, file";
        $sql = "SELECT $select FROM general_comentarios WHERE id = " . $id . "";
     
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            if(!$recordset){                
                return false;
                
            }else{
                $recordset['review_status'] = $this->getCookieReview("Rv_" . $recordset['id']);
                $recordset['date_comment'] = DateTimeUtils::getDateFormate($recordset['date_comment']);
                $recordset['replies'] = $this->getReplies($recordset['id']);            
                return $recordset;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo 'ERROR: ComentariosManager - getCommentById() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um um determinado comentário.
     * Usado no admin
     * 
     *
     * @param number
     *
    */
    public function getCommentClear(){

        try{
           $result = array('title' => '', 'comentario' => '', 'nome' => '', 'answer' => '', 'id' => '', 'id_user' => ''); 

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar um comentário de um determinado conteudo.
     * Usado no site
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getLikesByIdGeneral($id, $local){
        
        Yii::import('application.extensions.utils.CommentsUtils');
        Yii::import('application.extensions.utils.CookieUtils');

        $select = "id, id_general, tipo, likes, unlikes";
        $sql = "SELECT $select FROM general_likes WHERE id_general = " . $id . " AND tipo = '". $local ."'";
     
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();

            if(!$recordset){                
                return false;                
            }else{
                $recordset['review_status'] = CookieUtils::getCookie("Rv_" . $id);
                $recordset['likes'] = CommentsUtils::getPhrase($recordset['likes'], "like");
                $recordset['unlikes'] = CommentsUtils::getPhrase($recordset['unlikes'], "unlike");
                          
                return $recordset;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar as respostas dos comentários de um determinado conteudo.
     * Usado no site
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getReplies($id, $tipo = 'review'){

        Yii::import('application.extensions.utils.DateTimeUtils');
        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, reply_to";
        $sql = "SELECT ".$select." FROM general_comentarios WHERE id_comment = " . $id . " AND exibir_comentario = 1";
     
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['date_comment'] = DateTimeUtils::getDateFormate($recordset[$i]['date_comment']);
            }
            
            if(count($recordset) < 0){                
                return false;                
            }else{                
                return $recordset;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }


    /**
     * Método para recuperar os comentários de um determinado conteudo.
     * Usado no admin
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getAllAdminComments($data, $tipo){

        Yii::import('application.extensions.utils.DateTimeUtils');
        Yii::import('application.extensions.utils.special.ApiUtils');
        
        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, exibir_comentario, tipo";
        
        if($data['id'] != "all" && $data['tipo'] == "all" ){
            $sql = "SELECT $select FROM general_comentarios WHERE id_general = {$data['id']} AND exibir_comentario = {$data['categoria']}";
        
        }else if($data['id'] != "all" && $data['tipo'] != "all"){            
            $sql = "SELECT $select FROM general_comentarios WHERE id_general = {$data['id']} AND (exibir_comentario = {$data['categoria']} AND (tipo = '{$data['tipo']}'))";
            
        }else{            
            $sql = "SELECT $select FROM general_comentarios WHERE exibir_comentario = {$data['categoria']} AND (tipo = '$tipo')";
            
        }

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['date_comment'] = DateTimeUtils::getDateFormate($recordset[$i]['date_comment']);
                $recordset[$i]['subcomentario'] = substr($recordset[$i]['comentario'] , 0, 90);
                $recordset[$i]['info'] = ApiUtils:: getContentFromType($recordset[$i]['tipo'], $recordset[$i]['id_general']);                
            }
            
            if(count($recordset) < 0){                
                return false;                
            }else{                
                return $recordset;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar os comentários de um determinado conteudo.
     * Usado no admin
     * 
     * Este conteúdo pode ser: matéria, produto ou
     * outro conteúdo que aceite comentários
     *
     * @param number
     *
    */
    public function getAllAdminDepoimentos($data, $tipo){

        Yii::import('application.extensions.utils.DateTimeUtils');
        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, exibir_comentario";
        
        if($data['id'] != "all" && $data['tipo'] == "all" ){
            $sql = "SELECT $select FROM general_comentarios WHERE id_general = {$data['id']} AND exibir_comentario = {$data['categoria']} AND tipo = 'depoimentos'";
        
        }else if($data['id'] != "all" && $data['tipo'] != "all"){            
            $sql = "SELECT $select FROM general_comentarios WHERE id_general = {$data['id']} AND exibir_comentario = {$data['categoria']} AND tipo = 'depoimentos'";
            
        }else{            
            $sql = "SELECT $select FROM general_comentarios WHERE exibir_comentario = {$data['categoria']} AND tipo = 'depoimentos'";
        }

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();

            for($i = 0; $i < count($recordset); $i++){
                $recordset[$i]['date_comment'] = DateTimeUtils::getDateFormate($recordset[$i]['date_comment']);
                $recordset[$i]['subcomentario'] = substr($recordset[$i]['comentario'] , 0, 90);
                
            }
            
            if(count($recordset) < 0){                
                return false;                
            }else{                
                return $recordset;
            }

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo comentário
     *
     * @param array
     *
    */
    public function submitComment($data){
        
        $select = "id_general, title, nome, email, comentario, date_comment, tipo, id_user, answer, file, exibir_comentario";
        
        $values  = "'{$data['id_general']}', '{$data['title']}', '{$data['nome']}', '{$data['email']}', '{$data['comentario']}', '";
        $values .= "{$data['data']}', '{$data['tipo_comentario']}', {$data['id_user']}, '{$data['resposta']}', '{$data['file']}', {$data['exibe']}";

        $sql =  "INSERT INTO general_comentarios ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $set = $this->recordAction($data);
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - submitComment() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar um comentário
     *
     * @param array
     *
    */
    public function updateComment($data){
        
        $values = "title = '" . $data['titulo'] ."', " ."nome = '" . $data[ 'nome'] ."', " . "comentario = '" . $data['comentario'] ."', " .
                  "answer = '" . $data['resposta'] ."' ";

        $sql =  "UPDATE general_comentarios SET ". $values ." WHERE id = " .$data['id'] . "";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo Yii::t("messageStrings", "message_result_comment_update" );

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - updateComment() ". $e->getMessage();
        }
    }
    
    /**
     * Método para salvar uma nova repsota para um comentário
     * existente
     *
     * @param array
     *
    */
    public function submitReply($data){
        
        $select = "id_general, nome, email, comentario, date_comment, tipo, id_comment, reply_to, id_user, exibir_comentario";
        
        $values  = "'{$data['id_general']}', '{$data['nome']}', '{$data['email']}', '{$data['comentario']}', ";
        $values .= "'{$data['date_comment']}', '{$data['tipo']}', '{$data['id_comment']}', '{$data['reply_to']}',";
        $values .= "{$data['id_user']}, {$data['exibe']}";

        $sql =  "INSERT INTO general_comentarios ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            $set = $this->recordAction($data);
            
            return $control;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - submitReply() " . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar ou incrementar uma opiniao 
     * ajudante com os botões like e unlike
     *
     * @param array
     *
    */
    public function submitReview($data){
        
        Yii::import('application.extensions.utils.CommentsUtils');
        
        $select = "id, id_general, likes, unlikes";        
        $sql = "SELECT ".$select." FROM general_comentarios WHERE id = " . $data['id'] . "";

        try{            
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
  
            //Sets one more for like and unlike
            if($data['tipo'] == "bt_like" || $data['tipo'] == "button_inhamer_like"){                
                $review = $recordset['likes'] + 1;
                $values = " likes = $review ";   
                $data['phrase'] = CommentsUtils::getPhrase($review, "like");
            }else{
                $review = $recordset['unlikes'] + 1;
                $values = " unlikes = $review ";
                $data['phrase'] = CommentsUtils::getPhrase($review, "unlike");
            }
            
            $sql2 =  "UPDATE general_comentarios SET ". $values ." WHERE id = ". $data['id'] . "";

            $comando = Yii::app()->db->createCommand($sql2);
            $control = $comando->execute();
            $id_cookie = "Rv_" . $data['id'];
            
            $doCookie = new CHttpCookie($id_cookie, '1');
            $doCookie->expire = time() + 60000;
            Yii::app()->request->cookies[$id_cookie] = $doCookie;
            
            echo json_encode($data);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - submitReview() " . $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar ou incrementar um like 
     * esses podem ser de produtos, pedidos e etc menos comentarios
     *
     * @param array
     *
    */
    public function submitLikes($data){
        
        Yii::import('application.extensions.utils.CommentsUtils');
        
        $select = "id, id_general, likes, unlikes, tipo";        
        $sql = "SELECT $select FROM general_likes WHERE id_general = {$data['id']} AND tipo = '{$data['local']}' ";

        try{  
            $recordset = 0;
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
       
        try{
            if($recordset){
                //Sets one more for like and unlike
                if($data['tipo'] == "bt_like"){                
                    $review = $recordset['likes'] + 1;
                    $values = " likes = $review ";   
                    $data['phrase'] = CommentsUtils::getPhrase($review, "like");
                    $data['like_nr'] = $review;
                    //If it's a like review it adds one point
                    $data_vote['voto'] = 1;
                }else{
                    $review = $recordset['unlikes'] + 1;
                    $values = " unlikes = $review ";
                    $data['phrase'] = CommentsUtils::getPhrase($review, "unlike");
                    $data['unlike_nr'] = $review;
                    //If it's an unlike review it remove one point
                    $data_vote['voto'] = -1;
                }
                
                $sql2 =  "UPDATE general_likes SET $values WHERE id_general = {$data['id']} AND tipo = '{$data['local']}'";            
            
            }else{
                //Sets one more for like and unlike
                if($data['tipo'] == "bt_like"){ 
                    $values =  1 . "', '" . $data['id']. "', '" . $data['local'];
                    $review = 1;
                    $select = " likes, id_general, tipo ";   
                    $data['phrase'] = CommentsUtils::getPhrase($review, "like");
                    $data['like_nr'] = $review;
                    //If it's a like review it adds one point
                    $data_vote['voto'] = 1;
                }else{
                    $values =  1 . "', '" . $data['id']. "', '" . $data['local'];
                    $review = 1;
                    $select = " unlikes, id_general, tipo ";
                    $data['phrase'] = CommentsUtils::getPhrase($review, "unlike");
                    $data['unlike_nr'] = $review;
                    //If it's an unlike review it remove one point
                    $data_vote['voto'] = -1;
                }
                
                $sql2 =  "INSERT INTO general_likes (". $select .") VALUES ('". $values . "')";                
            }

            $comando = Yii::app()->db->createCommand($sql2);
            $control = $comando->execute();
            
            $id_cookie = "Rv_" . $data['id'];           
            if($data['local'] == 'produtos') $id_cookie =  "RvPdr_" . $data['id'];
            
            $doCookie = new CHttpCookie($id_cookie, '1');
            $doCookie->expire = time() + 60000;
            Yii::app()->request->cookies[$id_cookie] = $doCookie;
            
            $data_vote['tipo'] = CommentsUtils::getTypeVote($data['local']);        
            $data_vote['id'] = $data['id'];
            
            Yii::import('application.extensions.dbuzz.site.reputacao.ReputacaoManager');
            $reputacaoHandler = new ReputacaoManager();
            //if($data['local'] != "banners")$reputacao = $reputacaoHandler->saveVote($data_vote, false);
            
            echo json_encode($data);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - submitLikes() ". $e->getMessage();
        }
    }
    
    /**
     * Método para adicionar ou incrementar um like 
     * esses podem ser de produtos, pedidos e etc menos comentarios
     *
     * @param array
     *
    */
    public function submitLikesReview($data){
        
        Yii::import('application.extensions.utils.CommentsUtils');
        
        $select = "id, id_general, likes, unlikes, tipo";        
        $sql = "SELECT ".$select." FROM general_comentarios WHERE id = " . $data['id'] . " AND tipo = '" . $data['local'] . "' ";

        try{  
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            

            if($recordset){
                //Sets one more for like and unlike
                if($data['tipo'] == "bt_like"){                
                    $review = $recordset['likes'] + 1;
                    $values = " likes = $review ";   
                    $data['phrase'] = CommentsUtils::getPhrase($review, "like");
                    $data['like_nr'] = $review;
                    //If it's a like review it adds one point
                    $data_vote['voto'] = 1;
                }else{
                    $review = $recordset['unlikes'] + 1;
                    $values = " unlikes = $review ";
                    $data['phrase'] = CommentsUtils::getPhrase($review, "unlike");
                    $data['unlike_nr'] = $review;
                    //If it's an unlike review it remove one point
                    $data_vote['voto'] = -1;
                }
                
                $sql2 =  "UPDATE general_comentarios SET ". $values ." WHERE id = ". $data['id'] . " AND tipo = '" . $data['local'] ."'";  
                $comando = Yii::app()->db->createCommand($sql2);
                $control = $comando->execute();
            
            }
            
            $cookieTag = "RvR_";
            if($data['local'] == 'produtos') $cookieTag =  "RvPdr_";
            $cookie_name = $cookieTag . $data['id'];
            $cookie = false;
            if(isset(Yii::app()->request->cookies[$cookie_name])) $cookie = Yii::app()->request->cookies[$cookie_name];

            if(!$cookie){                
                Yii::app()->request->cookies[$cookie_name] = new CHttpCookie($cookie_name, 1, array('expire'=> time()+6000));
            }
            
            $set = MethodUtils::setSessionData($cookie_name, 1);
            
            $data_vote['tipo'] = CommentsUtils::getTypeVote($data['local']);        
            $data_vote['id'] = $data['id'];
            
            Yii::import('application.extensions.dbuzz.site.reputacao.ReputacaoManager');
            $reputacaoHandler = new ReputacaoManager();
            //if($data['local'] != "banners")$reputacao = $reputacaoHandler->saveVote($data_vote, false);
            
            echo json_encode($data);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - submitLikesReview() ". $e->getMessage();
        }
    }

    /**
     * Método para salvar um novo registro
     *
     * @param array
     *
    */
    public function deleteContent($data){

        $sql = "DELETE FROM general_comentarios WHERE id ='" . $data['id'] . "'";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo  "ERROR: ComentariosManager - deleteContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para aprovar um novo registro
     *
     * @param array
     *
    */
    public function approveContent($data){
  
        $sql =  "UPDATE general_comentarios SET exibir_comentario = '{$data['status']}' WHERE id = {$data['id']}";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando -> execute();
            echo $data['message'];

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - approveComment() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recarregar os comentários
     *
     * @param string
     *
    */
    public function reloadCommentsCategory($tipo, $status){

        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, exibir_comentario";
        $sql = "SELECT " . $select . " FROM general_comentarios WHERE tipo = '". $tipo."' AND exibir_comentario = $status ";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ComentariosManager - reloadCommentCategory() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recuperar o cookie.
     * Isso veê se o comentário já foi ou não avaliado com um like ou não.
     *
     * @param string
     *
    */
    public function getCookieReview($cookie_name){
        
        $cookie = Yii::app()->request->cookies[$cookie_name];
        
        if($cookie != NULL){
            return "no-display";
        }else{
            return "";
        }
    }
    
    /**
     * Método para recuperar o cookie.
     * Isso veê se o comentário já foi ou não avaliado com um like ou não.
     *
     * @param string
     *
    */
    public function createReviewAccount($id, $type){
        
        $select = "id_general, tipo";        
        $values = $id."', '".$type;

        $sql =  "INSERT INTO general_likes (". $select .") VALUES ('". $values . "')";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return true;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - createrewiewAccoount() ". $e->getMessage();
        }
    }
    
    /**
     * Método para recarregar os comentários
     *
     * @param string
     *
    */
    public function getLimitedContent($tipo, $status, $limit = 10, $order = 'ORDER BY id DESC'){

        $select = "id, id_user, id_general, nome, date_comment, id_moderador, title, comentario, exibir_comentario";
        $sql = "SELECT " . $select . " FROM general_comentarios WHERE tipo = '{$tipo}' AND exibir_comentario = $status $order LIMIT $limit";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryAll();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ComentariosManager - getLimitedContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para recarregar os comentários
     *
     * @param string
     *
    */
    public function recordAction($data){
        
        Yii::import('application.extensions.utils.users.UserUtils');

        try{            
            //Send notification
            $user = UserUtils::getUserFullById($data['id_user']);
            if($user){ $data['user'] = $user['nome'];} else {$data['user'] = '';}
            
            $title = Yii::t("activityStrings","comment_submit");
            $description = Yii::t("activityStrings", "comment_submit_desc");
            
            if($data['tipo_comentario'] == 'chamado' || $data['tipo_comentario'] == 'chamado_purplepier'){
                $title = Yii::t("activityStrings","ticket_submit");
                $description = Yii::t("activityStrings", "ticket_submit_desc");
            }

            $activity = array(
                    "title" => $title,
                    "nome" => $data['user'],
                    "message" => $description,
                    "tipo" => "new_survey",
                    "id_general" => $data['id_general'],
                    "date" => date("Y-m-d H:i:s"),
                    "last_update" => date("Y-m-d H:i:s"),
                    "id_user" => $data['id_user']
                );
                
            $setActivity = MethodUtils::setActivityRecent($activity);

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: ComentariosManager - recordAction() " . $e->getMessage();
        }
    }
    
    /**
     * Método para notificação
     *
     * @param array
     *
    */
    public function notify($data){
      
        $avaliacao = Yii::t("siteStrings", $data['tipo']);
        
        try{
            switch ($data['local']) {
                case 'wiki':
                case 'materias':
                case 'noticia':
                case 'blog':
                case 'coluna':
                    Yii::import('application.extensions.dbuzz.admin.MateriasManager');
                    $materiaHandler = new MateriasManager();
                    $content = $materiaHandler->getContentById($data['id']); 
                    $data_message = array('tipo' => 'notificacao', 'titulo_note' => $content['titulo'], 'titulo_email' => 'Nova Avaliação', 'layout' => 'notificacao_common', 'tipo_item' => $data['local'], 'avaliacao' => $avaliacao, 'nome' => '',  'email' => '');
                    break;
                
                case 'forum':
                    Yii::import('application.extensions.dbuzz.admin.special.ForumManager');
                    $forumHandler = new ForumManager();
                    $comment = $this->getCommentById($data['id']);
                    $content = $forumHandler->getContentById($comment['id_general']); 
                    $data_message = array('tipo' => 'notificacao', 'titulo_note' => $content['titulo'], 'titulo_email' => 'Nova Avaliação Fórum', 'layout' => 'notificacao_common', 'tipo_item' => $data['local'], 'avaliacao' => $avaliacao, 'nome' => '',  'email' => '');
                    $data_reply = array('tipo' => 'notificacao', 'titulo_note' => $content['titulo'], 'titulo_email' => 'Nova Avaliação de comentário', 'layout' => 'notificacao_user', 'tipo_item' => $data['local'], 'avaliacao' => $avaliacao, 'nome' => $comment['nome'], 'email' => $comment['email'], 'comentario' => nl2br($comment['comentario']), 'isOwnerReceiver' => false);
                    break;
                
                case 'produto':
                case 'produtos':
                    Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');
                    $produtoHandler = new ProdutosManager();
                    $content = $produtoHandler->getContentById($data['id']); 
                    $data_message = array('tipo' => 'notificacao', 'titulo_note' => $content['nome'], 'titulo_email' => 'Nova Avaliação Produto', 'layout' => 'notificacao_common', 'tipo_item' => $data['local'], 'avaliacao' => $avaliacao, 'nome' => '',  'email' => '');
                    break;

                default:
                    break;
            }
            
            $sendEmail = MethodUtils::sendEmailDirectly($data_message, true);
            if(isset($data_reply)) $sendReply = MethodUtils::sendEmailDirectly($data_reply, true);
            
            return  $sendReply;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: ComentariosManager - notify() ". $e->getMessage();
        }
    }
}
?>