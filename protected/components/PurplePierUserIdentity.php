<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminUserIdentity
 *
 * @author gustavo
 */
class PurplePierUserIdentity extends CUserIdentity{

    private $id;
    private $name;
    private $documento;
    public $errorMessage;

    const ERROR_USER_UNVERIFIED=10;
    const ERROR_USER_BLOCKED=11;    
    
    /**
     * Autentica o usuário, verificando se o nome de usuário e a senha são válidos
     *
     * @return boolean Indica se a autenticação foi feita com sucesso.
     */
    public function authenticate($permitir = false, $role = 'cliente', $data = array()){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        
        $obiz = HelperUtils::getObiz();
        
        // busca no banco o usuário que tem o email fornecido pelo usuário
        if(!$obiz){ 
            $sql = "SELECT * FROM user_data WHERE email = '$this->username'";
            if(isset($data['type']) && $data['type'] == 'documento') $sql = "SELECT * FROM user_data WHERE documento = '$this->username'";
        }
        
        if( $obiz){ 
            $sql = "SELECT *, AES_DECRYPT(field1, {$obiz['serial']}) AS field1, AES_DECRYPT(field2, {$obiz['serial']}) AS field2, AES_DECRYPT(email, {$obiz['serial']}) AS email, AES_DECRYPT(frase, {$obiz['serial']}) AS frase, AES_DECRYPT(avatar, {$obiz['serial']}) AS avatar, AES_DECRYPT(json, {$obiz['serial']}) AS json FROM user_data WHERE email = AES_ENCRYPT('{$this->username}', {$obiz['serial']})";
            if(isset($data['type']) && $data['type'] == 'documento') $sql = "SELECT *, AES_DECRYPT(email, {$obiz['serial']}) AS email FROM user_data WHERE documento = AES_ENCRYPT('{$this->username}', {$obiz['serial']})"; 
        }
        //echo 'ddd';
        $user = Yii::app()->db->createCommand($sql)->queryRow();
        //echo $sql;
        
        // It comes in MD5 from Javascript!
        $pwdMd5 = $this->password;   
        $master = false;
        
        //Se tiver um password master definido
        if(Yii::app()->params['pwd_master']){ 
            if($pwdMd5 == md5(Yii::app()->params['pwd_master'])) $master = true;
        }
        
        if(!$user || $user === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $this->errorMessage = Yii::t('adminForm', "username_invalid");
            
        }else{
            if($user['password'] !== $pwdMd5 && !$master){
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                $this->errorMessage = Yii::t('adminForm', "password_invalid");
            }else{ 
        
                if($user['account_states_id'] == 0){
                    //account is not verified yet
                    $this->errorCode = self::ERROR_USER_UNVERIFIED;
                    $this->errorMessage = Yii::t('adminForm', "unverified_account");
                //Blocked
                }else if($user['account_states_id'] == 10){
                    //account is blocked
                    $this->errorCode = self::ERROR_USER_BLOCKED;
                    $this->errorMessage = Yii::t('adminForm', "user_blocked");

                }else{
                    
                    $this->id = $user['id'];
                    $this->name = $user['email'];                    
                     
                    $user_permision = UserUtils::getAttributes('permission_level', 'texto', $this->id, true);
                    //var_dump($user_permision);
                    //Se for um tipo espefico de tag
                    if(isset($data['type']) && $data['type'] != ''){
                        $isOk = false;
                        foreach($user_permision as $permission){
                            if($permission['name'] == $data['type']){ 
                                $isOk = true;
                            }                            
                        }
                        
                        if(!$isOk){
                            $this->errorMessage = Yii::t('adminForm', "user_not_allowed");
                            return false;
                        }
                    }
                    
                    $this->setState('roles', $role);
                    Yii::app()->user->setState("role", $role);//Better way

                    // Coloca infos do usuário na sessão
                    $session = new CHttpSession;
                    $session->open();
                    $session['email'] = $user['email'];
                    
                    //Adiciona os favoritos na sessão
                    $json = json_decode($user['json'], true);
                    if(isset($json['fav'])) $session['fav'] = $json['fav'];
                    
                    $us = $user['type'];
                    
                    if($user['obiz']){
                        //$user = HelperUtils::getCripto($user, C::DECRYPT);
                    }
                    
                    if($us == '0' || $us == '2' || $us == '3'){
                        $session['field1'] = $user['field1'];
                        $session['field2'] = $user['field2'];
                        $session['user']   = $user['field1'] . " " . $user['field2'];
                    
                    }else{
                        $session['field1'] = $user['field1'];
                        $session['field2'] = $user['field2'];
                        $session['user']   = $user['field1'];
                    }                    
                    
                    if($role == 'admin'){
                        if($us == '2' || $us == '3'){ $session['logado_admin'] = 1;}
                        if($user_permision){
                            foreach($user_permision as $permission){
                                if($permission['name'] == 'administrador'){ $session['logado_admin'] = 1; $session['access_level'] = 1;}
                                if($permission['name'] == 'acessor'){ $session['logado_admin'] = 1; $session['access_level'] = 1;}
                            }
                        }                       
                    }
                    
                    if($role == 'app'){
                        $session['logado_app'] = 1;
                    }
                    
                    //Se for um atadista
                    if(isset($data['type']) && $data['type'] == 'atacadista'){
                        $session['atacadista'] = 1;
                    }
                    
                    // Se náo permitir pega valor setado
                    $time = time() + Yii::app()->params['sessionTimeout'];
                    if($permitir) $time = time() + 3600 * 24 * 30;
                    
                    $session['id'] = $user['id'];
                    $session['base'] = $_SERVER['SERVER_NAME'];
                    $session['frase'] = $user['frase'];
                    $session['lock'] = $user['account_locked'];
                    $session['profile_level'] = $user['profile_level'];
                    $session['user_account_states_id'] = $user['account_states_id'];
                    $session['user_account_type'] = $user['type'];
                    if($user['documento'] != '0') $session['user_document'] = $user['documento'];
                    
                    //Se tiver aplicativo e assinatura
                    if(Yii::app()->params['assinatura']){
                        Yii::import('application.extensions.utils.DateTimeUtils');
                        $session['user_allowed'] = 0;
                        $isExpired = DateTimeUtils::compareDate($user['assinatura'], date('Y-m-d'), 'smaller');
                        if(!$isExpired) $session['user_allowed'] = 1;
                    }
                    
                    $session['userSessionTimeout'] = $time;//session timeout value
                    $session['isSessionTimeOut'] = false;//Helps with session timeout
                    $session['pre_email'] = '';
                    $session['avatar'] = $user['avatar'];
                    $session['user_id_pier'] = $user['id_pier'];//Só usa aqui, mas nenhum lugar
                    
                    //Logado site
                    $session['logado'] = 1;
                    
                    $session->close();
                    
                    Yii::import('application.extensions.utils.users.UserUtils');
                    $setPermissions = UserUtils::loadAttributesPermissons($user['id']);
                    
                    $this->errorCode = self::ERROR_NONE;
                    return !$this->errorCode;
                }
            }
        }
        if(isset($data['error'])) return $this->errorMessage;
        return !$this->errorCode;
    }
    
