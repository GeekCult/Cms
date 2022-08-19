<?php

class SiteController extends Controller{
    
    public $pageTitle;
    public $siteAuthor;
    public $pageMetatags;
    public $pageDescription;
    public $productTitle;   
    public $productDescription;
    public $urlCurrent;
    public $iconApp;
    public $pageLogo;
    public $pageThumb1;
    public $facebook_app_id;
    public $pageThumb2;
    public $facebookProfile;
    public $twitterProfile;
    public $canalYoutubeProfile;
    public $orkutProfile;
    public $linkedinProfile;
    public $google_tag_manager;
    public $instagram_profile;
    public $pinterest_profile;
    public $flickr_profile;
    public $hotsite_css;

    public function actions(){
        
        //Verify if the device it's already checked from session
        $session = MethodUtils::getSessionData();
        
        date_default_timezone_set("Brazil/East");
        
        //$device = 'mobile'; To work with mobile or tablet plataform 

       
        return array(  
            'index' => 'application.controllers.site.HomeAction',
            'home' => 'application.controllers.site.HomeAction',
            'content' => 'application.controllers.site.ContentAction',
            'contato' => 'application.controllers.site.contatos.ContatoAction',
            'hiperlinks' => 'application.controllers.site.special.HiperlinksAction',
            'verticalbanner' => 'application.controllers.site.general.VerticalBannerAction',
            'verticaladvertise' => 'application.controllers.site.general.VerticalAdvertiseAction',
            'verticalusers' => 'application.controllers.site.general.VerticalUserAction',
            'videos' => 'application.controllers.site.VideosAction',
            'downloads' => 'application.controllers.site.special.DownloadsAction',
            'email' => 'application.controllers.site.email.EmailAction',
            'buscar' => 'application.controllers.site.buscar.BuscarAction',
            'comentarios' => 'application.controllers.site.comentarios.ComentariosAction',
            'modulos' => 'application.controllers.site.modulos.ModulosAction',
            'pedido_reclamar' => 'application.controllers.site.pedidos.ReclamarAction',
            'pedido_associar' => 'application.controllers.site.pedidos.AssociarAction',
            'pedidos_webservice' => 'application.controllers.site.pedidos.PedidosWebServiceAction',
            'validar' => 'application.controllers.site.validar.ValidarAction',
            'component' => 'application.controllers.site.ComponentAction',
            'app' => 'application.controllers.site.app.AppAction',
            'images' => 'application.controllers.site.ImagesAction',
            'relatar' => 'application.controllers.site.relatar.RelatarAction',
            'inhamer' => 'application.controllers.site.inhamer.InhamerAction',
            'pagamentos' => 'application.controllers.site.pagamento.PagamentoAction',
            'retorno' => 'application.controllers.site.pagamento.RetornoAction',
            'notificacao' => 'application.controllers.site.pagamento.NotificacaoAction',
            'cronjobs' => 'application.controllers.site.cronjobs.CronJobsAction',
            'curriculum' => 'application.controllers.site.pedidos.CurriculumsAction',
            'vagas' => 'application.controllers.site.pedidos.VagasAction',
            'empregos' => 'application.controllers.site.pedidos.EmpregosAction',
            'orcamento' => 'application.controllers.site.pedidos.PedidosAction',
            'contratar' => 'application.controllers.site.pedidos.ContratarAction',
            'recados' => 'application.controllers.site.contatos.RecadosAction',
            
            'galeria' => 'application.controllers.site.special.GaleriaAction',
            'mobile' => 'application.controllers.mobile.MobileAction',
            'reputacao' => 'application.controllers.site.reputacao.ReputacaoAction',
            'files' => 'application.controllers.site.ImagesAction',
            'images_playground' => 'application.controllers.admin.ImagesAction',
            'teste' => 'application.controllers.site.special.TesteAction',
            'check' => 'application.controllers.site.conta.CheckAction',
            'materias' => 'application.controllers.site.special.MateriasAction',
            'loja' => 'application.controllers.site.loja.StoreAction',
            'promocao' => 'application.controllers.site.special.PromocaoAction',
            'registro' => 'application.controllers.site.special.RegistroAction',
            'pesquisa' => 'application.controllers.site.special.PesquisaAction',
            'boleto' => 'application.controllers.site.special.BoletoAction',
            'perfil' => 'application.controllers.site.special.PerfilAction',
            'portfolio' => 'application.controllers.site.special.PortfolioAction',
            
            'publicar' => 'application.controllers.site.special.PublicarAction',
            'faq' => 'application.controllers.site.special.FaqAction',
            'rss' => 'application.controllers.site.special.RssAction',
            'purplestore' => 'application.controllers.site.special.purple.PurpleStoreAction',
            'purplecanvas' => 'application.controllers.site.special.purple.PurpleCanvasAction',
            'playground' => 'application.controllers.site.special.purple.PurpleCanvasAction',
            'signage' => 'application.controllers.site.special.PublicidadeAction',
            'redebeneficios' => 'application.controllers.site.special.RedeBeneficiosAction',
            'bancodecurriculos' => 'application.controllers.site.special.BancodecurriculosAction',
            'ofertas' => 'application.controllers.site.special.RedeBeneficiosAction',
            'depoimentos' => 'application.controllers.site.special.DepoimentosAction',
            'mapa_site' => 'application.controllers.site.special.SiteMapAction',
            'revision_update' => 'application.controllers.site.cronjobs.RevisionAction',
            'mercadolivre_webhook' => 'application.controllers.site.cronjobs.MercadoLivreAction',
            'agenda' => 'application.controllers.site.special.AgendaAction',
            'precos' => 'application.controllers.site.special.PrecosAction',
            'trabalhe_conosco' => 'application.controllers.site.special.TrabalheConoscoAction',
            'fornecedor' => 'application.controllers.site.special.FornecedorAction',
            'submit' => 'application.controllers.site.special.SubmitDataAction',
            'revista' => 'application.controllers.site.special.RevistaAction',
            'paginasavancadas' => 'application.controllers.site.special.purple.PaginasAvancadasAction',
            'cobranca' => 'application.controllers.site.cronjobs.CobrancaAction',
            'request' => 'application.controllers.site.special.purple.PurpleRequestAction',
        );        
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
        Yii::import('application.extensions.dbuzz.DBManager');
        $manager = new DBManager();
        
        //Infos
        $error = Yii::app()->errorHandler->error;
        $error['info'] = $manager->getIntro();
        
        //echo $_SERVER['REQUEST_URI'];
        $path_url = explode("/", $_SERVER['REQUEST_URI']);
        
        if($path_url[1] != "admin"){            
            $this->layout = "site/message";
            $this->render('/site/error/error', $error); 
        }else{            
            $this->layout = "admin/message";
            $this->render('/admin/error/error', $error);
        }        
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    } 
    
}
?>
