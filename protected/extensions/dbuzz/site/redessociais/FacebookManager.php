<?php

/*
 * This Class works with Facebook Network
 * It's using a PHP Facebook SDK 
 * 
 *
 * @author CarlosGarcia
 *
 */

class FacebookManager{
    
    /**
    * Method to retrieve the content from the follow table:
    * Paginas, materias
    * 
    * @param string
    * @param string
    *
    **/
    public function initFacebookApi($url_return){
        
        try{
            $data_app = $this->getAppInfos();
            
            //Define
            $loginUrl = false;
            $user_profile = false;

            if($data_app['id_app'] != "" && $data_app['id_app'] != "0"){
                
                session_start();
                require_once 'protected/extensions/vendors/Facebook/autoload.php'; 
                
                // init app with app id and secret
                Facebook\FacebookSession::setDefaultApplication($data_app['id_app'], $data_app['secret']);
                $helper = new Facebook\FacebookRedirectLoginHelper($url_return);
                $session = $helper->getSessionFromRedirect();

                // see if we have a session
                if(isset($session)){
                    // graph api request for user data
                    $request = new FacebookRequest($session, 'GET', '/me');
                    $response = $request->execute();
                    // get response
                    $user_profile = $response->getGraphObject();

                    //print data: echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';            
                    
                session_write_close();;
                
                }else{
                    // show login url: echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
                    $loginUrl = $helper->getLoginUrl();
                }  
              
            }
    
            $result = array('logged_in' => true, 'url' => $loginUrl, 'user_profile' => $user_profile);        
            return $result;
           
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: HelperUtils - getPageBundle() "  . $e->getMessage();
        }
    }
    
    /**
     * Gets the App Facebook infos
     * 
     * @return array
     *  
     */
    public function getAppInfos(){
       
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $data['id_app'] = PreferencesUtils::getAttributes("id_app_fb", "texto");
        $data['secret'] = PreferencesUtils::getAttributes("secret_fb", "texto");
        $data['token'] = PreferencesUtils::getAttributes("token_fb", "texto");
        $data['id_page'] = PreferencesUtils::getAttributes("id_page_fb", "texto");
        
        return $data;
    }
    
    /**
     * Admin
     * Get permission and saves the info the user
     * that have permited that.
     * 
     * @param string $data 
     * 
     */
    public function getPermission($user, $token){
         
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        PreferencesUtils::setAttributes("token_fb", $token, "texto");
         
        $message = "Olá, {$user->getName()} você agora pode usar dos recursos Facebook pelo PurplePier® ";         
        return $message;  
    }
    
