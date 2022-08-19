<?php

/**
 * Autor: CarlosGarcia
 * Date: 13/12/2010
 *
 * Banner Class
 * Specific Class - Admin Controller
 *
 */
class ExtremosAction extends CAction {

    private $bannersHandler;
    private $extremosHandler;
    private $action;
    private $type_controller;
    private $id;
    
    private $LIST = "list";
    private $NEW = "new";
    private $EDIT = "edit";
    private $TYPE = "extremos";

    /**
     * Run
     * Launcher Method
     *
     */
    public function run() {
        
        $this->action = Yii::app()->getRequest()->getQuery('action');        
        $this->id = Yii::app()->getRequest()->getQuery('id');
        $this->type_controller = $this->getController()->getAction()->getId();        
        
        Yii::import('application.extensions.dbuzz.admin.BannersManager');
        Yii::import('application.extensions.dbuzz.admin.ExtremosManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.DicasUtils');

        $this->bannersHandler = new BannersManager();
        $this->extremosHandler = new ExtremosManager();  

        switch($this->action){

            case "novo":
            case   ""  :
                $this->novo();
                break;

            case "listar":
                $this->listar();
                break;
            
            case "comprar":
                $this->listar(true);
                break;
            
            case "salvar":
                $this->salvar();
                break;

            case "editar":
                $this->editar();
                break;

            case "alterar":
                $this->alterar();
                break;
            
            case "estatisticas":
                $this->estatisticas();
                break;
            
            case "definicoes":
                $this->definicoes();
                break;
            
            case "define_main_banner":
                $this->defineMainBanner();
                break;
            
            case "recomendacoes":
                $this->recomendacoes();
                break;
            
            case "settings":
                $this->settings();
                break;
            
            case "exibir":
                $this->exibir();
                break;
            
            case "obter":
                $this->obter();
                break;
            
            case "modelo":
                $this->modelos();
                break;
            
            case "paginar_fancy":
                $this->paginar_fancy();
                break;
            
            case "advertise":
                $this->setBannersAdvertise();
                break;
            
            case "advertise_load_exibitions":
                $this->loadBannersPagesAdvertise();
                break;
            
            case "flutuante_load_exibition":
                $this->loadFlutuanteExibition();
                break;
            
            case "flutuante_configurar":
                $this->configuracarFlutuante();
                break;
            case "flutuante_salvar_settings":
                $this->salvarSettingsFlutuante();
                break;
            
            case "global_load_exibition":
                $this->loadGlobalExibition();
                break;
        }

    }
    
    /**
     * Recoemndações
     * Exibe recomendações de tamanhos, peso, como criar os 
     * principais atributos, keywords, créditos e etc dos htmls banners
     *
     */
    public function recomendacoes(){

        $result = array();
        
        $this->addScript();
        $this->controller->layout = 'admin/admin';
        $this->controller->render("pages/banners/recomendacoes");
    }
    
