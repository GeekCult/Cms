<?php
/**
 * Autor: CarlosGarcia
 * Date: 05/12/2010
 *
 * Admin Class
 * Selector Class - Admin Controller
 *
 */
class AdminController extends Controller{
    
    public $user_account_states_id;
    public $pageTitle;
    public $siteAuthor;
    public $pageMetatags;
    public $pageDescription;
    public $productTitle;
    public $productDescription;
    public $pageLogo;
    public $pageThumb1;
    public $pageThumb2;
    public $facebook_app_id;
    public $facebookProfile;
    public $twitterProfile;
    public $linkedinProfile;
    public $orkutProfile;
    public $iconApp;
    public $google_tag_manager;
    public $canalYoutubeProfile;
    public $instagram_profile;
    public $pinterest_profile;
    public $flickr_profile;
    public $all;
    
    public function actions(){
        
        date_default_timezone_set("Brazil/East");   
        
        return array(            
            'index'             => 'application.controllers.admin.IntroAction',
            'intro'             => 'application.controllers.admin.IntroAction',
            'downloads'         => 'application.controllers.admin.DownloadsAction',
            'videos'            => 'application.controllers.admin.VideosAction',
            'materias'          => 'application.controllers.admin.MateriasAction',
            'colunas'           => 'application.controllers.admin.MateriasAction',
            'noticias'          => 'application.controllers.admin.MateriasAction',
            'wiki'              => 'application.controllers.admin.MateriasAction',
            'blog'              => 'application.controllers.admin.BlogAction',
            'banners'           => 'application.controllers.admin.BannersAction',
            'hiperlinks'        => 'application.controllers.admin.HiperlinksAction',
            'paginas'           => 'application.controllers.admin.PaginasAction',
            'paginas_advanced'  => 'application.controllers.admin.PaginasAdvancedAction',
            'galeria'           => 'application.controllers.admin.GaleriaAction',
            'images'            => 'application.controllers.admin.ImagesAction',
            'topos'             => 'application.controllers.admin.ExtremosAction',
            'rodapes'           => 'application.controllers.admin.ExtremosAction',
            'html_mainbanners'  => 'application.controllers.admin.ExtremosAction',
            'html_banners'      => 'application.controllers.admin.ExtremosAction',
            'html_spark'        => 'application.controllers.admin.ExtremosAction',
            'html_corona'       => 'application.controllers.admin.ExtremosAction',
            'html_mini'         => 'application.controllers.admin.ExtremosAction',
            'html_lonsdale'     => 'application.controllers.admin.ExtremosAction',
            'html_blocks'       => 'application.controllers.admin.ExtremosAction',
            'html_renderpartial'=> 'application.controllers.admin.ExtremosRenderAction',
            'playground'        => 'application.controllers.admin.ExtremosAction',
            'pierplayground'    => 'application.controllers.site.special.purple.PurpleCanvasAction',
            'texturas'          => 'application.controllers.admin.TexturasAction',
            'textura'           => 'application.controllers.admin.TexturasAction',
            'texturas_tablet'   => 'application.controllers.admin.TexturasAction',
            'texturas_mobile'   => 'application.controllers.admin.TexturasAction',
            'detalhes'          => 'application.controllers.admin.DetalhesAction',
            'fontes'            => 'application.controllers.admin.FontesAction',
            'layoutsite'        => 'application.controllers.admin.LayoutSiteAction',
            'categorias'        => 'application.controllers.admin.CategoriasAction',
            'csseditor'         => 'application.controllers.admin.special.CSSEditorAction',
            'bkbank'            => 'application.controllers.admin.special.BkBankAction',
            'xml'               => 'application.controllers.admin.special.XmlAction',
            
            'bancos'            => 'application.controllers.admin.erp.BancosAction',
            'marketplace'       => 'application.controllers.admin.special.MarketPlacesAction',
            
            'hotsite'           => 'application.controllers.admin.special.HotSiteAction',
            'howto'             => 'application.controllers.admin.HowToAction',
            'cool'              => 'application.controllers.admin.CoolAction',            
            'produtos'          => 'application.controllers.admin.special.ProdutosAction',
            'portfolio'         => 'application.controllers.admin.special.PortfolioAction',
            'autos'             => 'application.controllers.admin.special.AutosAction',
            'ecommerce'         => 'application.controllers.admin.special.EcommerceAction',
            'loja'              => 'application.controllers.admin.LojaAction',
            'loja_analytics'    => 'application.controllers.admin.LojaAnalyticsAction',
            'registros'         => 'application.controllers.admin.special.RegistrosAction',
            'users'             => 'application.controllers.site.conta.user.UsersAction',
            'users_selection'   => 'application.controllers.site.conta.user.UsersSelectionAction',
            'calendario'        => 'application.controllers.admin.CalendarioAction',
            'login'             => 'application.controllers.admin.LoginAction',
            'signin'            => 'application.controllers.admin.LoginAction',
            'configurar'        => 'application.controllers.admin.configurar.ConfigurarAction',
            'documentacao'      => 'application.controllers.admin.DocumentacaoAction',
            'coolhtml'          => 'application.controllers.admin.CoolHtmlAction',
            'logout'            => 'application.controllers.admin.LogoutAction',
            'ticket'            => 'application.controllers.admin.special.TicketAction',
            'newsletter'        => 'application.controllers.admin.NewsletterAction',
            'comentarios'       => 'application.controllers.site.comentarios.ComentariosAction',
            'depoimentos'       => 'application.controllers.site.comentarios.DepoimentosAction',
            'eventos'           => 'application.controllers.admin.EventosAction',
            'pedidos'           => 'application.controllers.admin.pedidos.PedidosAction',
            'chamados'          => 'application.controllers.admin.pedidos.ChamadosAction',
            'email'             => 'application.controllers.admin.EmailAction',
            'emaill'            => 'application.controllers.admin.EmailAction',
            'alertas'           => 'application.controllers.admin.AlertasAction',
            'logos'             => 'application.controllers.admin.LogosAction',
            'pagamento'         => 'application.controllers.site.pagamento.PagamentoAction',
            'estatisticas'      => 'application.controllers.admin.EstatisticasAction',
            'curriculums'       => 'application.controllers.admin.pedidos.CurriculumsAction',
            'userssupport'      => 'application.controllers.site.conta.user.UsersSupportAction',
            'vagas'             => 'application.controllers.admin.pedidos.VagasAction',
            'menu'              => 'application.controllers.admin.MenuAction',
            'launcher'          => 'application.controllers.admin.launcher.LauncherAction',
            'launcher2'         => 'application.controllers.admin.launcher.Launcher2Action',
            'launcher3'         => 'application.controllers.admin.launcher.Launcher3Action',
            'configurarview'    => 'application.controllers.admin.configurar.ConfigurarViewAction',
            'promocao'          => 'application.controllers.admin.special.PromocaoAction',
            'facebook'          => 'application.controllers.admin.configurar.FacebookAction',
            'twitter'           => 'application.controllers.admin.configurar.TwitterAction',
            'google'            => 'application.controllers.admin.configurar.GoogleAction',
            'dates'             => 'application.controllers.admin.special.DatesAction',
            'pesquisas'         => 'application.controllers.admin.special.PesquisaAction',
            'avaliacao'         => 'application.controllers.admin.special.AvaliacaoAction',
            'elearn'            => 'application.controllers.admin.special.ElearnAction',
            'apostila'          => 'application.controllers.admin.special.ApostilaAction',
            'apostila_advanced' => 'application.controllers.admin.special.ApostilaAdvancedAction',
            'beneficios'        => 'application.controllers.admin.special.BeneficiosAction',
            'prospects'         => 'application.controllers.admin.ProspectsAction',
            'livechat'          => 'application.controllers.site.inhamer.InhamerAction',
            'sql'               => 'application.controllers.admin.launcher.SyncSqlAction',
            'ftp'               => 'application.controllers.admin.special.FTPAction',
            'mini_sites'        => 'application.controllers.admin.special.MiniSitesAction',
            'financeiro'        => 'application.controllers.admin.erp.FinanceiroAction',
            'erp_categorias'    => 'application.controllers.admin.erp.CategoriasAction',
            'erp_atividades'    => 'application.controllers.admin.erp.ProdutosServicosAction',
            'boletos'           => 'application.controllers.admin.erp.BoletosAction',
            'recursos_humanos'  => 'application.controllers.admin.erp.RecursosHumanosAction',
            'forca_vendas'      => 'application.controllers.admin.erp.ForcaVendasAction',
            'ordem_servico'     => 'application.controllers.admin.erp.OrdemServicoAction',
            'ordem_pedidos'     => 'application.controllers.admin.erp.OrdemPedidosAction',
            'publicidade'       => 'application.controllers.admin.erp.PublicidadeAction',
            'ping'              => 'application.controllers.admin.special.PingAction',
            'emkt'              => 'application.controllers.admin.special.EmktAction',
            'insumos'           => 'application.controllers.admin.erp.InsumosAction',
            'permissao_negada'  => 'application.controllers.admin.special.PermissionAction',
            'revista'           => 'application.controllers.admin.special.RevistaAction',
            'purplestore'       => 'application.controllers.site.special.purple.PurpleStoreAction',
            'forum'             => 'application.controllers.admin.special.ForumAction',
            'canal_comunicacao' => 'application.controllers.admin.special.CanalComunicacaoAction',
            'sms'               => 'application.controllers.admin.special.SMSAction',
            'mercadolivre'      => 'application.controllers.admin.special.MercadoLivreAction'
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
        $error['info'] = $manager->getInfo();        
        
        if(Yii::app()->params['bug_free']) $send_error = MethodUtils::sendError($error, true);
               
        $this->layout = "admin/message";
        $this->render('/admin/error/error', $error);               
    }
    
    /*
     * Filters
     * 
     */
    public function filters(){
        return array(
            'accessControl',
        );
    }
    
    /*
     * Rules access
     * 
     */
    public function accessRules(){        
        return array(                
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('downloads', 'videos', 'materias', 'blog','banners','eventos','pedidos','images', 'loja', 'bkbank','xml',
                                   'hiperlinks','paginas', 'galeria', 'topos', 'rodapes', 'htmlbanners', 'htmlspark',
                                   'htmlcorona','htmlmini', 'htmlblocks', 'texturas', 'detalhes', 'fontes', 'layoutsite',
                                   'categorias','howto', 'cool', 'produtos', 'users', 'configurar','curriculums', 'autos',
                                   'documentacao','coolhtml', 'newsletter', 'pagamento', 'email', 'cool', 'texturas', 
                                   'launcher', 'beneficios', 'menu', 'prospects', 'financeiro', 'recursos_humanos', 'forca_vendas',
                                   'ordem_servico', 'publicidade', 'r_listar, emkt', 'intro', 'forum', 'apostila', 'emkt'),
                  'users'=>array('@'),
                  'expression' => "Yii::app()->user->getState('roles') == 'admin'",
                 
                  
            ),
            
            //TODO: Pensar em como bloquear texturas e cool e deixa-los aberto para Playground
            array('deny',  // deny all users
                  'actions'=>array('downloads', 'videos', 'materias', 'blog','banners','eventos','pedidos','images','loja','bkbank', 'xml',
                                   'hiperlinks','paginas', 'galeria', 'topos', 'rodapes', 'htmlbanners', 'htmlspark',
                                   'htmlcorona','htmlmini', 'htmlblocks', 'detalhes', 'fontes', 'layoutsite',
                                   'categorias','howto', 'produtos', 'users', 'configurar','curriculums', 'autos', 
                                   'documentacao', 'newsletter', 'pagamento', 'email', 'beneficios', 'launcher', 'menu', 'prospects', 
                                   'financeiro', 'recursos_humanos', 'forca_vendas', 'ordem_servico', 'publicidade, emkt', 'forum', 'apostila', 'emkt'),
                  'users'=>array('*'),
                  
                  'deniedCallback'=> array($this, 'redirectToDeniedMethod'),
                  
            ),
        );
    }
    
    /*
     * Rules access
     * 
     */
    public function redirectToDeniedMethod(){        
        $this->redirect("/admin");
       
    }
}