    /**
     * Admin
     * Get permission and saves the info the user
     * that have permited that.
     * 
     * @param string $data 
     * 
     */
    public function saveUserData($data, $isFullSaving = true){
        
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.utils.ContadorVisitasUtils');
        
        $result['app_info'] = $this->getAppInfos();
        
        session_start();        
        require_once 'protected/extensions/vendors/Facebook/autoload.php';        

        // init app with app id and secret
        Facebook\FacebookSession::setDefaultApplication( $result['app_info']['id_app'], $result['app_info']['secret'] );
        $helper = new Facebook\FacebookRedirectLoginHelper($data['redirect_url']);
        $session = $helper->getSessionFromRedirect();

        if($session){

            try{
                //Pega todas as informações
                $object = (new Facebook\FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject();
                $user = $object->cast(Facebook\GraphUser::className());
                //echo "Name: " . $user->getName() . "</br> Token: " . $session->getToken();
                
                //if($session->getToken() !== ""){ $result['autoriza'] = $this->facebookHandler->getPermission($user, $session->getToken());}
                
                $session0 = MethodUtils::setSessionData("name_facebook", $user->getFirstName()); //echo $user->getFirstName() . "</br>";
                $session1 = MethodUtils::setSessionData("lastname_facebook", $user->getMiddleName() . " " . $user->getLastName()); //echo $user->getMiddleName() . " " . $user->getLastName() . "</br>";
                $session2 = MethodUtils::setSessionData("email_facebook", $user->getProperty('email')); //echo $user->getProperty('email') . "</br>";
                $session3 = MethodUtils::setSessionData("birthday_facebook", ''); //echo  $user->getBirthday() . "</br>";
                $session4 = MethodUtils::setSessionData("picture_facebook", "https://graph.facebook.com/{$user->getId()}/picture/large"); //echo "https://graph.facebook.com/{$user->getId()}/picture/large" . "</br>";
                $session5 = MethodUtils::setSessionData("id_facebook", $user->getId()); //echo $user->getId() . "</br>";
                $session6 = MethodUtils::setSessionData("perfil_facebook", $user->getLink()); //echo $user->getLink(). "</br>";

                if($isFullSaving){$id_user = UserSupportUtils::createUserAccountFromSession("facebook");}     
                
                $identity=new UserIdentity($user->getProperty('email'), '1234');
                $identity->authenticate(true);
               
                $set = MethodUtils::setSessionData('logado', '1');
                $set = MethodUtils::setSessionData('user_account_type', '0');
                $set = MethodUtils::setSessionData('id', $id_user);
                $set = MethodUtils::setSessionData('id_user', $id_user);
                $set = MethodUtils::setSessionData('field1', $user->getFirstName());
                $set = MethodUtils::setSessionData('field2', $user->getLastName());
                $set = MethodUtils::setSessionData('avatar', "https://graph.facebook.com/{$user->getId()}/picture/large");
                $addVisit = ContadorVisitasUtils::setVisit("conta");
                return $user;

            }catch(FacebookRequestException $e){
                echo "Exception occured, code: " . $e->getCode();
                echo " with message: " . $e->getMessage();
            }
            
        }else{
            return "Erro de validação";
        }   
    } 
    
    /**
     * It get the FanPages availables
     * All pages that the user signed into admin will be available
     * into FacebookPublish.
     * 
     * @return array 
     * 
    **/
    public function getFanPages(){
      
        $data_app = $this->getAppInfos();
        
        require_once 'protected/extensions/vendors/Facebook/facebook.php';

        //Create our Application instance.
        $facebook = new Facebook(array(
          'appId'  => $data_app['id_app'],
          'secret' => $data_app['secret']
        ));

        try{               
            //PEga todos as Fan pages disponivel para publicacao.
            $info = $facebook->api("/me/accounts", array('access_token' => $data_app['token'])); 
            return $info;    
            
        }catch(FacebookApiException $e){
            //return false;
            return json_encode($e);
        }
    }
    
    /**
     * It get the Facebook statistics
     * 
     * @return array 
     * 
    **/
    public function getFacebookStatistics($url){

        try{               
            //Pega todos as Fan pages disponivel para publicacao.            
            $fql  = "SELECT url, normalized_url, share_count, like_count, comment_count, ";
            $fql .= "total_count, commentsbox_count, comments_fbid, click_count FROM ";
            $fql .= "link_stat WHERE url = '$url'";

            $apifql="https://api.facebook.com/method/fql.query?format=json&query=".urlencode($fql);
            $json=file_get_contents($apifql);
            $result = json_decode($json);
            //print_r($result);
            return $result;
            
        }catch(FacebookApiException $e){
            //return false;
            return json_encode($e);
        }
    }
    
    /**
     *
     * Método para obter as estatisticas
     *
     */
    public function getAnalyticsData(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $result['share'] = PreferencesUtils::getAttributes('facebook_share', 'texto');
        $result['likes'] = PreferencesUtils::getAttributes('facebook_like', 'texto');
       
        return $result;
    }
    
    /**
     *
     * Método para obter as estatisticas
     *
     */
    public function getLastPosts(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $results = array();
        
        $result1['fb_post'] = PreferencesUtils::getAttributes('fb_post_1', 'texto');
        $result1['fb_data'] = PreferencesUtils::getAttributes('fb_data_1', 'texto');
        $result1['fb_image'] = PreferencesUtils::getAttributes('fb_image_1', 'texto');
        $result1['fb_description'] = PreferencesUtils::getAttributes('fb_description_1', 'texto');
        $result1['fb_name'] = PreferencesUtils::getAttributes('fb_name_1', 'texto');
        $result1['fb_link'] = PreferencesUtils::getAttributes('fb_link_1', 'texto');
        $results[0] = $result1;
        
        $result2['fb_post'] = PreferencesUtils::getAttributes('fb_post_2', 'texto');
        $result2['fb_data'] = PreferencesUtils::getAttributes('fb_data_2', 'texto');
        $result2['fb_image'] = PreferencesUtils::getAttributes('fb_image_2', 'texto');
        $result2['fb_description'] = PreferencesUtils::getAttributes('fb_description_2', 'texto');
        $result2['fb_name'] = PreferencesUtils::getAttributes('fb_name_2', 'texto');
        $result2['fb_link'] = PreferencesUtils::getAttributes('fb_link_2', 'texto');
        $results[1] = $result2;
        
        $result3['fb_post'] = PreferencesUtils::getAttributes('fb_post_3', 'texto');
        $result3['fb_data'] = PreferencesUtils::getAttributes('fb_data_3', 'texto');
        $result3['fb_image'] = PreferencesUtils::getAttributes('fb_image_3', 'texto');
        $result3['fb_description'] = PreferencesUtils::getAttributes('fb_description_3', 'texto');
        $result3['fb_name'] = PreferencesUtils::getAttributes('fb_name_3', 'texto');
        $result3['fb_link'] = PreferencesUtils::getAttributes('fb_link_3', 'texto');
        $results[2] = $result3;
        
        $result4['fb_post'] = PreferencesUtils::getAttributes('fb_post_4', 'texto');
        $result4['fb_data'] = PreferencesUtils::getAttributes('fb_data_4', 'texto');
        $result4['fb_image'] = PreferencesUtils::getAttributes('fb_image_4', 'texto');
        $result4['fb_description'] = PreferencesUtils::getAttributes('fb_description_4', 'texto');
        $result4['fb_name'] = PreferencesUtils::getAttributes('fb_name_4', 'texto');
        $result4['fb_link'] = PreferencesUtils::getAttributes('fb_link_4', 'texto');
        $results[3] = $result4;
        
        $result5['fb_post'] = PreferencesUtils::getAttributes('fb_post_5', 'texto');
        $result5['fb_data'] = PreferencesUtils::getAttributes('fb_data_5', 'texto');
        $result5['fb_image'] = PreferencesUtils::getAttributes('fb_image_5', 'texto');
        $result5['fb_description'] = PreferencesUtils::getAttributes('fb_description_5', 'texto');
        $result5['fb_name'] = PreferencesUtils::getAttributes('fb_name_5', 'texto');
        $result5['fb_link'] = PreferencesUtils::getAttributes('fb_link_5', 'texto');
        $results[4] = $result5;
       
        //var_dump($results);
        return $results;
    }
    
    /**
     *
     * Método para obter os ultimos post
     *
     */
    public function getLastPostsFacebook($limit = 5){
            
        session_start();        
        require_once 'protected/extensions/vendors/Facebook/autoload.php'; 
        
        $result['app_info'] = $this->getAppInfos();
        $pageId = $result['app_info']['id_page']; //100003828669559 - DigitalPier // 1665840123651431 - Orcamentus
        
        // init app with app id and secret
        Facebook\FacebookSession::setDefaultApplication( $result['app_info']['id_app'], $result['app_info']['secret'] );
        $helper = new Facebook\FacebookRedirectLoginHelper("http://". $_SERVER['SERVER_NAME'] . "/admin/facebook/autoriza");
        //$session = $helper->getSessionFromRedirect();
        
        $session = new Facebook\FacebookSession($result['app_info']['token']);
        
        try{
            if($session){              
                
                //echo "</br>";
                $data = (new Facebook\FacebookRequest(
                    $session,
                    'GET', "/$pageId/feed?limit=$limit"
                ))->execute()->getGraphObject()->getPropertyAsArray("data");
                
                /*               
                foreach ($data as $post){
                    $postId = $post->getProperty('id');
                    $name = $post->getProperty('name');
                    $postMessage = $post->getProperty('message');
                    $description = $post->getProperty('description');
                    //$data = DateTimeUtils::getDateFormatFromWebHook($post->getProperty('created_time'));
                    $image = $post->getProperty('picture');
                    //print "$name - $postMessage - $description - $data  <br />";
                    //if($image != '') echo "<img src='$image'/> <br />";
                } */
                
                 
                return $data;
                
            }else{
                return false;
            }
        
        } catch (FacebookRequestException $e) {
            // The Graph API returned an error
            echo $e;
        } catch (\Exception $e) {
            // Some other error occurred
            echo $e;
        }
    }
}
?>