    /**
     * Settings
     * Exibe os settings dos htmls banners
     *
     */
    public function settings(){

        $result = array();

        try{            
            $result['content'] = $this->bannersHandler->getSettingsByIdBanner($this->id );
            $result['type'] = $this->type_controller;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("setting", $this->TYPE);
        
        $this->addScript();
        $this->controller->layout = 'admin/admin';
        $this->controller->render("/admin/pages/banners/settings", $result);
    }
    
    /**
     * Estatísticas
     * Exibe as estatisticas dos htmls banners
     *
     */
    public function estatisticas(){

        $result = array();

        try{            
            $result['content'] = $this->bannersHandler->getAllStatistic("all");
            $result['type'] = $this->type_controller;
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("setting", $this->TYPE);
        
        $this->addScript();
        $this->controller->layout = 'admin/admin';
        $this->controller->render("/admin/pages/banners/estatisticas", $result);
    }

    /**
     *
     * Listar
     * List the main attributes and it opens the item list.
     *
     */
    public function listar($isPurchase = false) {

        Yii::import('application.extensions.dbuzz.admin.CoolHtmlManager'); 
        Yii::import('application.extensions.dbuzz.admin.PaginasManager');
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.dbuzz.DBManager');

        $result = array();
        $dbManager = new DBManager();
        $preferences = new MyPreferences();
        $paginasHandler = new PaginasManager();
        $result['session'] = MethodUtils::getSessionData();

        try {
            switch($this->type_controller) {
                case "topos":
                    $content = $this->bannersHandler->getAllContent("html_topos') OR (tipo = 'topos", $result['session']['device'], null, $isPurchase);
                    $result['title_current'] = Yii::t('adminForm', 'title_page_html_topos_listar');
                    $result['type'] = "topos"; $result['page']['nome'] = ''; $result['type_size'] = "header" . "/site/special/";
                    $result['menu_principal'] = $dbManager->getMenu('desktop', 'menu_principal');
                    $result['menu_active'] = 'home'; $result['isBanner'] = false;
                    break;

                case "rodapes":
                    $content = $this->bannersHandler->getAllContent("html_rodapes') OR (tipo = 'rodapes", $result['session']['device'], null, $isPurchase);
                    $result['title_current'] = Yii::t('adminForm', 'title_page_html_rodapes_listar');
                    $result['type'] = "rodapes"; $result['type_size'] = "footer" . "/site/special/";
                    
                    $result['menu3'] = $dbManager->getMenu('desktop', 'menu_3');
                    //$result['menu2'] = $dbManager->getMenu('desktop', 'menu_2', 'GROUP BY id_categoria');
                    
                    $coolHtmlManager = new CoolHtmlManager(); 
                    $result['menu2_categorias'] = $coolHtmlManager->getMenu('mn');
                    
                    break;

                default:
                    $content = $this->bannersHandler->getAllContent("$this->type_controller') OR (tipo = '$this->type_controller", $result['session']['device'], null, $isPurchase);
                    $result['title_current'] = Yii::t('adminForm', 'title_page_html_banner_listar');
                    $result['type'] = "banners"; $result['type_size'] =  "banner/modelos/" . $this->type_controller . '/';
                    break;
            }
            
            $result['is_purchase'] = $isPurchase;

            $result['paginas'] = $paginasHandler->getAllContentForCategory(true);
            $result['preferences'] = $preferences->getPreferences();
             
            $result['content'] = $content;
            
            $result['local'] = $this->type_controller;
            $result['action'] = $this->action;

            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);

            $this->addScript(true);
            $this->controller->layout = "admin/admin";
            $this->controller->render("pages/extremos/listar", $result);
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosUtils - listra() " . $e->getMessage();
        }
    }

    /**
     *
     * Criar
     * List the main attributes and it opens the item list.
     *
     */
    public function novo(){        
        
        $result = array();        
        $result['session'] = MethodUtils::getSessionData();
        $result['local'] = $this->type_controller;
        $result['action'] = "novo";
        $result['id'] = "";        

        try{
            //Utiliza classe estática para facilitar, várias col features utilizam desta classe
            $banner_properties = BannersUtils::getBannerProperties($this->type_controller, $result['session']['device']);
            $result['content'] = $this->bannersHandler->getTemplate($banner_properties["template"]);
            $result['largura_banner'] = $banner_properties["largura"];
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            return false;
        }
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/extremos/criar", $result);
    }

    /**
     *
     * Editar
     * This method edits the html cool banner using a jQuery request
     * 
     * @param number
     * @param string
     *
     */
    public function editar() {

        $result = array();
        $result['session'] = MethodUtils::getSessionData();
        $result['local'] = $this->type_controller;
        $result['action'] = "editar";
        $result['id'] = $this->id;

        try{
            //Utiliza classe estática para facilitar, várias cool features utilizam desta classe
            $banner_propertie = BannersUtils::getBannerProperties($this->type_controller, $result['session']['device']);
            $result['content'] = $this->bannersHandler->getContent($this->id);  
            $result['largura_banner'] = $banner_propertie["largura"];
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/extremos/criar", $result);
    }
    
    /**
     *
     * Modelos
     * This method gets a modelo from PurpleManager
     * 
     *
     */
    public function modelos(){
        
        Yii::import('application.extensions.dbuzz.admin.CoolHtmlManager');
        $coolHtmlHandler = new CoolHtmlManager();
        
        $result = array();
        $result['local'] = $this->type_controller;
        $result['action'] = "template";
        $result['id'] = $this->id;

        try{
            //Utiliza classe estática para facilitar, várias col features utilizam desta classe
            $banner_propertie = BannersUtils::getBannerProperties($this->type_controller);
            $result['content'] = $coolHtmlHandler->getContent($this->id, true);  
            $result['largura_banner'] = $banner_propertie["largura"];
            $result['dicas'] = DicasUtils::getTips($this->LIST, $this->TYPE);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
        $this->addScript();
        $this->controller->layout = "admin/admin";
        $this->controller->render("pages/extremos/criar", $result);
    }

    /**
     * Salvar
     * This method uses a json request to save all the attributes from
     * the banner edited.
     *
     */
    public function salvar(){  
        
        Yii::import('application.extensions.digitalbuzz.attributes.BannersItems');
        Yii::import('application.extensions.utils.users.UserSupportUtils');
        Yii::import('application.extensions.utils.users.UserUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.StringUtils');
        
        //$json = addslashes($_POST["json"]);
        
        $json = $_POST["json"];
        //$json =addcslashes($_POST["json"], '"\\');
        
        //echo $json;
        //$json = '{"0":{"id":"0","type":"b","src":"pattern.gif","left":0,"top":0,"width":"","height":"","size_thumb":"","link":"","variante":"","texto":"","graphic":{"color":"#RRRRRR","shadow":false,"zindex":0,"rotation":0}},"1":{"id":3,"nickname":"Título","type":"t","src":"Capitólio é demais","left":20,"top":214,"width":350,"height":38,"link":"","variante":"","texto":"Capitólio é demais","texto_properties":{"align":"left","style":"normal","f_type":"Cooper","s_text":"28","color":"#2c7b23"},"graphic":{"color":"#2c7b23","shadow":false,"zindex":3,"rotation":0}},"2":{"id":4,"nickname":"Paragrafo","type":"p","src":"Super bom Adoramos o lugar e com certeza voltaríamos muito mais vezes","left":26,"top":130,"width":280,"height":0,"link":"","variante":"","texto":"Super bom Adoramos o lugar e com certeza voltaríamos muito mais vezes","texto_properties":{"align":"left","style":"normal","f_type":"Arial","s_text":"18","color":"#a2ea85"},"graphic":{"color":"#a2ea85","shadow":false,"zindex":2,"rotation":0}},"3":{"id":3,"nickname":"Sol","type":"i","src":"http://dev.purplepier.com.br/media/images/cool/cool_m/sun_yellow.png","left":219,"top":-37,"width":"","height":"","size_thumb":"","link":"","variante":"","texto":"","graphic":{"color":"#RRRRRR","shadow":false,"zindex":3,"rotation":0}},"4":{"id":4,"nickname":"Borboleta","type":"i","src":"http://dev.purplepier.com.br/media/images/cool/cool_m/borboleta_simple.png","left":120,"top":22,"width":"","height":"","size_thumb":"","link":"","variante":"","texto":"","graphic":{"color":"#4f9eee","shadow":false,"zindex":1,"rotation":0}},"5":{"id":5,"nickname":"Catus","type":"i","src":"http://dev.purplepier.com.br/media/images/cool/cool_m/cactos_ariba_m.png","left":220,"top":6,"width":"","height":"","size_thumb":"","link":"","variante":"","texto":"","graphic":{"color":"#RRRRRR","shadow":false,"zindex":2,"rotation":0}},"6":{"id":6,"nickname":"Flor","type":"i","src":"http://dev.purplepier.com.br/media/images/cool/cool_m/flower_pink.png","left":187,"top":57,"width":"","height":"","size_thumb":"","link":"","variante":"","texto":"","graphic":{"color":"#3e7ab6","shadow":false,"zindex":1,"rotation":0}},"nr":7,"id":"565","action":"editar","altura":300,"cor":"","largura":"400","tipo":"playground","modelo":"empty html","image":"a7dc96dea5b33e1f4b28a06fc385d907.png"}';
        //echo $json;
        $output = json_decode($json, true);
        $session = MethodUtils::getSessionData();
        
        $output = BannersUtils::organizeArray($output);        
        $bIt = new BannersItems();
        
        $session = MethodUtils::getSessionData();
        
        $result = array();
        $result['dominio'] = "";//Defines if it's a user_purple or just a playground
        
        //Cria um novo banner do usuário
        if($output['action'] == "novo" || $output['action'] == "" || $output['action'] == "template"){
            $sql = "INSERT INTO banners_data (tipo, altura, largura, cor, modelo, plataforma, id_user) VALUES ('".$output['tipo']."', '".$output['altura']."','".$output['largura']."', '".$output['cor']."', '".$output['modelo']."', '".$session['device']."', '".$session['id']."')";
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
        }
               
        //Se user está playground iframe
        if($output['action'] == "admin"){
            
            $id_purple = $session['id_purple']; //Id user Purplepier           
            $info = json_decode(MethodUtils::requestPurplePier($id_purple, C::USER_INFO), true);

            //$user = array("host" => 'localhost',"user" => "root", 'database' => 'hari_embalagens', 'password' => 'root'); 
            $user = array("host" => '23.91.64.199', "user" => $info['user']['dados']['user_db'], 'database' => $info['user']['dados']['db'], 'password' => $info['user']['dados']['referencia']); 
            $setNewDB = UserSupportUtils::setNewDB($user);
            
            $sql = "INSERT INTO banners_data (tipo, altura, largura, cor, modelo, plataforma, id_user) VALUES ('{$output['tipo']}', '{$output['altura']}','{$output['largura']}', '{$output['cor']}', '{$output['modelo']}', '{$session['device']}', 0)";
            $comando = Yii::app()->db_user->createCommand($sql);
            $control = $comando->execute();
            
            $result['dominio'] = $info['user']['dados']['dominio'];
        }
        
        //Atualiza um banner existente do usuário
        if($output['action'] == "editar" && $output['tipo'] != "playground"){
            $sql = "UPDATE banners_data SET altura = '".$output['altura']."', largura = '".$output['largura']."', cor = '".$output['cor']."', modelo = '".$output['modelo']."' WHERE id =". $output['id']. "";
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute(); 
        }
        
        //Adiciona um modelo ao ManagerPurplePier
        if($output['action'] == "modelo"){
            $sql = "INSERT INTO conteudo_templates (id_user, tipo, altura, largura, cor, modelo) VALUES (".$session['id'].", '".$output['tipo']."', '".$output['altura']."','".$output['largura']."', '".$output['cor']."',  '".$output['modelo']."')";
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
            //$comando2 = Yii::app()->db3->createCommand($sql);
            //$control2 = $comando2->execute();
        }
        
        //Adiciona um modelo ao ManagerPurplePier
        if($output['action'] == "atualizar"){
            $sql = "UPDATE conteudo_templates SET altura = '".$output['altura']."', largura = '".$output['largura']."', cor = '".$output['cor']."', modelo = '".$output['modelo']."' WHERE id =". $output['id']. "";
            $comando = Yii::app()->db2->createCommand($sql);
            $control = $comando->execute();
        }

        try{            
            
            if($output['action'] != "editar" && $output['action'] != "admin" && $output['action'] != "atualizar"){
                $output['action'] != "modelo" ? $id = Yii::app()->db->getLastInsertID() : $id = Yii::app()->db2->getLastInsertID();
            }else if($output['action'] == "admin"){
                $id = Yii::app()->db_user->getLastInsertID();
            }else{
                $id = $output['id'];
            }
            
            $bIt->setCurrentBanner($id);
            
            if($output['tipo'] != "playground" && $output['action'] != "admin" && $output['action'] != "atualizar"){
            
                ///var_dump($output);
                if($output['action'] != "editar" && $output['action'] != "modelo"){
                    for($i = 0; $i < $output['nr']; $i++){
                        $isSet = $bIt->recuperarItem($output[$i]['id'], $id);
                        if(!$isSet && $output[$i]['color'] != "empty"){
                        $result['t'][$i] =  $bIt->adicionar($output[$i]['type'], $output[$i]['src'], $output[$i]['left'], 
                                            $output[$i]['top'], $output[$i]['width'], $output[$i]['height'],
                                            $output[$i]['color'], $output[$i]['font_type'], $output[$i]['size_text'],
                                            $output[$i]['size_thumb'], $output[$i]['link'], $output[$i]['variante'], $output[$i]['texto'],
                                            $output[$i]['z-index'], ''); //Decricao
                        }
                        if($output[$i]['color'] == "empty") $bIt->remover($output[$i]['id']);
                    }
                }

                ///var_dump($output);
                if($output['action'] == "editar"){
                    for($i = 0; $i < $output['nr']; $i++){
                        $isSet = $bIt->recuperarItem($output[$i]['id']);
                        if($output[$i]['color'] != "empty"){
                        $result['t'][$i] =  $bIt->atualizar($output[$i]['id'], $output[$i]['type'], $output[$i]['src'],  
                                            $output[$i]['left'], $output[$i]['top'], $output[$i]['width'], $output[$i]['height'],
                                            $output[$i]['color'], $output[$i]['font_type'], $output[$i]['size_text'],
                                            $output[$i]['size_thumb'], $output[$i]['link'], $output[$i]['variante'], $output[$i]['texto'],'', //Ultimo registro vazio descricao
                                            $output[$i]['z-index']);
                        }

                        if(!$isSet && $output[$i]['color'] != "empty" && $output[$i]['type'] != "b" && $output[$i]['type'] != "o"){
                        $result['t'][$i] =  $bIt->adicionar($output[$i]['type'], $output[$i]['src'], $output[$i]['left'], 
                                            $output[$i]['top'], $output[$i]['width'], $output[$i]['height'],
                                            $output[$i]['color'], $output[$i]['font_type'], $output[$i]['size_text'],
                                            $output[$i]['size_thumb'], $output[$i]['link'], $output[$i]['variante'], $output[$i]['texto'],
                                            $output[$i]['z-index'], '');//Descricao
                        }
                        if($output[$i]['color'] == "empty") $result['i'][$i] = $bIt->remover($output[$i]['id']);
                    }
                }

                ///Salva os items do modelo no Manager PurplePier
                if($output['action'] == "modelo"){
                    for($i = 0; $i < $output['nr']; $i++){               
                        if($output[$i]['color'] != "empty"){
                        $result['t'][$i] =  $bIt->adicionarManager($output[$i]['type'], $output[$i]['src'], $output[$i]['left'], 
                                            $output[$i]['top'], $output[$i]['width'], $output[$i]['height'],
                                            $output[$i]['color'], $output[$i]['font_type'], $output[$i]['size_text'],
                                            $output[$i]['size_thumb'], $output[$i]['link'], $output[$i]['variante'], $output[$i]['texto'],
                                            $output[$i]['z-index'], ''); //Descricao
                        }
                    }
                }   
            
            //If playground saves all json data
            }else{                

                //Atualiza um banner existente do usuário
                if($output['action'] == "editar"){
                    
                    $sql = "UPDATE banners_data SET altura = '".$output['altura']."', largura = '".$output['largura']."', cor = '".$output['cor']."', modelo = '".$output['modelo']."' WHERE id =". $output['id']. "";
                    
                    //echo $sql;
                    $comando = Yii::app()->db->createCommand($sql);
                    $control = $comando->execute();
                   
                    
                    $sql2 = "UPDATE banners_items SET json = '" . json_encode($output) ."' WHERE id_banner =". $output['id']. "";
                    $comando2 = Yii::app()->db->createCommand($sql2);
                    $control = $comando2->execute();
                   
                    
                }else{
                    if($output['action'] == "modelo"){
                        $result['t'] = $bIt->adicionarManager("", "", 0, 0, 0, 0, "", "", "", "", "", "", "", "", json_encode($output), "", "");
                    }else if($output['action'] == "atualizar"){
                        $result['t'] = $bIt->atualizar("", "", 0, 0, 0, 0, "", "", "", "", "", "", "", "", "", "", json_encode($output), true);
                    }else{
                        if($output['action'] != "admin"){
                            $result['t'] = $bIt->adicionarPlaygroundManager(json_encode($output));
                        }
                    }
                }
            }
            
            $result['id'] = $id;

            switch($this->type_controller){            
                case "topos":
                    $result['message'] =  Yii::t("messageStrings", "message_result_header");
                    break;

                case "rodapes":
                    $result['message'] = Yii::t("messageStrings", "message_result_footer");
                    break;
                
                default:
                    $result['message'] =  Yii::t("messageStrings", "message_result_htmlbanners");
                    break;
            }
            
            //Update JSON data_base infos
            //$updateDataJson = MethodUtils::updateDominioData();
            $clear = MethodUtils::setSessionData('banner_flutuante', "");
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
    
    /**
     *
     * Salvar
     * This method uses a jQuery request to save all the attributes from
     * the banner edited.
     * The values are set into Flash background.
     * Each property bellow as altura, cor or cool are complete string separate by &.
     *
     * Ex: &x1=2&y1-1&c1=#ff9900&p1=77
     *
     */
    public function salvar2(){

        $id      = $_POST["id"];
        $altura  = $_POST["altura"];
        $largura = $_POST["largura"];
        $cor     = $_POST["colors"];
        $cool    = $_POST["cool"];
        $modelo  = $_POST["modelo"];
        $tipo    = $_POST["tipo"];
        $action  = $_POST["action"];
        
        $session = MethodUtils::getSessionData();
        
        //Cria um novo banner do usuário
        if($action == "novo" || $action == "" || $action == "template"){
            $sql = "INSERT INTO banners_data (tipo, altura, largura, cor, cool, modelo) VALUES ('$tipo', '$altura','$largura', '$cor',  '$cool', '$modelo')";
            $comando = Yii::app()->db->createCommand($sql);
        }
        //Atauliza um banner existente do usuário
        if($action == "editar"){
            $sql = "UPDATE banners_data SET altura = '$altura', largura = '$largura', cor = '$cor', cool = '$cool',  modelo = '$modelo' WHERE id ='$id'";
            $comando = Yii::app()->db->createCommand($sql);
            
        }
        //Adiciona um modelo ao ManagerPurplePier
        if($action == "modelo"){
            $sql = "INSERT INTO conteudo_templates (id_user, tipo, altura, largura, cor, cool, modelo) VALUES (".$session['id'].", '$tipo', '$altura','$largura', '$cor',  '$cool', '$modelo')";
            $comando = Yii::app()->db2->createCommand($sql);
            
            $comando2 = Yii::app()->db3->createCommand($sql);
            $control2 = $comando2->execute();
        }

        try{
            
            $control = $comando->execute();
            
            if($action != "editar"){
                $id = Yii::app()->db->getLastInsertID();
            }
            
            $result['id'] = $id;

            switch($this->type_controller){            
                case "topos":
                    $result['message'] =  Yii::t("messageStrings", "message_result_header");
                    break;

                case "rodapes":
                    $result['message'] = Yii::t("messageStrings", "message_result_footer");
                    break;
                
                case "htmlmainbanners":
                case "htmlbanners":
                case "htmlspark":
                case "htmlcorona":
                case "htmlmini":
                case "htmlblocks":
                case "htmllonsdale":
                    $result['message'] =  Yii::t("messageStrings", "message_result_htmlbanners");
                    break;
            }
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
            echo json_encode($result);

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }

    /**
     *
     * Alterar
     * This method update the preferences table, it uses a
     * submited form using a jQuery request
     *
     */
    public function alterar(){

        $get_post = array();
        $get_post[0] = $_POST['selected'];
        $get_post['local'] = $this->type_controller;

        if($this->type_controller == "topos"){
            $get_post['message'] = Yii::t('messageStrings', 'message_result_header_update');

        }else{
            $get_post['message'] = Yii::t('messageStrings', 'message_result_footer_update');
        }        

        try{
            $content = $this->extremosHandler->updateContent($get_post);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    }
    
    /**
     *
     * Define Main banner
     * Define o banner principal como exibivel nos banners principais
     *
     */
    public function defineMainBanner(){

        $data['id'] = $_POST['id'];
        $data['status'] = MethodUtils::getBooleanNumber($_POST['status']);

        $data['message'] = Yii::t('messageStrings', 'message_result_mainbanner_update');

        try{
            $content = $this->bannersHandler->updateMainBanner($data);
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData();
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR ExtremosAction - defineMainBanner() ' . $e->getMessage();
        }
    }
    
    /**
     *
     * Exibir
     * Exibe os htmls banners no fancybox
     *
     *
     * @param string
     *
     */
    public function exibir(){

        $result = array();
        
        //Prepares the new controller label
        $pieces = explode("html", $this->type_controller);
        $new_controller = "html" . $pieces [1];

        try{            
            //Utiliza classe estática para facilitar
            $banner_propertie = BannersUtils::getHtmlBannerProperties("htmlbanners");

            $result['content'] = $this->extremosHandler->getPaginationContent($this->type_controller, $banner_propertie['resize'], $banner_propertie['resize_slot']);
            
            $result['font_banner'] = $banner_propertie['font_size'];
            $result['width_banner'] = $banner_propertie['largura'];
            $result['height_banner'] = $banner_propertie['altura'];
            $result['resize_banner'] = $banner_propertie['resize'];
            $result['resize'] = $banner_propertie['resize'];
            $result['local'] = $this->type_controller;

     
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        
        $this->addScript();
        $this->controller->layout = "admin/admin_base";
        $this->controller->render("pages/extremos/exibir", $result);
    }
    
    /**
     *
     * Obter
     * Exibe os htmls banners nos slots de páginas
     * pode ser paginas, materias, eventos, produtos
     * etc...
     *
     * @param string
     *
     */
    public function obter(){
        
        $id = $_POST['id_coolbanner'];

        try{            
            $result['content'] = $this->extremosHandler->getContent($id);
     
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }        
        echo json_encode($result['content']);
    }
    
    /**
     *
     * Paginar_fancy
     * This method does the reloading items.
     * It loads a new sequency of images from the database
     *
     *
     * @param start number
     * @param idpag  number
     *
     */
    public function paginar_fancy($start, $idpag, $type_controller){

        $result = array();
        $result['id_page'] = 20;
        $result['init'] = true;
        $result['type_images'] = $type_controller;

        try{
           $result['content'] = $this->imageHandler->getTransformedContent($start, $idpag);

        }catch(CDbException $e){
           Yii::trace("ERROR " . $e->getMessage());
           echo "ERROR " . $e->getMessage();
        }
        $this->controller->renderPartial("pages/images/content/item_simples", $result);
    }
    
    /**
     *
     * Salva os banners selecionados no banco para serem usados em determinadas
     * páginas
     *
     * @param string
     *
     */
    public function setBannersAdvertise() {
        
        Yii::import('application.extensions.utils.DateTimeUtils');
        
        $status = MethodUtils::getBooleanNumber($_POST['status']);
        $expira = DateTimeUtils::setFormatDateNoTime($_POST['expira']);
        
        try {
            $control = BannersUtils::setBannersAdvertise($_POST['id_banner'], $_POST['id_page'], $status, $_POST['tipo'], $_POST['index'], $_POST['size'], $expira);
            $data['result'] = $control;

            $data['message'] = Yii::t("messageStrings", 'message_result_advertise_success');
            
            //Update JSON data_base infos
            $updateDataJson = MethodUtils::updateDominioData(); 
            $clear = MethodUtils::setSessionData('banner_flutuante', "");
            $clear = MethodUtils::setSessionData('banner_global', "");
            
            MethodUtils::returnMessage($data);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
        //echo json_encode($result['content']);
    }
    
    /**
     *
     * Pega todas as páginas que um determinado banner está sendo exibido
     *
     * @param string
     *
     */
    public function loadBannersPagesAdvertise() {

        try {
            $control = BannersUtils::getBannersAdvertise($_POST['id_banner'], "advertise");
            
            echo json_encode($control);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Pega as informações de exibição do banner flutuante
     *
     * @param string
     *
     */
    public function loadFlutuanteExibition() {
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        try {
            $control = BannersUtils::getBannersAdvertise($_POST['id_banner'], "flutuante");
            if($control){
                $control['data'] = DateTimeUtils::getDateFormatCommonNoTime($control['data']);
            }
            
            echo json_encode($control);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Abre tela de configuracoes do banner flutuante
     *
     * @param string
     *
     */
    public function configuracarFlutuante() {

        Yii::import('application.extensions.utils.BannersUtils');       

        try{          
            $result = BannersUtils::getFlutuanteSettings(); 
            
            $result['dicas'] = DicasUtils::getTips("setting_flutuante", $this->TYPE);
        
            $this->addScript();
            $this->controller->layout = 'admin/admin';
            $this->controller->render("/admin/pages/banners/settings_flutuante", $result);            
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosActions - configuracarFlutuante() " . $e->getMessage();
        } 
    }
    
    /**
     *
     * Salva configuracoes da publicidade flutuante
     *
     * @param _POST
     *
     */
    public function salvarSettingsFlutuante(){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{            
           $setPage = PreferencesUtils::setAttributes('flutuante_page_show', $_POST['page'],'texto');
           $setPage = PreferencesUtils::setAttributes('flutuante_frequency', $_POST['frequency'],'texto');
           $setPage = PreferencesUtils::setAttributes('flutuante_timer', $_POST['timer'],'texto');
           
           $clear = MethodUtils::setSessionData('banner_flutuante', "");
           
           echo json_encode(array('message' => Yii::t('messageStrings', 'message_result_success')));
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosActions - salvarSettingsFlutuante() " . $e->getMessage();
        } 
    }
    
    /**
     *
     * Pega as informações de exibição do banner global
     *
     * @param string
     *
     */
    public function loadGlobalExibition() {
        
        Yii::import('application.extensions.utils.DateTimeUtils');

        try {
            $control = BannersUtils::getBannersAdvertise($_POST['id_banner'], "global");
            if($control){
                $control['data'] = DateTimeUtils::getDateFormatCommonNoTime($control['data']);
            }
            
            echo json_encode($control);

        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        }
    }
    
    /**
     *
     * Abre tela de difiniçoes do banner principal
     *
     * @param string
     *
     */
    public function definicoes() {
        
        Yii::import('application.extensions.dbuzz.MyPreferences');
        Yii::import('application.extensions.utils.special.PurpleStoreUtils');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        
        $preferences = new MyPreferences();
        
        $result = array();

        try{            
            $result['type'] = $this->type_controller;
            $result['isBanner']['banner_exibe'] = '1';
            $result['preferences'] = $preferences->getPreferences();
            $result['margin_base'] = PreferencesUtils::getAttributes('main_banner_margin_base', 'inteiro');
            $result['main_banner_painel'] = PreferencesUtils::getAttributes('main_banner_painel', 'inteiro');
            $result['main_banner_shadow'] = PreferencesUtils::getAttributes('banner_shadow');
            
            if($this->id != ''){
                
                $result['purpleitem'] = PurpleStoreUtils::getItemById($this->id); 
                $result['caption'] = PreferencesUtils::getAttributes('main_banner_caption', 'inteiro');
                $result['shadow'] = PreferencesUtils::getAttributes('main_banner_shadow', 'inteiro');
                $result['fullscreen'] = PreferencesUtils::getAttributes('main_banner_fullscreen', 'inteiro');
                $result['lightbox'] = PreferencesUtils::getAttributes('main_banner_lightbox', 'inteiro');
                $result['intervalo'] = PreferencesUtils::getAttributes('main_banner_intervalo', 'inteiro');
                $result['animation'] = PreferencesUtils::getAttributes('main_banner_animation', 'inteiro');
                $result['autoplay'] = PreferencesUtils::getAttributes('main_banner_autoplay', 'inteiro');
                
            }
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR: ExtremosActions - definicoes() " . $e->getMessage();
        }
        
        $result['dicas'] = DicasUtils::getTips("setting", $this->TYPE);
        
        $this->addScript();
        $this->controller->layout = 'admin/admin';
        $this->controller->render("/admin/pages/banners/definicoes", $result);
    }

    /**
     * Method resposible to apply the CSS layout into the View
     *
     * It sets the CSS as the first one in the head session.
     * Verify the classes and id's name because them might be replaced.
     *
     * @param string
     *
     */
    public function addScript($isBootstrapNeeded = false) {

        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();

        $cs->registerScriptFile($baseUrl . '/js/admin/bannerMaker.js', CClientScript::POS_BEGIN);//Verify it has been called at head, but it's causing some probelms with fancybox
        
        $cs->registerScriptFile($baseUrl . '/js/admin/banners.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/js/lib/money/currency.js', CClientScript::POS_BEGIN);

        if($this->action == "novo" || $this->action == "editar") {
            $cs->registerCssFile($baseUrl . '/css/lib/cool/extremos.css', 'screen', CClientScript::POS_BEGIN);
        }else{
            $cs->registerScriptFile($baseUrl . '/js/site/special/purple/purplestore.js', CClientScript::POS_BEGIN);
            $cs->registerCssFile($baseUrl . '/media/user/css/main.css', 'screen', CClientScript::POS_HEAD);
        }
        
        if($this->action == "settings") {
            $cs->registerScriptFile($baseUrl . '/js/admin/coolPicker.js', CClientScript::POS_BEGIN);
        }
        
        if($isBootstrapNeeded) $cs->registerCssFile($baseUrl . '/css/lib/bootstrap.css', 'screen', CClientScript::POS_HEAD);
        
        $this->controller->all = MethodUtils::getAllAdminInformation();
    }
}
?>