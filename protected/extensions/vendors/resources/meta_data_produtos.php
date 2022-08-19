<?php

if(!isset($result['content']['nome'])) $result['content'] = array('nome' => '', 'keywords' => '', 'descricao_resumo' => '');
$this->controller->pageTitle = $result['content']['nome'];
if($result['content']['nome'] == '' && (isset($result['page_title']) && $result['page_title'] != '')) $this->controller->pageTitle = $result['page_title'];
$this->controller->siteAuthor = $result['preferences']['titulo'];
$this->controller->pageMetatags = $result['content']['keywords'];
$this->controller->pageDescription = $result['content']['descricao_resumo'];
$this->controller->productTitle = $result['content']['nome'];
$this->controller->productDescription = $result['content']['descricao_resumo'];

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
if(isset($result['evento_selecionado']['picture']['container']['foto'])) $foto_redesocial = $result['evento_selecionado']['picture']['container']['foto']; else $foto_redesocial = '';

 $cs->registerMetaTag($http . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'], null,null,array('property'=>'og:url'));
 //More data for Facebook
 if($foto_redesocial != '') $cs->registerMetaTag($http . "{$_SERVER['SERVER_NAME']}/media/user/images/original/"  . $foto_redesocial, null,null,array('property'=>'og:image'));


?>