    /**
     * Autentica o usuário, verificando se o nome de usuário e a senha são válidos
     *
     * @return boolean Indica se a autenticação foi feita com sucesso.
     */
    public function authenticateOld($permitir = false, $role = 'cliente', $data = array()){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        
        // busca no banco o usuário que tem o email fornecido pelo usuário
        $user = User::model()->findByAttributes(array('email' => $this->username));
        if(isset($data['type']) && $data['type'] == 'documento') $user = User::model()->findByAttributes(array('documento' => $this->username));

        // It comes in MD5 from Javascript!
        $pwdMd5 = $this->password;   
        $master = false;
        
        //Se tiver um password master definido
        if(Yii::app()->params['pwd_master']){ 
            if($pwdMd5 == md5(Yii::app()->params['pwd_master'])) $master = true;
        }
        
        if($user === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $this->errorMessage = Yii::t('adminForm', "username_invalid");
            
        }else{
            if($user->password !== $pwdMd5 && !$master){
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                $this->errorMessage = Yii::t('adminForm', "password_invalid");
            }else{                
                if($user->account_states_id == 0){
                    //account is not verified yet
                    $this->errorCode = self::ERROR_USER_UNVERIFIED;
                    $this->errorMessage = Yii::t('adminForm', "unverified_account");
                //Blocked
                }else if($user->account_states_id == 10){
                    //account is blocked
                    $this->errorCode = self::ERROR_USER_BLOCKED;
                    $this->errorMessage = Yii::t('adminForm', "user_blocked");

                }else{
                    
                    $this->id = $user->id;
                    $this->name = $user->email;                    
                     
                    $user_permision = UserUtils::getAttributes('permission_level', 'texto', $this->id, true);
                    //var_dump($user_permision);
                    //Se for um tipo espefico de tag
                    if(isset($data['type']) && $data['type'] != ''){
                        $isOk = false;
                        foreach($user_permision as $permission){
                            if($permission['name'] == $data['type']){ 
                                $isOk = true;
                            }                            
                        }
                        
                        if(!$isOk){
                            $this->errorMessage = Yii::t('adminForm', "user_not_allowed");
                            return false;
                        }
                    }
                    
                    $this->setState('roles', $role);
                    Yii::app()->user->setState("role", $role);//Better way

                    // Coloca infos do usuário na sessão
                    $session = new CHttpSession;
                    $session->open();
                    $session['email'] = $user->email;
                    
                    $us = $user->type;
                    
                    if($user->obiz){
                        $user = HelperUtils::getCripto($user, C::DECRYPT);
                    }
                    
                    if($us == '0' || $us == '2' || $us == '3'){
                        $session['field1'] = $user->field1;
                        $session['field2'] = $user->field2;
                        $session['user']   = $user->field1 . " " . $user->field2;
                    
                    }else{
                        $session['field1'] = $user->field1;
                        $session['field2'] = $user->field2;
                        $session['user']   = $user->field1;
                    }
                    
                    
                    
                    if($role == 'admin'){
                        if($us == '2' || $us == '3') $session['logado_admin'] = 1;
                        if($user_permision){
                            foreach($user_permision as $permission){
                                if($permission['name'] == 'administrador') $session['logado_admin'] = 1;
                                if($permission['name'] == 'acessor') $session['logado_admin'] = 1;
                            }
                        }                       
                    }
                    
                    if($role == 'app'){
                        $session['logado_app'] = 1;
                    }
                    
                    //Se for um atadista
                    if(isset($data['type']) && $data['type'] == 'atacadista'){
                        $session['atacadista'] = 1;
                    }
                    
                    // Se náo permitir pega valor setado
                    $time = time() + Yii::app()->params['sessionTimeout'];
                    if($permitir) $time = time() + 3600 * 24 * 30;
                    
                    $session['id'] = $user->id;
                    $session['base'] = $_SERVER['SERVER_NAME'];
                    $session['frase'] = $user->frase;
                    $session['lock'] = $user->account_locked;
                    $session['profile_level'] = $user->profile_level;
                    $session['user_account_states_id'] = $user->account_states_id;
                    $session['user_account_type'] = $user->type;
                    if($user->documento != '0') $session['user_document'] = $user->documento;
                    
                    //Se tiver aplicativo e assinatura
                    if(Yii::app()->params['assinatura']){
                        Yii::import('application.extensions.utils.DateTimeUtils');
                        $session['user_allowed'] = 0;
                        $isExpired = DateTimeUtils::compareDate($user->assinatura, date('Y-m-d'), 'smaller');
                        if(!$isExpired) $session['user_allowed'] = 1;
                    }
                    
                    $session['userSessionTimeout'] = $time;//session timeout value
                    $session['isSessionTimeOut'] = false;//Helps with session timeout
                    $session['pre_email'] = '';
                    $session['avatar'] = HelperUtils::getAvatar($user->id);
                    $session['user_id_pier'] = $user->id_pier;//Só usa aqui, mas nenhum lugar
                    
                    //Logado site
                    $session['logado'] = 1;
                    
                    $session->close();
                    
                    Yii::import('application.extensions.utils.users.UserUtils');
                    $setPermissions = UserUtils::loadAttributesPermissons($user->id);
                    
                    $this->errorCode = self::ERROR_NONE;
                    return !$this->errorCode;
                }
            }
        }
        if(isset($data['error'])) return $this->errorMessage;
        return !$this->errorCode;
    }
    
