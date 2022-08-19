<?php

$this->controller->pageTitle = $result['titulo_pagina'];
$this->controller->siteAuthor = $result['preferences']['titulo'];
$this->controller->pageMetatags = $result['preferences']['metatags'];
$this->controller->pageDescription = $result['preferences']['descricao'];
$this->controller->productTitle = $result['preferences']['titulo'];
$this->controller->productDescription = $result['preferences']['descricao'];

$this->controller->facebook_app_id = $result['id_app'];
$this->controller->iconApp = $result['site_data']['logo_app'];
$this->controller->facebookProfile = $result['site_data']['facebook'];
$this->controller->twitterProfile = $result['site_data']['twitter'];
$this->controller->orkutProfile = $result['site_data']['orkut'];
$this->controller->linkedinProfile = $result['site_data']['linkedin'];
$this->controller->google_tag_manager = $result['site_data']['google_tags_manager'];
$this->controller->canalYoutubeProfile = $result['site_data']['canal_youtube'];
$this->controller->flickr_profile = $result['site_data']['flickr'];;
$this->controller->instagram_profile = $result['site_data']['instagram'];
$this->controller->pinterest_profile = $result['site_data']['pinterest'];

if(Yii::app()->params['ssl']){$http = 'https://';}else{$http = 'http://';}
 //More data for Facebook
 for($i = 1; $i <= 10; $i++){
     if(isset($result['graphics']['container_' . $i]) && $result['graphics']['container_' . $i] != '') $cs->registerMetaTag($http . "{$_SERVER['SERVER_NAME']}/media/user/images/original/"  . $result['graphics']['container_' . $i]['foto'], null,null,array('property'=>'og:image'));
     if(isset($result['attributes']['fb_slot_' . $i]) && $result['attributes']['fb_slot_' . $i] != '') $cs->registerMetaTag($http . "{$_SERVER['SERVER_NAME']}/media/user/images/original/"  . $result['attributes']['fb_slot_' . $i], null,null,array('property'=>'og:image'));
 }
 
 $cs->registerMetaTag($http . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'], null,null,array('property'=>'og:url'));
 if($result['site_data']['logo_rede_sociais'] != '') $cs->registerMetaTag($http . "{$_SERVER['SERVER_NAME']}/media/user/images/original/"  . $result['site_data']['logo_rede_sociais'], null,null,array('property'=>'og:image'));
 
 //Se tiver sido adicionado um conteúd special na página
 if($result['attributes']['fb_titulo'] != '') $this->controller->productTitle = $result['attributes']['fb_titulo'];
 if($result['attributes']['fb_texto'] != '')  $this->controller->productDescription = $result['attributes']['fb_texto'];

?>