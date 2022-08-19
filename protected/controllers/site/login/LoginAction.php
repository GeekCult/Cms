<?php

class LoginAction extends CAction{

    private $action;  

    /**
     *
     * Profile Action
     * Specific Action
     * 
     * It handles with all action related with the user conta
     *
     */
    public function run(){

        $this->action = Yii::app()->getRequest()->getQuery('action');

        switch($this->action){            
            
            case "autenticacao": 
                $this->autenticar();
                break;
                        
            case "verificar":
                $this->verificaLogado();
                break;
        }
    }
    
    /*
     * Autentica
     * 
     * 
     */
    public function autenticar(){
        
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $result = array('message' => 'Email ou senha incorreto');
        
        if($email == Yii::app()->params['email_login'] && $senha == Yii::app()->params['senha_login']){
            $set = MethodUtils::setSessionData('logado', 1);
            $result = array('message' => 'Email ou senha incorreto', 'next_action' => 'home', 'logado' => 1);
        }
            
        
        echo json_encode($result);
    }
    
    /*
     * Verifica logado
     * 
     * It verifies and return some info about 
     * the values into session.
     * 
     */
    public function verificaLogado(){
        
        $session = new CHttpSession;
        $session->open();
        
        //Se for PF adiciona nome e sobrenome           
        $result['user'] = $session['field1'] . " " . $session['field2'];      
        
        //Se expirou a sessao
        if($session['logado'] == 2)$session['logado'] = 0;
        
        $result['avatar'] = $session['avatar'];
        $result['logado'] = $session['logado'];
        $result['id'] = $session['id'];
        $result['profile_level'] = $session['profile_level'];
        
        $session->close();
        
        echo json_encode($result);
    }
    

    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     * @param string
     *
    **/
    public function addScript($layout, $model, $isPopUp = false){

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        
        $cs->registerCssFile($baseUrl . '/css/site/content/conta/main.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerCssFile($baseUrl . '/css/site/content/'. $layout .'.css', 'screen', CClientScript::POS_HEAD);
        $cs->registerCssFile($baseUrl . '/css/site/layout/layout_'. $model .'.css', 'screen', CClientScript::POS_HEAD);
    
        //Funcionalidades de comportamento só para a home do conta.
        //Para cada vez que esse Javascript for adicionado uma vez a mais será atachado listeners nos
        $cs->registerScriptFile($baseUrl . '/js/lib/md5/md5_script.js', CClientScript::POS_END);  
        $cs->registerScriptFile($baseUrl . '/js/site/conta/login/main_login.js', CClientScript::POS_END);  
    }
}

?>