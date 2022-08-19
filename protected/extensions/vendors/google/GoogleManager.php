<?php
/*
 * This Class is used to set and retrieve user Atributes
 * @author CarlosGarcia
 *
 * Data: 06/01/2011
 */

class GoogleManager{
    
    /**
     *
     * Desktop, Tablets, Mobile
     *
     * Método para incluir os css necessários para montar o layout
     *
     * Repare que existe um layout para o site e um outro para a página
     * Os layouts são aplicados via comando Javascript
     *
     */
    public function getAnalyticsCompose($data){
        
        require_once __DIR__.'/autoload.php';
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

      
        try{
            //include the api lib
            //include_once "protected/extensions/vendors/google/examples/templates/base.php";
            $view_id = PreferencesUtils::getPreferedItem('google_analytics_view');
            if(!$view_id || $view_id == 0 || $view_id == '') return false;

            // Start the google v3 api server authorization
            $client = new Google_Client();
            $client->setApplicationName('PurplePier');
            
            $cred = new Google_Auth_AssertionCredentials(
               '413759533316-cqg8vmkaqh4qf7b9nn5e7k38muojmv2o@developer.gserviceaccount.com',
               array('https://www.googleapis.com/auth/analytics.readonly'),
               file_get_contents('media/documentos/PurplePier-f64f505c32f4.p12')
            );
            //return array();
            $client->setAssertionCredentials($cred);
            if($client->getAuth()->isAccessTokenExpired()) {
               $refresh = $client->getAuth()->refreshTokenWithAssertion($cred);               
            }
          
            //start the analytics shtuff
            $service = new Google_Service_Analytics($client);

            // requesting the data
            $google_data = $service->data_ga->get(
               "ga:" . $view_id,  //this is the account id you made a note of in step 5
               $data['date_start'],
               $data['date_end'],
               $data['metrics'],
               array(
                  'dimensions' => 'ga:date'
                  //add filters and any other parameters here
               )
            );
            //var_dump($google_data);
            return $google_data;
            

        }catch(CDbException $e){
            echo 'ERROR: GoogleManager - getAnalytics() ' . $e->getMessage();
        }        
    }

    /**
     *
     * Desktop, Tablets, Mobile
     *
     * Método para incluir os css necessários para montar o layout
     *
     * Repare que existe um layout para o site e um outro para a página
     * Os layouts são aplicados via comando Javascript
     *
     */
    public function getAnalytics(){
        
        require_once __DIR__.'/autoload.php';
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

      
        try{
            //include the api lib
            //include_once "protected/extensions/vendors/google/examples/templates/base.php";
            $view_id = PreferencesUtils::getPreferedItem('google_analytics_view');
            if(!$view_id || $view_id == 0 || $view_id == '') return false;

            // Start the google v3 api server authorization
            $client = new Google_Client();
            $client->setApplicationName('purplepierwebapp');
            
            $cred = new Google_Auth_AssertionCredentials(
               '413759533316-cqg8vmkaqh4qf7b9nn5e7k38muojmv2o@developer.gserviceaccount.com',
               array('https://www.googleapis.com/auth/analytics.readonly'),
               file_get_contents('media/documentos/PurplePier-f64f505c32f4.p12')
            );

            $client->setAssertionCredentials($cred);
            if($client->getAuth()->isAccessTokenExpired()) {
               $client->getAuth()->refreshTokenWithAssertion($cred);
            }
            
            $dtend = date("Y-m-d");
            //$dtstart = date( "Y-m-d", strtotime( "$dtend -30 day" ) );
            $dtstart = date( "Y") . "-" . date( "m") . "-" . '01';
            
            $date_start = $dtstart;            
            $date_end = $dtend;

            //start the analytics shtuff
            $service = new Google_Service_Analytics($client);
            $accounts =  $service->management_accountSummaries->listManagementAccountSummaries();

            // requesting the data
            $google_data = $service->data_ga->get(
               "ga:" . $view_id,  //this is the account id you made a note of in step 5
               $date_start,
               $date_end,
               "ga:users,ga:sessions, ga:sessionDuration, ga:pageviews, ga:bounces, ga:entrances, ga:exits, ga:avgSessionDuration",
               array(
                  //'dimensions' => 'ga:pagePath'
                  //add filters and any other parameters here
               )
            );

            return $google_data;

        }catch(CDbException $e){
            echo 'ERROR: GoogleManager - getAnalytics() ' . $e->getMessage();
        }        
    }
    