    /**
     * Autentica o usuário, verificando se o nome de usuário e a senha são válidos
     *
     * @return boolean Indica se a autenticação foi feita com sucesso.
     */
    public function check($permitir = false, $role = 'cliente', $data = array()){
        
        Yii::import('application.extensions.utils.users.UserUtils');
        
        // busca no banco o usuário que tem o email fornecido pelo usuário
        $user = User::model()->findByAttributes(array('email' => $this->username));
        if(isset($data['type']) && $data['type'] == 'documento') $user = User::model()->findByAttributes(array('documento' => $this->username));

        // It comes in MD5 from Javascript!
        $pwdMd5 = $this->password;   
        $master = false;
        
        //Se tiver um password master definido
        if(Yii::app()->params['pwd_master']){ 
            if($pwdMd5 == md5(Yii::app()->params['pwd_master'])) $master = true;
        }

        if($user === null){
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            $this->errorMessage = Yii::t('adminForm', "username_invalid");
            
        }else{
            if($user->password !== $pwdMd5 && !$master){
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                $this->errorMessage = Yii::t('adminForm', "password_invalid");
            }else{                
                if($user->account_states_id == 0){
                    //account is not verified yet
                    $this->errorCode = self::ERROR_USER_UNVERIFIED;
                    $this->errorMessage = Yii::t('adminForm', "unverified_account");
                //Blocked
                }else if($user->account_states_id == 10){
                    //account is blocked
                    $this->errorCode = self::ERROR_USER_BLOCKED;
                    $this->errorMessage = Yii::t('adminForm', "user_blocked");

                }else{                    
                    $this->id = $user->id;
                    $this->name = $user->email;                    

                    $this->errorCode = self::ERROR_NONE;
                    return !$this->errorCode;
                }
            }
        }
        if(isset($data['error'])) return $this->errorMessage;
        return !$this->errorCode;
    }

    public function getId(){
        return $this->id;
    }
}