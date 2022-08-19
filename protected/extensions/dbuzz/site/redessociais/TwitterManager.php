<?php

/*
 * This Class works with Twitter Network
 * It's using a PHP Twitter SDK 
 * 
 *
 * @author CarlosGarcia
 *
 */

class TwitterManager{
    
    /**
     * Gets the App Twitter infos
     * 
     * @return array
     *  
     */
    public function getAppInfos(){
       
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        $data['consumer_key'] = PreferencesUtils::getAttributes("twitter_consumer_key", "texto");
        $data['consumer_secret'] = PreferencesUtils::getAttributes("twitter_consumer_secret", "texto");
        $data['access_token'] = PreferencesUtils::getAttributes("twitter_access_token", "texto");
        $data['access_secret'] = PreferencesUtils::getAttributes("twitter_access_secret", "texto");
        
        return $data;
    }
    
    /**
     *
     * Método para obter as estatisticas
     *
     */
    public function getLastPosts(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $results = array();
        
        $result1['tw_post'] = PreferencesUtils::getAttributes('tw_post_1', 'texto');
        $result1['tw_data'] = PreferencesUtils::getAttributes('tw_data_1', 'texto');
        $result1['tw_image'] = PreferencesUtils::getAttributes('tw_image_1', 'texto');
        $result1['tw_description'] = PreferencesUtils::getAttributes('tw_description_1', 'texto');
        $result1['tw_name'] = PreferencesUtils::getAttributes('tw_name_1', 'texto');
        $result1['tw_link'] = PreferencesUtils::getAttributes('tw_link_1', 'texto');
        $results[0] = $result1;
        
        $result2['tw_post'] = PreferencesUtils::getAttributes('tw_post_2', 'texto');
        $result2['tw_data'] = PreferencesUtils::getAttributes('tw_data_2', 'texto');
        $result2['tw_image'] = PreferencesUtils::getAttributes('tw_image_2', 'texto');
        $result2['tw_description'] = PreferencesUtils::getAttributes('tw_description_2', 'texto');
        $result2['tw_name'] = PreferencesUtils::getAttributes('tw_name_2', 'texto');
        $result2['tw_link'] = PreferencesUtils::getAttributes('tw_link_2', 'texto');
        $results[1] = $result2;
        
        $result3['tw_post'] = PreferencesUtils::getAttributes('tw_post_3', 'texto');
        $result3['tw_data'] = PreferencesUtils::getAttributes('tw_data_3', 'texto');
        $result3['tw_image'] = PreferencesUtils::getAttributes('tw_image_3', 'texto');
        $result3['tw_description'] = PreferencesUtils::getAttributes('tw_description_3', 'texto');
        $result3['tw_name'] = PreferencesUtils::getAttributes('tw_name_3', 'texto');
        $result3['tw_link'] = PreferencesUtils::getAttributes('tw_link_3', 'texto');
        $results[2] = $result3;
        
        $result4['tw_post'] = PreferencesUtils::getAttributes('tw_post_4', 'texto');
        $result4['tw_data'] = PreferencesUtils::getAttributes('tw_data_4', 'texto');
        $result4['tw_image'] = PreferencesUtils::getAttributes('tw_image_4', 'texto');
        $result4['tw_description'] = PreferencesUtils::getAttributes('tw_description_4', 'texto');
        $result4['tw_name'] = PreferencesUtils::getAttributes('tw_name_4', 'texto');
        $result4['tw_link'] = PreferencesUtils::getAttributes('tw_link_4', 'texto');
        $results[3] = $result4;
        
        $result5['tw_post'] = PreferencesUtils::getAttributes('tw_post_5', 'texto');
        $result5['tw_data'] = PreferencesUtils::getAttributes('tw_data_5', 'texto');
        $result5['tw_image'] = PreferencesUtils::getAttributes('tw_image_5', 'texto');
        $result5['tw_description'] = PreferencesUtils::getAttributes('tw_description_5', 'texto');
        $result5['tw_name'] = PreferencesUtils::getAttributes('tw_name_5', 'texto');
        $result5['tw_link'] = PreferencesUtils::getAttributes('tw_link_5', 'texto');
        $results[4] = $result5;
       
        //var_dump($results);
        return $results;
    }
    
    /**
     * Gets last posts
     * 
     * @return array
     *  
     */
    public function getLastPostsTwitter($limit = 5){
        
        $data = $this->getAppInfos();
        
        if($data['consumer_key'] != ''){
            Yii::app()->twitter->consumer_key = $data['consumer_key'];
            Yii::app()->twitter->consumer_secret = $data['consumer_secret'];

            Yii::app()->twitter->user_token = $data['access_token'];
            Yii::app()->twitter->user_secret = $data['access_secret'];

            $result = Yii::app()->twitter->rssFeed("user", array('count' => $limit)); 
            
        }else{
            $result = false;
        }
        
        return $result;
    }
}
?>