    /**
     *
     * Desktop, Tablets, Mobile
     *
     * Método para incluir os css necessários para montar o layout
     *
     * Repare que existe um layout para o site e um outro para a página
     * Os layouts são aplicados via comando Javascript
     *
     */
    public function getGeoAnalytics(){
        
        //Don't change this order
        require_once __DIR__.'/autoload.php';
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

      
        try{
            //include the api lib
            //include_once "protected/extensions/vendors/google/examples/templates/base.php";
            $view_id = PreferencesUtils::getPreferedItem('google_analytics_view');
            if(!$view_id || $view_id == 0 || $view_id == '') return false;

            // Start the google v3 api server authorization
            $client = new Google_Client();
            $client->setApplicationName('purplepierwebapp');
            
            $cred = new Google_Auth_AssertionCredentials(
               '413759533316-cqg8vmkaqh4qf7b9nn5e7k38muojmv2o@developer.gserviceaccount.com',
               array('https://www.googleapis.com/auth/analytics.readonly'),
               file_get_contents('media/documentos/PurplePier-f64f505c32f4.p12')
            );

            $client->setAssertionCredentials($cred);
            if($client->getAuth()->isAccessTokenExpired()) {
               $client->getAuth()->refreshTokenWithAssertion($cred);
            }
            
            $dtend = date("Y-m-d");
            //$dtstart = date( "Y-m-d", strtotime( "$dtend -30 day" ) );
            $dtstart = date( "Y") . "-" . date( "m") . "-" . '01';
            
            $date_start = $dtstart;            
            $date_end = $dtend;

            //start the analytics shtuff
            $service = new Google_Service_Analytics($client);
            $accounts =  $service->management_accountSummaries->listManagementAccountSummaries();

            // requesting the data
            $google_data = $service->data_ga->get(
               "ga:" . $view_id,  //this is the account id you made a note of in step 5
               $date_start,
               $date_end,
               "ga:users, ga:sessionDuration, ga:bounces",
               array(
                  'dimensions' => 'ga:city, ga:country, ga:countryIsoCode',
                  'metrics' => 'ga:users',
                  'sort'=> 'ga:country, ga:users'                   

               )
            );

            return $google_data;

        }catch(CDbException $e){
            echo 'ERROR: GoogleManager - getAnalytics() ' . $e->getMessage();
        }        
    }
    
    /**
     *
     * Método para obter os Analytics
     *
     */
    public function getAnalyticsData(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $result['users'] = PreferencesUtils::getAttributes('google_analytics_users', 'texto');
        $result['pageviews'] = PreferencesUtils::getAttributes('google_analytics_pageviews', 'texto');
        $result['sessions'] = PreferencesUtils::getAttributes('google_analytics_sessions', 'texto');
        
        return $result;
    }
    
    /**
     * Gets last posts
     * 
     * @return array
     *  
     */
    public function getLastPostsGooglePlus($limit = 5){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        require_once __DIR__.'/autoload.php';
        
        $page = PreferencesUtils::getPreferedItem('google_mais_um');
        
        // Start the google v3 api server authorization
        $client = new Google_Client();
        $client->setApplicationName('purplepierwebapp');
        
        $apiKey = "AIzaSyDItX3LaLES7oC1UUzLHZlYWpKNvA1IXz4"; // Change this line.
        //
        //$client = new Google_Client();
        $client->setDeveloperKey($apiKey);
        $plus = new Google_Service_Plus($client);
        $optParams = array('maxResults' => $limit);
        
        if($page && $page != ''){
            $activities = $plus->activities->listActivities($page, "public", $optParams);
        }else{
            $activities = false;
        }

        return $activities;
        
        /*
        $items = $activities->getItems();
        //echo MethodUtils::prettyJson(json_decode($activities));
        //var_dump($activities);
      

        foreach($items as $item){
            $object = $item->getObject();
            $attch = $object['attachments'];
                        //var_dump($attch);
            //echo "Object: " . $object->getContent() ."</br>";
            //print "{$item['object']['attachments']}";
            echo "Title: {$attch[0]['displayName']}</br>";
            //print "<img src='{$attch[0]['image']['url']}'/> </br>";
            print "<img src='{$attch[0]['fullImage']['url']}'/> </br>";
            //var_dump($item);
            //echo MethodUtils::prettyJson($item['attachments']);
            
            echo "Object: " . $object->getContent() ."</br>"; 
            echo "Url: " . $object->getUrl() ."</br>"; 
            echo "Actor: " . $item['actor']['displayName'] ."</br>"; 
            
            echo "</br></br>";
            echo "Title:". $item['title'] ."</br>";
            echo "Url:". $item['url'] ."</br>";
            echo "Replies:". $item['replies'] ."</br>";
            echo "DAta:". $item['updated'] ."</br>"; 
        }
        */
        
    }
    
