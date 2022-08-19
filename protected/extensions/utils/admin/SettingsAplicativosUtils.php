<?php

/**
 * Description of SettingsAplicativosUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class SettingsAplicativosUtils {


    /**
     * Método para pegar as propriedades dos aplicativos
     *
     *
    */
    public static function updatePurpleStoreAplicativos(){
        
       $session = MethodUtils::getSessionData();
            
       try{
            $dados = "";
            
            //Aplicativos e componentes
            $barra_social = PreferencesUtils::getAttributesComplete('componente_site', 'barra_social');
            if(isset($barra_social['inteiro']) && $barra_social['inteiro'] == 1){$dados .= "const BARRA_SOCIAL = 1;";}else{$dados .= "const BARRA_SOCIAL = 0;";}
            
            //Downloads
            $pierdownloads = PreferencesUtils::getAttributesComplete('componente_site', 'pierdownloads');
            if(isset($pierdownloads['inteiro']) && $pierdownloads['inteiro'] == 1){$dados .= "const PIER_DOWNLOADS = 1;";}else{$dados .= "const PIER_DOWNLOADS = 0;";}
            $setDownloads = SettingsAplicativosUtils::updatePage('downloads', $pierdownloads);
            
            //HiperLinks
            $pierhiperlinks = PreferencesUtils::getAttributesComplete('componente_site', 'pierlinks');
            if(isset($pierhiperlinks['inteiro']) && $pierhiperlinks['inteiro'] == 1){$dados .= "const PIER_HIPERLINKS = 1;";}else{$dados .= "const PIER_HIPERLINKS = 0;";}
            $setHiperlinks = SettingsAplicativosUtils::updatePage('hiperlinks', $pierhiperlinks);
            
            //Videos
            $piervideos = PreferencesUtils::getAttributesComplete('componente_site', 'piervideos');
            if(isset($piervideos['inteiro']) && $piervideos['inteiro'] == 1){$dados .= "const PIER_VIDEOS = 1;";}else{$dados .= "const PIER_VIDEOS = 0;";}
            $setVideos = SettingsAplicativosUtils::updatePage('videos', $piervideos);
            
            //Eventos
            $piereventos = PreferencesUtils::getAttributesComplete('componente_site', 'piereventos');
            if(isset($piereventos['inteiro']) && $piereventos['inteiro'] == 1){$dados .= "const PIER_EVENTOS = 1;";}else{$dados .= "const PIER_EVENTOS = 0;";}
            $setEventos = SettingsAplicativosUtils::updatePage('eventos', $piereventos);
            
            //Galerias
            $piergalerias = PreferencesUtils::getAttributesComplete('componente_site', 'piergalerias');
            if(isset($piergalerias['inteiro']) && $piergalerias['inteiro'] == 1){$dados .= "const PIER_GALERIAS = 1;";}else{$dados .= "const PIER_GALERIAS = 0;";}
            $setGAlerias = SettingsAplicativosUtils::updatePage('galeria', $piergalerias);
            
            //Orcamentus
            $pierorcamentus = PreferencesUtils::getAttributesComplete('componente_site', 'pierorcamentus');
            if(isset($pierorcamentus['inteiro']) && $pierorcamentus['inteiro'] == 1){$dados .= "const PIER_ORCAMENTUS = 1;";}else{$dados .= "const PIER_ORCAMENTUS = 0;";}
            $setOrcamentus = SettingsAplicativosUtils::updatePage('orcamentus', $pierorcamentus);
            
            //Revistas
            $piermagazine = PreferencesUtils::getAttributesComplete('componente_site', 'piermagazine');
            if(isset($piermagazine['inteiro']) && $piermagazine['inteiro'] == 1){$dados .= "const PIER_MAGAZINE = 1;";}else{$dados .= "const PIER_MAGAZINE = 0;";}
            $setRevistas = SettingsAplicativosUtils::updatePage('revista', $piermagazine);
            
            //PierLogin
            $pierlogin = PreferencesUtils::getAttributesComplete('componente_site', 'pier_login');
            if(isset($pierlogin['inteiro']) && $pierlogin['inteiro'] == 1){$dados .= "const PIER_LOGIN = 1;";}else{$dados .= "const PIER_LOGIN = 0;";}
            $setLOgin = SettingsAplicativosUtils::updatePage('login', $pierlogin);
            
            //Materias / Dicas/ Novidades
            $pierarticles = PreferencesUtils::getAttributesComplete('componente_site', 'piermaterias');
            if(isset($pierarticles['inteiro']) && $pierarticles['inteiro'] == 1){$dados .= "const PIER_ARTICLES = 1;";}else{$dados .= "const PIER_ARTICLES = 0;";}
            $setArticles = SettingsAplicativosUtils::updatePage('materias', $pierarticles);
            
            //Portfolio
            $pierportfolio = PreferencesUtils::getAttributesComplete('componente_site', 'pier_portfolio');
            if(isset($pierportfolio['inteiro']) && $pierportfolio['inteiro'] == 1){$dados .= "const PIER_PORTFOLIO = 1;";}else{$dados .= "const PIER_PORTFOLIO = 0;";}
            $setPortfolio = SettingsAplicativosUtils::updatePage('portfolio', $pierportfolio);
            $setPortfolio = SettingsAplicativosUtils::updatePage('portfolio_detalhes', $pierportfolio);
            
            //ERP
            $piererp = PreferencesUtils::getAttributesComplete('componente_site', 'piergestao');
            if(isset($piererp['inteiro']) && $piererp['inteiro'] == 1){$dados .= "const PIER_ERP = 1;";}else{$dados .= "const PIER_ERP = 0;";}
            
            //Pier Relacionamento
            $pier_relacionamento = PreferencesUtils::getAttributesComplete('componente_site', 'pier_relacionamento');
            if(isset($pier_relacionamento['inteiro']) && $pier_relacionamento['inteiro'] == 1){$dados .= "const PIER_RELACIONAMENTOS = 1;";}else{$dados .= "const PIER_RELACIONAMENTOS = 0;";}
            
            //Pier Categorias
            $pier_categorias = PreferencesUtils::getAttributesComplete('componente_site', 'pier_categorias');
            if(isset($pier_categorias['inteiro']) && $pier_categorias['inteiro'] == 1){$dados .= "const PIER_CATEGORIAS = 1;";}else{$dados .= "const PIER_CATEGORIAS = 0;";}
            
            //Pier Banners
            $pier_banners = PreferencesUtils::getAttributesComplete('componente_site', 'pier_banners');
            if(isset($pier_banners['inteiro']) && $pier_banners['inteiro'] == 1){$dados .= "const PIER_BANNERS = 1;";}else{$dados .= "const PIER_BANNERS = 0;";}
            
            //Pier Imagens
            $pier_imagens = PreferencesUtils::getAttributesComplete('componente_site', 'pier_imagens');
            if(isset($pier_imagens['inteiro']) && $pier_imagens['inteiro'] == 1){$dados .= "const PIER_IMAGENS = 1;";}else{$dados .= "const PIER_IMAGENS = 0;";}
            
            //Pier Páginas
            $pier_paginas = PreferencesUtils::getAttributesComplete('componente_site', 'pier_paginas');
            if(isset($pier_paginas['inteiro']) && $pier_paginas['inteiro'] == 1){$dados .= "const PIER_PAGINAS = 1;";}else{$dados .= "const PIER_PAGINAS = 0;";}
            
            //Pier Elearn
            $pier_elearn = PreferencesUtils::getAttributesComplete('componente_site', 'pierelearn');
            if(isset($pier_elearn['inteiro']) && $pier_elearn['inteiro'] == 1){$dados .= "const PIER_ELEARN = 1;";}else{$dados .= "const PIER_ELEARN = 0;";}
            
            //Minisites
            $pierminisites = PreferencesUtils::getAttributesComplete('componente_site', 'pier_minisites');
            if(isset($pierminisites['inteiro']) && $pierminisites['inteiro'] == 1){$dados .= "const PIER_MINISITES = 1;";}else{$dados .= "const PIER_MINISITES = 0;";}
            
            //PierAgenda - Extensão ERP
            $pieragenda = PreferencesUtils::getAttributesComplete('componente_site', 'pieragenda');
            if(isset($pieragenda['inteiro']) && $pieragenda['inteiro'] == 1){$dados .= "const PIER_AGENDA = 1;";}else{$dados .= "const PIER_AGENDA = 0;";}
            
            //PierFacebook - Aplicativo de Logar Facebook
            $pierfacebook = PreferencesUtils::getAttributesComplete('componente_site', 'aplicativo_facebook');
            if(isset($pierfacebook['inteiro']) && $pierfacebook['inteiro'] == 1){$dados .= "const PIER_FACEBOOK = 1;";}else{$dados .= "const PIER_FACEBOOK = 0;";}
            
            //PierHangout - Aplicativo de Hangout
            $pierhangout = PreferencesUtils::getAttributesComplete('componente_site', 'pier_google_hangout');
            if(isset($pierhangout['inteiro']) && $pierhangout['inteiro'] == 1){$dados .= "const PIER_HANGOUT = 1;";}else{$dados .= "const PIER_HANGOUT = 0;";}
            
            //Email Marketing
            $piermail = PreferencesUtils::getAttributesComplete('componente_site', 'piermail');
            if(isset($piermail['inteiro']) && $piermail['inteiro'] == 1){$dados .= "const PIER_MAIL = 1;";}else{$dados .= "const PIER_MAIL = 0;";}
            
            //Email Marketing
            $pierperfilflutuante = PreferencesUtils::getAttributesComplete('componente_site', 'pier_perfilflutuante');
            if(isset($pierperfilflutuante['inteiro']) && $pierperfilflutuante['inteiro'] == 1){$dados .= "const PIER_PERFILFLUTUANTE = 1;";}else{$dados .= "const PIER_PERFILFLUTUANTE = 0;";}
            
            //Pier Intranet
            $pier_intranet = PreferencesUtils::getAttributesComplete('componente_site', 'pier_intranet');
            if(isset($pier_intranet['inteiro']) && $pier_intranet['inteiro'] == 1){$dados .= "const PIER_INTRANET = 1;";}else{$dados .= "const PIER_INTRANET = 0;";}
            
            //PierSMS - Envio de SMS Zenvia
            $piersms = PreferencesUtils::getAttributesComplete('componente_site', 'piersms');
            if(isset($piersms['inteiro']) && $piersms['inteiro'] == 1){$dados .= "const PIER_SMS = 1;";}else{$dados .= "const PIER_SMS = 0;";}
            
            //PierTurbo - Cache do banco em JSON
            $pierturbo = PreferencesUtils::getAttributesComplete('componente_site', 'pierturbo');
            if(isset($pierturbo['inteiro']) && $pierturbo['inteiro'] == 1){$dados .= "const PIER_TURBO = 1;"; MethodUtils::updateDominioData();}else{$dados .= "const PIER_TURBO = 0;";}
            
            //PierDepoimentos - Depoimentos
            $pierdepoimentos = PreferencesUtils::getAttributesComplete('componente_site', 'pierdepoimentos');
            if(isset($pierdepoimentos['inteiro']) && $pierdepoimentos['inteiro'] == 1){$dados .= "const PIER_DEPOIMENTOS = 1;";}else{$dados .= "const PIER_DEPOIMENTOS = 0;";}
            $setDepoimentos = SettingsAplicativosUtils::updatePage('depoimentos', $pierdepoimentos);
            
            //MercadoLivre - Integracao
            $mercadolivre = PreferencesUtils::getAttributesComplete('componente_site', 'mercadolivre');
            if(isset($mercadolivre['inteiro']) && $mercadolivre['inteiro'] == 1){$dados .= "const MERCADOLIVRE = 1;";}else{$dados .= "const MERCADOLIVRE = 0;";}
            
            //PierPesquisas
            $pierpesquisas = PreferencesUtils::getAttributesComplete('componente_site', 'pierpesquisas');
            if(isset($pierpesquisas['inteiro']) && $pierpesquisas['inteiro'] == 1){$dados .= "const PIER_PESQUISAS = 1;";}else{$dados .= "const PIER_PESQUISAS = 0;";}
            
            //PierLayout
            $pierlayout = PreferencesUtils::getAttributesComplete('componente_site', 'pierlayout');
            if(isset($pierlayout['inteiro']) && $pierlayout['inteiro'] == 1){$dados .= "const PIER_LAYOUT = 1;";}else{$dados .= "const PIER_LAYOUT = 0;";}
            
            //PierFornecedor
            $pierfornecedor = PreferencesUtils::getAttributesComplete('componente_site', 'pier_fornecedor');
            if(isset($pierfornecedor['inteiro']) && $pierfornecedor['inteiro'] == 1){$dados .= "const PIER_FORNECEDOR = 1;";}else{$dados .= "const PIER_FORNECEDOR = 0;";}
            $setArticles = SettingsAplicativosUtils::updatePage('sejafornecedor', $pierfornecedor);
            
            //PierLicitacao
            $pierlicitacao = PreferencesUtils::getAttributesComplete('componente_site', 'pier_licitacao');
            if(isset($pierlicitacao['inteiro']) && $pierlicitacao['inteiro'] == 1){$dados .= "const PIER_LICITACAO = 1;";}else{$dados .= "const PIER_LICITACAO = 0;";}
            $setLicitacao = SettingsAplicativosUtils::updatePage('licitacao', $pierlicitacao);
            
            //PierCurriculos
            $piercurriculos = PreferencesUtils::getAttributesComplete('componente_site', 'pier_curriculos');
            if(isset($piercurriculos['inteiro']) && $piercurriculos['inteiro'] == 1){$dados .= "const PIER_CURRICULOS = 1;";}else{$dados .= "const PIER_CURRICULOS = 0;";}
        
            $setCurriculos = SettingsAplicativosUtils::updatePage('trabalheconosco', $piercurriculos);
            
            //PierVagas
            $piervagas = PreferencesUtils::getAttributesComplete('componente_site', 'pier_vagas');
            if(isset($piervagas['inteiro']) && $piervagas['inteiro'] == 1){$dados .= "const PIER_VAGAS = 1;";}else{$dados .= "const PIER_VAGAS = 0;";}
            $setVagas = SettingsAplicativosUtils::updatePage('trabalheconosco', $piervagas);
            if(isset($piercurriculos) && $piercurriculos) SettingsAplicativosUtils::updatePage('trabalheconosco', $piercurriculos);
            
            //PierProspecção
            $pierprospects = PreferencesUtils::getAttributesComplete('componente_site', 'pier_prospects');
            if(isset($pierprospects['inteiro']) && $pierprospects['inteiro'] == 1){$dados .= "const PIER_PROSPECTS = 1;";}else{$dados .= "const PIER_PROSPECTS = 0;";}
            
            //PierDominios
            $pierdominios = PreferencesUtils::getAttributesComplete('componente_site', 'pierdominios');
            if(isset($pierdominios['inteiro']) && $pierdominios['inteiro'] == 1){$dados .= "const PIER_DOMINIOS = 1;";}else{$dados .= "const PIER_DOMINIOS = 0;";}
            
            $pierprodutos = PreferencesUtils::getAttributesComplete('componente_site', 'pierprodutos');
            if(isset($pierprodutos['inteiro']) && $pierprodutos['inteiro'] == 1){$dados .= "const PIER_PRODUTOS = 1;";}else{$dados .= "const PIER_PRODUTOS = 0;";}
            if(isset($pierprodutos) && $pierprodutos) SettingsAplicativosUtils::updatePage('produtos', $pierprodutos);
            if(isset($pierprodutos) && $pierprodutos) SettingsAplicativosUtils::updatePage('produtos_detalhes', $pierprodutos);
            
            $pierecommerce = PreferencesUtils::getAttributesComplete('componente_site', 'pierecommerce');
            if(isset($pierecommerce['inteiro']) && $pierecommerce['inteiro'] == 1){$dados .= "const PIER_ECOMMERCE = 1;";}else{$dados .= "const PIER_ECOMMERCE = 0;";}
            if(isset($pierecommerce) && $pierecommerce) SettingsAplicativosUtils::updatePage('loja', $pierecommerce);
            if(isset($pierecommerce) && $pierecommerce) SettingsAplicativosUtils::updatePage('showcase', $pierecommerce);
            
            //Forum
            $pierforum = PreferencesUtils::getAttributesComplete('componente_site', 'pierforum');
            if(isset($pierforum['inteiro']) && $pierforum['inteiro'] == 1){$dados .= "const PIER_FORUM = 1;";}else{$dados .= "const PIER_FORUM = 0;";}
            if(isset($pierforum) && $pierforum) SettingsAplicativosUtils::updatePage('forum', $pierforum);
            
            //PierComunicator
            $piercomunicator = PreferencesUtils::getAttributesComplete('componente_site', 'piercommunicator');
            if(isset($piercomunicator['inteiro']) && $piercomunicator['inteiro'] == 1){$dados .= "const PIER_COMUNICATOR = 1;";}else{$dados .= "const PIER_COMUNICATOR = 0;";}
            
            //PierPlayground
            $pierplayground = PreferencesUtils::getAttributesComplete('componente_site', 'pierplayground');
            if(isset($pierplayground['inteiro']) && $pierplayground['inteiro'] == 1){$dados .= "const PIER_PLAYGROUND = 1;";}else{$dados .= "const PIER_PLAYGROUND = 0;";}
            
            //PierPublicidadeOnline
            $pierpublicidade_online = PreferencesUtils::getAttributesComplete('componente_site', 'pier_publicidade_online');
            if(isset($pierpublicidade_online['inteiro']) && $pierpublicidade_online['inteiro'] == 1){$dados .= "const PIER_PUBLICIDADE_ONLINE = 1;";}else{$dados .= "const PIER_PUBLICIDADE_ONLINE = 0;";}
            
            //PierPublicidadeFlutuante
            $pierpublicidade_flutuante = PreferencesUtils::getAttributesComplete('componente_site', 'pier_publicidade_flutuante');
            if(isset($pierpublicidade_flutuante['inteiro']) && $pierpublicidade_flutuante['inteiro'] == 1){$dados .= "const PIER_PUBLICIDADE_FLUTUANTE = 1;";}else{$dados .= "const PIER_PUBLICIDADE_FLUTUANTE = 0;";}
            
            //PierPublicidadeGlobal - Timpan.us
            $pierpublicidade_global = PreferencesUtils::getAttributesComplete('componente_site', 'pier_publicidade_global');
            if(isset($pierpublicidade_global['inteiro']) && $pierpublicidade_global['inteiro'] == 1){$dados .= "const PIER_PUBLICIDADE_GLOBAL = 1;";}else{$dados .= "const PIER_PUBLICIDADE_GLOBAL = 0;";}
            
            //Promocao
            $pierpromocao = PreferencesUtils::getAttributesComplete('componente_site', 'pierpromocao');
            if(isset($pierpromocao['inteiro']) && $pierpromocao['inteiro'] == 1){$dados .= "const PIER_PROMOCAO = 1;";}else{$dados .= "const PIER_PROMOCAO = 0;";}
            $pierpromocao = SettingsAplicativosUtils::updatePage('promocao', $pierpromocao);
            
            //FAQ
            $pierfaq = PreferencesUtils::getAttributesComplete('componente_site', 'pierfaq');
            if(isset($pierfaq['inteiro']) && $pierfaq['inteiro'] == 1){$dados .= "const PIER_FAQ = 1;";}else{$dados .= "const PIER_FAQ = 0;";}
            $pierfaq = SettingsAplicativosUtils::updatePage('faq', $pierfaq);
            
            //Boletos
            $pierboletos = PreferencesUtils::getAttributesComplete('componente_site', 'pierboletos');
            if(isset($pierboletos['inteiro']) && $pierboletos['inteiro'] == 1){$dados .= "const PIER_BOLETOS = 1;";}else{$dados .= "const PIER_BOLETOS = 0;";}
            
            //Wiki
            $pierwiki = PreferencesUtils::getAttributesComplete('componente_site', 'pierwiki');
            if(isset($pierwiki['inteiro']) && $pierwiki['inteiro'] == 1){$dados .= "const PIER_WIKI = 1;";}else{$dados .= "const PIER_WIKI = 0;";}
            
            //PierBugFree
            $pierbugfree = PreferencesUtils::getAttributesComplete('componente_site', 'pierbugfree');
            if(isset($pierbugfree['inteiro']) && $pierbugfree['inteiro'] == 1){$dados .= "const PIER_BUGFREE = 1;";}else{$dados .= "const PIER_BUGFREE = 0;";}
            
            //PierComboShare
            $piercomboshare = PreferencesUtils::getAttributesComplete('componente_site', 'combo_share');
            if(isset($piercomboshare['inteiro']) && $piercomboshare['inteiro'] == 1){$dados .= "const PIER_COMBOSHARE = 1;";}else{$dados .= "const PIER_COMBOSHARE = 0;";}
            
            //More details            
            $banner_principal = "const BANNER_PRINCIPAL = false;";
            //Banner Houdini
            $bannerhoudini = PreferencesUtils::getAttributesComplete('componente_site', 'banner_houdini');
            if(isset($bannerhoudini['inteiro']) && $bannerhoudini['inteiro'] == 1){$banner_principal = "const BANNER_PRINCIPAL = 1; const BN_THEME = 'default';";}
            
            //Banner Jumbo
            $bannerjumbo = PreferencesUtils::getAttributesComplete('componente_site', 'banner_jumbo');
            if(isset($bannerjumbo['inteiro']) && $bannerjumbo['inteiro'] == 1){$banner_principal = "const BANNER_PRINCIPAL = 1; const BN_THEME = 'jumbo';";}
            
            //Menu prinicpal
            $menu_principal = "const MENU_PRINCIPAL = 'menu_responsivo';";
            $megamenu = PreferencesUtils::getAttributesComplete('componente_site', 'menu_mega');
            if(isset($megamenu['inteiro']) && $megamenu['inteiro'] == 1){$menu_principal = "const MENU_PRINCIPAL = 'menu_mega';";}
            
            $bn_caption = PreferencesUtils::getAttributes('main_banner_caption', 'inteiro');
            if($bn_caption == 1) $dados .= "const BN_CAPTION = 1;";
            
            $bn_shadow = PreferencesUtils::getAttributes('main_banner_shadow', 'inteiro');
            if($bn_shadow == 1) $dados .= "const BN_Shadow = 1;";
            
            $bn_fullscreen = PreferencesUtils::getAttributes('main_banner_fullscreen', 'inteiro');
            if($bn_fullscreen == 1) $dados .= "const BN_FULLSCREEN = 1;";
            
            $bn_autoplay = PreferencesUtils::getAttributes('main_banner_autoplay', 'inteiro');
            if($bn_autoplay == 1) $dados .= "const BN_AUTOPLAY = 1;";
            
            $bn_animation = PreferencesUtils::getAttributes('main_banner_animation', 'inteiro');
            if($bn_animation) $dados .= "const BN_ANIMATION = " . $bn_animation . ";";
            
            $bn_interval = PreferencesUtils::getAttributes('main_banner_intervalo', 'inteiro');
            if($bn_interval) $dados .= "const BN_INTERVAL = ". $bn_interval . ";";
            
            $bn_altura = PreferencesUtils::getAttributes('altura_main_banner', 'inteiro');
            if($bn_altura) $dados .= "const BN_ALTURA= ". $bn_altura . ";";
            
            $bn_margin_base = PreferencesUtils::getAttributes('main_banner_margin_base', 'inteiro');
            if($bn_margin_base) $dados .= "const BN_MARGIN_BASE = ". $bn_margin_base . ";";
            
            $bn_lightbox = PreferencesUtils::getAttributes('main_banner_lightbox', 'inteiro');
            if($bn_lightbox == 1) $dados .= "const BN_LIGHTBOX = 1;";
                
            $dados .= $banner_principal;
            $dados .= $menu_principal;
            
            
            return $dados;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: SettingsAplicativosUtils - updatePurpleStoreAplicativos() ' . $e->getMessage();
        }
    }
    
    /**
     * Método para pegar as propriedades dos aplicativos
     *
     *
    */
    public static function updatePage($controller, $status){
        
       Yii::import('application.extensions.utils.admin.PaginasUtils'); 
       
       if(!isset($status['inteiro'])) return false;
            
       try{
           $recordset = PaginasUtils::setPageVisibility($controller, $status['inteiro']);
           return $recordset;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: SettingsAplciativosUtils - updatePurpleStoreAplicativosPage() ' . $e->getMessage();
        }
    }

}
?>
