<?php

/**
 * Description of RedeSociaisUtils
 *
 * Here are some method to make easier the class banners
 *
 * @author CarlosGarcia
 */
class RedesSociaisUtils{
    
    /**
     * Método para setar o envio do email
     *
     * @param POST
     *
    */
    public static function updateRedesSociais(){
        
        Yii::import('application.extensions.dbuzz.site.redessociais.FacebookManager');
        Yii::import('application.extensions.dbuzz.site.redessociais.TwitterManager');
        Yii::import('application.extensions.vendors.google.GoogleManager');
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $googleHandler = new GoogleManager();
        $twitterHandler = new TwitterManager();
        $facebookHandler = new FacebookManager();
        
        $result = array();
        
        //Facebook
        $postsFacebook = $facebookHandler->getLastPostsFacebook();
        if($postsFacebook) $result['facebook'] = RedesSociaisUtils::saveFacebook($postsFacebook);
        
        //GooglePlus
        $postsGoogle = $googleHandler->getLastPostsGooglePlus();
        if($postsGoogle) $result['google'] = RedesSociaisUtils::saveGooglePlus($postsGoogle);
        
        //Twitter
        $postsTwitter = $twitterHandler->getLastPostsTwitter();
        if($postsTwitter) $result['twitter'] = RedesSociaisUtils::saveTwitter($postsTwitter);
        
        return $result;
    }
    
    /*
     * Facebook 
     */
    public static function saveFacebook($posts){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $save = false;
        if($posts){
            $p = 1;
            foreach ($posts as $post){
                //Get
                $postId = $post->getProperty('id');
                $name = $post->getProperty('name');
                $description = $post->getProperty('description');
                $postMessage = $post->getProperty('message');
                $image = $post->getProperty('picture');
                $link = $post->getProperty('link');
                $data = DateTimeUtils::getDateFormatFromWebHook($post->getProperty('created_time'));
                
                //Set
                $save = PreferencesUtils::setAttributes('fb_post_' . $p, $postMessage, 'texto');
                $save = PreferencesUtils::setAttributes('fb_data_' . $p, $data, 'texto');
                $save = PreferencesUtils::setAttributes('fb_image_' . $p, $image, 'texto');
                $save = PreferencesUtils::setAttributes('fb_name_' . $p, $name, 'texto');
                $save = PreferencesUtils::setAttributes('fb_description_' . $p, $description, 'texto');
                $save = PreferencesUtils::setAttributes('fb_link_' . $p, $link, 'texto');
                
                $p++;
            }
        }
        
        return $save;
    }
    
    /*
     * Google Plus
     */
    public static function saveGooglePlus($posts){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $save = false;
        if($posts){
            $p = 1;
            
            $items = $posts->getItems();

            foreach($items as $item){
        
                $object = $item->getObject();
                $attch = $object['attachments'];
                //Set
                $save = PreferencesUtils::setAttributes('gp_post_' . $p, $item['title'], 'texto');
                $save = PreferencesUtils::setAttributes('gp_data_' . $p, DateTimeUtils::getDateFormatFromWebHook($item['updated']), 'texto');
                //$save = PreferencesUtils::setAttributes('gp_image_' . $p, $attch[0]['fullImage']['url'], 'texto');
                $save = PreferencesUtils::setAttributes('gp_image_' . $p, $attch[0]['image']['url'], 'texto');
                $save = PreferencesUtils::setAttributes('gp_name_' . $p, $item['actor']['displayName'], 'texto');
                $save = PreferencesUtils::setAttributes('gp_description_' . $p, $attch[0]['displayName'], 'texto');
                $save = PreferencesUtils::setAttributes('gp_link_' . $p, $item['url'], 'texto');
                
                $p++;
            }

        }
        
        return $save;
    }
    
    /*
     * Twitter
     */
    public static function saveTwitter($posts){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $save = false;
        if($posts){
            $p = 1; $result = json_decode($posts, true);
            
            foreach($result as $item){
        
                //Set
                $save = PreferencesUtils::setAttributes('tw_post_' . $p, $item['text'], 'texto');
                $save = PreferencesUtils::setAttributes('tw_data_' . $p, DateTimeUtils::getDateFormatFromWebHook2($item['created_at']), 'texto');
                $save = PreferencesUtils::setAttributes('tw_image_' . $p, $item['user']['profile_image_url'], 'texto');
                $save = PreferencesUtils::setAttributes('tw_name_' . $p, $item['user']['name'], 'texto');
                $save = PreferencesUtils::setAttributes('tw_description_' . $p, $item['text'], 'texto');//Não utlizado
                $save = PreferencesUtils::setAttributes('tw_link_' . $p, "https://twitter.com/{$item['user']['name']}/status/{$item['id_str']}", 'texto');
                
                $p++;
            }

        }
        
        return $save;
    }
}
?>