    /**
     *
     * Método para obter as estatisticas
     *
     */
    public function getLastPosts(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $results = array();
        
        $result1['gp_post'] = PreferencesUtils::getAttributes('gp_post_1', 'texto');
        $result1['gp_data'] = PreferencesUtils::getAttributes('gp_data_1', 'texto');
        $result1['gp_image'] = PreferencesUtils::getAttributes('gp_image_1', 'texto');
        $result1['gp_description'] = PreferencesUtils::getAttributes('gp_description_1', 'texto');
        $result1['gp_name'] = PreferencesUtils::getAttributes('gp_name_1', 'texto');
        $result1['gp_link'] = PreferencesUtils::getAttributes('gp_link_1', 'texto');
        $results[0] = $result1;
        
        $result2['gp_post'] = PreferencesUtils::getAttributes('gp_post_2', 'texto');
        $result2['gp_data'] = PreferencesUtils::getAttributes('gp_data_2', 'texto');
        $result2['gp_image'] = PreferencesUtils::getAttributes('gp_image_2', 'texto');
        $result2['gp_description'] = PreferencesUtils::getAttributes('gp_description_2', 'texto');
        $result2['gp_name'] = PreferencesUtils::getAttributes('gp_name_2', 'texto');
        $result2['gp_link'] = PreferencesUtils::getAttributes('gp_link_2', 'texto');
        $results[1] = $result2;
        
        $result3['gp_post'] = PreferencesUtils::getAttributes('gp_post_3', 'texto');
        $result3['gp_data'] = PreferencesUtils::getAttributes('gp_data_3', 'texto');
        $result3['gp_image'] = PreferencesUtils::getAttributes('gp_image_3', 'texto');
        $result3['gp_description'] = PreferencesUtils::getAttributes('gp_description_3', 'texto');
        $result3['gp_name'] = PreferencesUtils::getAttributes('gp_name_3', 'texto');
        $result3['gp_link'] = PreferencesUtils::getAttributes('gp_link_3', 'texto');
        $results[2] = $result3;
        
        $result4['gp_post'] = PreferencesUtils::getAttributes('gp_post_4', 'texto');
        $result4['gp_data'] = PreferencesUtils::getAttributes('gp_data_4', 'texto');
        $result4['gp_image'] = PreferencesUtils::getAttributes('gp_image_4', 'texto');
        $result4['gp_description'] = PreferencesUtils::getAttributes('gp_description_4', 'texto');
        $result4['gp_name'] = PreferencesUtils::getAttributes('gp_name_4', 'texto');
        $result4['gp_link'] = PreferencesUtils::getAttributes('gp_link_4', 'texto');
        $results[3] = $result4;
        
        $result5['gp_post'] = PreferencesUtils::getAttributes('gp_post_5', 'texto');
        $result5['gp_data'] = PreferencesUtils::getAttributes('gp_data_5', 'texto');
        $result5['gp_image'] = PreferencesUtils::getAttributes('gp_image_5', 'texto');
        $result5['gp_description'] = PreferencesUtils::getAttributes('gp_description_5', 'texto');
        $result5['gp_name'] = PreferencesUtils::getAttributes('gp_name_5', 'texto');
        $result5['gp_link'] = PreferencesUtils::getAttributes('gp_link_5', 'texto');
        $results[4] = $result5;
       
        //var_dump($results);
        return $results;
    }

}
?>