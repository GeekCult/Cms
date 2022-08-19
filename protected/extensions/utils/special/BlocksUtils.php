<?php

/**
 * Description of BlocksUtils
 *
 * Here are some method to make easier the class Blcoks
 *
 * @author CarlosGarcia
 * 
 */
class BlocksUtils{
    
    /**
     * Método para obter view do block
     *
     * @param string
     *
    */
    public static function getViewProperties($data, $isLoremYpsum = false){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BlocksAttribute');
        Yii::import('application.extensions.utils.special.BlocksSupportUtils');

        $bA = new BlocksAttribute();
        $bA->setCurrentUser(0);
       
        try{
            switch($data['tipo']){

                case 'artigo':
                case 'newsletter':
                case 'reservas':
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['label_1'] = $bA->recuperar('label_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_1'] = $bA->recuperar('link_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_target_1'] = $bA->recuperar('link_target_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']); 
                    
                    $result['extra'] = BlocksSupportUtils::getExtraContent($data);
          
                    $result['url'] = "";
                    break;
                
                case 'artigo_complex':
                    for($p = 1; $p < 5; $p++){
                    $result['titulo_' . $p] = $bA->recuperar('titulo_' . $p, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_' . $p] = $bA->recuperar('subtitulo_' . $p, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_' . $p] = $bA->recuperar('texto_' . $p, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    }
                    
                    for($i = 1; $i < 5; $i++){
                    $result['image_' . $i] = $bA->recuperar('image_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_type_' . $i] = $bA->recuperar('image_type_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['icone_cor_' . $i] = $bA->recuperar('icone_cor_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_extra_' . $i] = $bA->recuperar('cor_extra_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['bg_bloco_' . $i] = $bA->recuperar('bg_bloco_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['bg_bloco_type_' . $i] = $bA->recuperar('bg_bloco_type_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    }
                    
                    $result['qtd_blocos'] = $bA->recuperar('qtd_blocos', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    
                    //Mais detalhes
                    for($it = 1; $it < 5; $it++){
                        for($c = 1; $c < 5; $c++){
                        $result["item". $it ."_cor_". $c] = $bA->recuperar("item". $it ."_cor_". $c, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                        $result["item". $it ."_alinhamento_". $c] = $bA->recuperar("item". $it ."_alinhamento_". $c, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                        $result["item". $it ."_font_". $c] = $bA->recuperar("item". $it ."_font_". $c, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                        $result["item". $it ."_link_". $c] = $bA->recuperar("item". $it ."_link_". $c, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                        }
                    }
                    
                    //Botão                    
                    $result['cor_botao'] = $bA->recuperar('cor_botao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao2'] = $bA->recuperar('cor_botao2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao_label'] = $bA->recuperar('cor_botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_label'] = $bA->recuperar('botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_exibe'] = $bA->recuperar('botao_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);  
                    
                    $result['extra'] = BlocksSupportUtils::getExtraContent($data);
                    
                    //var_dump($result);
                    $result['url'] = "";
                    break;
                
                case 'noticias':
                case 'novidades':
                case 'dicas':
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_4'] = $bA->recuperar('cor_4', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_5'] = $bA->recuperar('cor_5', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_6'] = $bA->recuperar('cor_6', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_7'] = $bA->recuperar('cor_7', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Properties                    
                    $result['qtd_items'] = $bA->recuperar('qtd_items', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['qtd_blocks'] = $bA->recuperar('qtd_blocks', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['comecar_em'] = $bA->recuperar('comecar_em', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_titulo_materia'] = $bA->recuperar('cor_titulo_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_materia'] = $bA->recuperar('cor_descricao_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_icone_materia'] = $bA->recuperar('cor_icone_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    for($i = 1; $i < 5; $i++){
                    $result['image_' . $i] = $bA->recuperar('image_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_type_' . $i] = $bA->recuperar('image_type_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_color_'. $i] = $bA->recuperar('image_color_'. $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    }
                    
                    //Special
                    $result['intervalo'] = $bA->recuperar('intervalo', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['fullscreen'] = $bA->recuperar('fullscreen', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['autoplay'] = $bA->recuperar('autoplay', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['animation'] = $bA->recuperar('animation', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['altura'] = $bA->recuperar('altura', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['lightbox'] = $bA->recuperar('lightbox', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['sombra'] = $bA->recuperar('sombra', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['caption'] = $bA->recuperar('caption', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_titulo_item'] = $bA->recuperar('cor_titulo_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_item'] = $bA->recuperar('cor_descricao_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao'] = $bA->recuperar('cor_botao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao2'] = $bA->recuperar('cor_botao2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao_label'] = $bA->recuperar('cor_botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_avancar'] = $bA->recuperar('cor_avancar', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_label'] = $bA->recuperar('botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_exibe'] = $bA->recuperar('botao_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['titulo_exibe'] = $bA->recuperar('titulo_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_paginacao'] = $bA->recuperar('cor_paginacao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_paginacao_ativo'] = $bA->recuperar('cor_paginacao_ativo', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    Yii::import('application.extensions.dbuzz.admin.MateriasManager');
                    $materiasHandler = new MateriasManager();  
                    
                    $result['materias'] = $materiasHandler->getLimitedContent($data['tipo'], ($result['comecar_em'] != '') ? $result['comecar_em'] : 0, ($result['qtd_items'] != '') ? $result['qtd_items'] : 10);
                    $result['url'] = 'materias/';
                    
                  
                    break;
                    
                case 'redes_sociais':
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['label_1'] = $bA->recuperar('label_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_1'] = $bA->recuperar('link_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_target_1'] = $bA->recuperar('link_target_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Redes Sociais
                    $result['ch_facebook'] = $bA->recuperar('ch_facebook', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']); 
                    $result['ch_twitter'] = $bA->recuperar('ch_twitter', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']); 
                    $result['ch_google'] = $bA->recuperar('ch_google', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']); 
                    
                    $result['extra'] = BlocksSupportUtils::getExtraContent($data);
          
                    $result['url'] = "";
                    break;
                
                case 'banners':
                    
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Properties
                    $result['order_by'] = $bA->recuperar('order_by', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['qtd_items'] = $bA->recuperar('qtd_items', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['comecar_em'] = $bA->recuperar('comecar_em', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_titulo_materia'] = $bA->recuperar('cor_titulo_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_materia'] = $bA->recuperar('cor_descricao_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_icone_materia'] = $bA->recuperar('cor_icone_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    Yii::import('application.extensions.dbuzz.DBManager');
                    $dbManager = new DBManager();
             
                    $result['banners'] = $dbManager->getBannersForPages($data['id_page'], true, $result['order_by']); 
                    $result['js'] = "outdoor_rotativo.js";                    
                    
                    $result['url'] = '';
                    break;
                
                case 'revistas':
                case 'revista':
                    
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Properties
                    $result['order_by'] = $bA->recuperar('order_by', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['qtd_items'] = 4;
                    $result['comecar_em'] = $bA->recuperar('comecar_em', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['id_galeria'] = $bA->recuperar('galeria', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    

                    $result['cor_titulo_materia'] = $bA->recuperar('cor_titulo_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_materia'] = $bA->recuperar('cor_descricao_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_icone_materia'] = $bA->recuperar('cor_icone_materia', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['link_1'] = $bA->recuperar('link_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Publicidade Online
                    if($data['tipo'] == 'publicidade_online'){
                        Yii::import('application.extensions.dbuzz.site.buscar.RelevanceManager');
                        $relevanceHandler = new RelevanceManager();

                        $session = MethodUtils::getSessionData();
                        $type = 'html_blocks'; $qtd = 4; $id = null;

                        $result['anuncios'] = $relevanceHandler->getAllBannersRecommended($id, $session['keywords'], $type, $type, $qtd);
                    }
                    
                    //Revistas
                    if($data['tipo'] == 'revistas'){
                        Yii::import('application.extensions.dbuzz.admin.special.RevistaManager');
                        $revistasHandler = new RevistaManager();

                        $result['revistas'] = $revistasHandler->getAllContentLimited(10);
                    }
                    
                    //Revista
                    if($data['tipo'] == 'revista'){
                        
                        
                        Yii::import('application.extensions.dbuzz.admin.special.RevistaManager');
                        Yii::import('application.extensions.utils.special.TemplatesUtils');
                        $revistasHandler = new RevistaManager();
                        
                        if($result['id_galeria'] == '') $result['id_galeria'] = 0;
                       
                        $result['revista'] = $revistasHandler->getTemplateById($result['id_galeria']);
                        //Get components for template
                        isset($result['revista']['id']) ? $result['componentes'] = TemplatesUtils::getModule($result['revista']['id'], $result['revista']) : $result['componentes'] = false;
                        
                        $baseUrl = Yii::app()->baseUrl;
                        $cs = Yii::app()->getClientScript();

                        $cs->registerCssFile($baseUrl . '/css/lib/flipbook/jquery.jscrollpane.custom.css', 'screen', CClientScript::POS_HEAD);
                        $cs->registerCssFile($baseUrl . '/css/lib/flipbook/bookblock.css', 'screen', CClientScript::POS_HEAD);
                        $cs->registerCssFile($baseUrl . '/css/lib/flipbook/custom2.css', 'screen', CClientScript::POS_HEAD);
    
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/modernizr.custom.79639.js', CClientScript::POS_HEAD);
                        
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.mousewheel.js', CClientScript::POS_END);
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.jscrollpane.min.js', CClientScript::POS_END);
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquerypp.custom.js', CClientScript::POS_END);
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/jquery.bookblock.js', CClientScript::POS_END);
                        $cs->registerScriptFile($baseUrl . '/js/lib/flipbook/page.js', CClientScript::POS_END);
                         
                    }

                    //$result['js'] = "outdoor_rotativo.js";                    
                    
                    $result['url'] = '';
                    break;
                
                case 'produtos':
                case 'publicidade_online': 
                case 'publicidade_dirigida': 
                case 'folha_pedidos':
                case 'eventos':
                    
                    case 'combo':
 
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Properties
                    $result['qtd_items'] = $bA->recuperar('qtd_items', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['id_galeria'] = $bA->recuperar('galeria', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Corrigir - Vitrine Barcelona usa
                    $result['galeria'] = $bA->recuperar('galeria', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['tipo_uso'] = $bA->recuperar('tipo_uso', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['qtd_items_query'] = $bA->recuperar('qtd_items_query', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_titulo_item'] = $bA->recuperar('cor_titulo_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_item'] = $bA->recuperar('cor_descricao_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao'] = $bA->recuperar('cor_botao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao2'] = $bA->recuperar('cor_botao2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao_label'] = $bA->recuperar('cor_botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_avancar'] = $bA->recuperar('cor_avancar', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_label'] = $bA->recuperar('botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_exibe'] = $bA->recuperar('botao_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['titulo_exibe'] = $bA->recuperar('titulo_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['descricao_exibe'] = $bA->recuperar('descricao_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['order_by'] = $bA->recuperar('order_by', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['modelo_banner'] = $bA->recuperar('modelo_banner', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_paginacao'] = $bA->recuperar('cor_paginacao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_paginacao_ativo'] = $bA->recuperar('cor_paginacao_ativo', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    for($i = 1; $i < 5; $i++){
                    $result['image_' . $i] = $bA->recuperar('image_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_type_' . $i] = $bA->recuperar('image_type_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_color_'. $i] = $bA->recuperar('image_color_'. $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['exibe_extra_'. $i] = $bA->recuperar('exibe_extra_'. $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    }
  
                    if($data['tipo'] == 'produtos'){
                        Yii::import('application.extensions.dbuzz.site.produtos.ProdutosManager');
                        Yii::import('application.extensions.dbuzz.admin.CategoriaManager');
                        $produtosHandler = new ProdutosManager();
                        $categoriasHandler = new CategoriaManager();

                        $result['vitrine'] = $produtosHandler->getContentByIdAttribute('vitrine'); 
                        $result['categorias'] = $categoriasHandler->getAllProductCategories();
                    }
                    
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);  
                    
                    $result['url'] = '';
                    break;
                
                case 'users':
                case 'galeria':
                case 'promocao':
                case 'videos':
                    //TODO Don't touch
                    
                    Yii::import('application.extensions.dbuzz.admin.GaleriaManager');                    
                    $galeriaHandler = new GaleriaManager();
                    
                    
                    $result['id'] = $data['id_componente'];
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //TODO se precisar trocar abaixo troque, usado em Promoção Space - DaniloMachado.com.br
                    $result['link_1'] = $bA->recuperar('link_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    //$result['link_target_1'] = $bA->recuperar('link_target_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['qtd_items'] = $bA->recuperar('qtd_items', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['qtd_items_query'] = $bA->recuperar('qtd_items_query', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['galeria'] = $bA->recuperar('galeria', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['categoria_galeria'] = $bA->recuperar('categoria_galeria', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    if($result['qtd_items'] == 0 || $result['qtd_items'] == "") $result['qtd_items'] = 4;
                    if($result['qtd_items_query'] == 0 || $result['qtd_items_query'] == "") $result['qtd_items_query'] = 4;
                    $result['comecar_em'] = $bA->recuperar('comecar_em', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Special
                    $result['intervalo'] = $bA->recuperar('intervalo', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['fullscreen'] = $bA->recuperar('fullscreen', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['autoplay'] = $bA->recuperar('autoplay', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['animation'] = $bA->recuperar('animation', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['altura'] = $bA->recuperar('altura', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['lightbox'] = $bA->recuperar('lightbox', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['sombra'] = $bA->recuperar('sombra', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['caption'] = $bA->recuperar('caption', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_titulo_item'] = $bA->recuperar('cor_titulo_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_descricao_item'] = $bA->recuperar('cor_descricao_item', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao'] = $bA->recuperar('cor_botao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao2'] = $bA->recuperar('cor_botao2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_botao_label'] = $bA->recuperar('cor_botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_avancar'] = $bA->recuperar('cor_avancar', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_label'] = $bA->recuperar('botao_label', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['botao_exibe'] = $bA->recuperar('botao_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['titulo_exibe'] = $bA->recuperar('titulo_exibe', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['cor_paginacao'] = $bA->recuperar('cor_paginacao', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_paginacao_ativo'] = $bA->recuperar('cor_paginacao_ativo', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $arrUser = explode('-', $result['galeria']);
         
                    if($data['tipo'] == 'users'){ 
                        Yii::import('application.extensions.utils.users.UserSupportUtils');
                        $tipo = "cliente";
                        if(isset($arrUser[0]) && isset($arrUser[1])){
                            $result['users'] = $galeriaHandler->getContentById($arrUser[0], $arrUser[1], 'users');

                            if($result['users']) {
                                for($p = 0; $p < count($result['users']); $p++){
                                    if($tipo == "profissional") $result['users'][$p]['profissional'] = UserSupportUtils::getUserDetailsByTag('profissional', $result['users'][$p]['id_graphic']);
                                    if($tipo == "cliente") $result['users'][$p]['cliente'] = UserSupportUtils::getUserDetailsByTag('cliente', $result['users'][$p]['id_graphic']);
                                }
                            }
                        }
                    }
                    
                    if($data['tipo'] == 'galeria'){
                        
                        if(isset($arrUser[0]) && isset($arrUser[1])){
                            $result['content'] = $galeriaHandler->getAllAllowedContent($arrUser[0], $arrUser[1], true);
                           // $result['galeria'] = $galeriaHander->getContentById($arrUser[0], $arrUser[1], 'galeria');
                        }
                    }  
                    
                    if($data['tipo'] == 'promocao'){
                        Yii::import('application.extensions.dbuzz.site.special.PromocaoManager');                    
                        $promocaoHandler = new PromocaoManager();                        
                        if($result['galeria'] != '') $result['content'] = $promocaoHandler->getContentById($result['galeria']);
                    } 
                    
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);  
                    
                    $result['url'] = '';
                    break;
                 
                case 'topo':
                    $result['url'] = 'topos/';
                    for($i = 1; $i < 5; $i++){
                        $result["image_".$i] = $bA->recuperar("image_". $i, "texto", $data["id_page"], $data["id_componente"], $data["id"]);
                        $result["image_type_".$i] = $bA->recuperar("image_type_" . $i, "inteiro", $data["id_page"], $data["id_componente"], $data["id"]);
                        $result["image_color_".$i] = $bA->recuperar("image_color_" . $i, "texto", $data["id_page"], $data["id_componente"], $data["id"]);
                    }
                    
                    $result['menu_texto_color'] = $bA->recuperar("menu_texto_color", "texto", $data["id_page"], $data["id_componente"], $data["id"]);
                    $result['menu_texto_hover'] = $bA->recuperar("menu_texto_hover", "texto", $data["id_page"], $data["id_componente"], $data["id"]);
                    $result['menu_borda']       = $bA->recuperar("menu_borda", "texto", $data["id_page"], $data["id_componente"], $data["id"]);
                    
                    break;                
                
                case 'precos':
                    $result['qtd_blocos'] = $bA->recuperar('qtd_blocos', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    for($i = 1; $i < 5; $i++){
                    $result['titulo_' . $i] = $bA->recuperar('titulo_' . $i, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_' . $i] = $bA->recuperar('subtitulo_' . $i, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_' . $i] = $bA->recuperar('texto_' . $i, 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['valor_' . $i] = $bA->recuperar('valor_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['centavos_' . $i] = $bA->recuperar('centavo_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['unidade_' . $i] = $bA->recuperar('unidade_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['frequencia_' . $i] = $bA->recuperar('frequencia_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['label_' . $i] = $bA->recuperar('label_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_' . $i] = $bA->recuperar('link_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['destaque_' . $i] = $bA->recuperar('destaque_' . $i, 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    }
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_4'] = $bA->recuperar('cor_4', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_block_1'] = $bA->recuperar('cor_block_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_block_2'] = $bA->recuperar('cor_block_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_block_3'] = $bA->recuperar('cor_block_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_block_4'] = $bA->recuperar('cor_block_4', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['url'] = "";
                    break;
                    
                case 'tabela':
                    Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils'); 
                    
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['label_1'] = $bA->recuperar('label_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_1'] = $bA->recuperar('link_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_target_1'] = $bA->recuperar('link_target_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['qtd_colunas'] = $bA->recuperar('qtd_colunas', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['items'] = PaginasAdvancedUtils::getItemsAttributes($data['id_componente'], $data['id'], $data['id_page']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //COlunas
                    for($i = 1; $i <= 5; $i++){
                    $result['col_cor_' . $i] = $bA->recuperar('col_cor_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['col_cor_font_' . $i] = $bA->recuperar('col_cor_font_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['col_alinhamento_' . $i] = $bA->recuperar('col_alinhamento_' . $i, 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    }
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);                    
                    $result['url'] = "";
                    break;
                    
                case 'ecommerce':
                    $result['titulo_1'] = $bA->recuperar('titulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['subtitulo_1'] = $bA->recuperar('subtitulo_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['texto_1'] = $bA->recuperar('texto_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['label_1'] = $bA->recuperar('label_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_1'] = $bA->recuperar('link_1', 'descricao', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['link_target_1'] = $bA->recuperar('link_target_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    $result['image_1'] = $bA->recuperar('image_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Color
                    $result['cor_1'] = $bA->recuperar('cor_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_2'] = $bA->recuperar('cor_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['cor_3'] = $bA->recuperar('cor_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Alinhamento
                    $result['alinhamento_1'] = $bA->recuperar('alinhamento_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_2'] = $bA->recuperar('alinhamento_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    $result['alinhamento_3'] = $bA->recuperar('alinhamento_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
                    
                    //Posição
                    $result['layout_1'] = $bA->recuperar('layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);                    
                    $result['url'] = "";
                    break;
               
            }
            
            $result['is_container'] = $bA->recuperar('is_container', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            $result['margin_top'] = $bA->recuperar('margin_top', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            $result['margin_bottom'] = $bA->recuperar('margin_bottom', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            $result['padding_top'] = $bA->recuperar('padding_top', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            $result['padding_bottom'] = $bA->recuperar('padding_bottom', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['background_type'] = $bA->recuperar('background_type', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            $result['background_color'] = $bA->recuperar('background_color', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['background'] = $bA->recuperar('background', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['titulo_componente'] = $bA->recuperar('titulo_componente', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['is_full'] = $bA->recuperar('is_full', 'inteiro', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['id'] = $data['id'];
            $result['id_componente'] = $data['id_componente'];
            
            if($isLoremYpsum) $result['isAdmin'] = true;
            
            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockUtils - getPaginationInfo() " . $e->getMessage();
        }

    }
    
    /**
     * Método para salvar conteúdo
     * 
     * Os valores passado no final do saveItem são referente ao tipo de dado, se é inteiro, texto ou 
     * se é uma imagem, pois se for imagem quando recupera ele já roda uma rotina para puxar a imagem 
     * e não a referncia dela tipo f_345, ou c_768 ou p_344
     *
     * @param string
     *
    */
    public static function saveComponentContent($data){
        
        Yii::import('application.extensions.utils.special.BlocksCSSUtils');
        Yii::import('application.extensions.utils.special.BlocksSupportUtils');
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        try{
            switch($data['info']['modelo']){

                case 'artigo':
                case 'newsletter':
                case 'reservas':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] =trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['label_1'])){$result['label_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['label_1'], ENT_QUOTES, 'utf-8', false)));; BlocksUtils::saveItem('label_1', $params['label_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_1'])){$result['link_1'] = addslashes($params['link_1']); BlocksUtils::saveItem('link_1', $params['link_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_target_1'])){$result['link_target_1'] = addslashes($params['link_target_1']); BlocksUtils::saveItem('link_target_1', $params['link_target_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //$result['texto_1'] = "Lorem ipsum \"dolor\" sit amet,\nconsectetur \\ adipiscing elit."; 
                    
                    //$result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', $result['texto_1']) );
                    
                    if(isset($params['image_1'])){ $result['image_1'] = $params['image_1']; BlocksUtils::saveItem('image_1', $params['image_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Posição
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
  
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    $result['extra'] = BlocksSupportUtils::saveExtraContent($params, $data);
                    
                    $result['url'] = '';
                    break;
                
                case 'artigo_complex':
                    
                    if(isset($params['qtd_blocos'])){ $result['qtd_blocos'] = $params['qtd_blocos']; BlocksUtils::saveItem('qtd_blocos', $params['qtd_blocos'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    
                    for($i = 1; $i < 5; $i++){
                        if(isset($params['titulo_' . $i])){ $result['titulo_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_' . $i, $params['titulo_' . $i], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['subtitulo_' . $i])){ $result['subtitulo_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['subtitulo_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_' . $i, $params['subtitulo_' . $i], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['texto_' . $i])){ $result['texto_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['texto_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_' . $i, addslashes($params['texto_' . $i]), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['cor_extra_' . $i])){ $result['cor_extra_' . $i] = $params['cor_extra_' . $i]; BlocksUtils::saveItem('cor_extra_' . $i, $params['cor_extra_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    }
                    
                    for($p = 1; $p < 5; $p++){
                        if(isset($params['type_image_' . $p])){
                            $result['image_type_' . $p] = $params['type_image_' . $p]; BlocksUtils::saveItem('image_type_' . $p, $params['type_image_' . $p], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                            if($params['type_image_' . $p] == 1){
                                if(isset($params['image_' . $p])) $image1 = $params['image_' . $p];
                                if(isset($params['image_' . $p])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                            if($params['type_image_' . $p] == 4){
                                if(isset($params['icone_' . $p])) $image1 = $params['icone_' . $p];
                                if(isset($params['icone_' . $p])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                                if(isset($params['icone_cor_' . $p])){ $result['icone_cor_' . $p] = $params['icone_cor_' . $p]; BlocksUtils::saveItem('icone_cor_' . $p, $params['icone_cor_' . $p], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                        }
                    } 
                    
                    for($p = 1; $p < 5; $p++){
                        if(isset($params['type_bg_bloco_' . $p])){
                            $result['bg_bloco_type_' . $p] = $params['type_bg_bloco_' . $p]; BlocksUtils::saveItem('bg_bloco_type_' . $p, $params['type_bg_bloco_' . $p], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                            if($params['type_bg_bloco_' . $p] == 1){
                                if(isset($params['bg_bloco_' . $p])) $image1 = $params['bg_bloco_' . $p];
                                if(isset($params['bg_bloco_' . $p])){ $result['bg_bloco_' . $p] = $image1; BlocksUtils::saveItem('bg_bloco_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                            /*
                            if($params['type_bg_bloco_' . $p] == 4){
                                if(isset($params['icone_' . $p])) $image1 = $params['icone_' . $p];
                                if(isset($params['icone_' . $p])){ $result['bg_bloco_' . $p] = $image1; BlocksUtils::saveItem('bg_bloco_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                                if(isset($params['icone_cor_' . $p])){ $result['icone_cor_' . $p] = $params['icone_cor_' . $p]; BlocksUtils::saveItem('icone_cor_' . $p, $params['icone_cor_' . $p], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            } */
                        }
                    }
                    
                    //Color
                    for($it = 1; $it < 5; $it++){
                        for($c = 1; $c < 5; $c++){
                            if(isset($params["item".$it."_cor_" . $c]))        { $result["item".$it."_cor_" . $c] = $params["item".$it."_cor_" . $c]; BlocksUtils::saveItem("item".$it."_cor_" . $c, $params["item".$it."_cor_" . $c], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            if(isset($params["item".$it."_alinhamento_" . $c])){ $result["item".$it."_alinhamento_" . $c] = $params["item".$it."_alinhamento_" . $c]; BlocksUtils::saveItem("item".$it."_alinhamento_" . $c, $params["item".$it."_alinhamento_" . $c], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            if(isset($params["item".$it."_link_" . $c]))       { $result["item".$it."_link_" . $c] = $params["item".$it."_link_" . $c]; BlocksUtils::saveItem("item".$it."_link_" . $c, $params["item".$it."_link_" . $c], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            if(isset($params["item".$it."_font_" . $c]))       { $result["item".$it."_font_" . $c] = $params["item".$it."_font_" . $c]; BlocksUtils::saveItem("item".$it."_font_" . $c, $params["item".$it."_font_" . $c], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            //save font into activity server database
                            if(isset($params["item".$it."_font_" . $c])) MethodUtils::setActivityServer('fonte', $data['id_componente'], "item".$it."_font_" . $c, $params["item".$it."_font_" . $c], $data['id_page']);
                        }
                    }
                    
                    //Botão
                    if(isset($params['cor_botao'])){ $result['cor_botao'] = $params['cor_botao'];    BlocksUtils::saveItem('cor_botao', $params['cor_botao'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao2'])){ $result['cor_botao2'] = $params['cor_botao2']; BlocksUtils::saveItem('cor_botao2', $params['cor_botao2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao_label'])){ $result['cor_botao_label'] = $params['cor_botao_label']; BlocksUtils::saveItem('cor_botao_label', $params['cor_botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['botao_exibe'])){ $result['botao_exibe'] = 1;                   BlocksUtils::saveItem('botao_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['botao_exibe'] = 0; BlocksUtils::saveItem('botao_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['botao_label'])){ $result['botao_label'] = htmlentities( (string)$params['botao_label'], ENT_QUOTES, 'utf-8', false); BlocksUtils::saveItem('botao_label', $params['botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    $result['extra'] = BlocksSupportUtils::saveExtraContent($params, $data);
                    
                    $result['url'] = '';
                    break;
                    
                case 'topo':
                    
                    for($i = 1; $i < 5; $i++){
                        if(isset($params['type_image_' . $i])){
                            $result['type_image_' . $i] = BlocksUtils::saveItem('image_type_' . $i, $params['type_image_' . $i], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                            if($params['type_image_' . $i] == 0){
                                if(isset($params['image_' . $i])) $image1 = $params['image_' . $i];
                                if(isset($params['image_' . $i])){ $result['image_' . $i] = $image1; BlocksUtils::saveItem('image_' . $i, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'image');}
                            }
                            if($params['type_image_' . $i] == 1){
                                if(isset($params['texture_image_' . $i])) $image1 = $params['texture_image_' . $i];
                                if(isset($params['texture_image_' . $i])){ $result['image_' . $i] = $image1; BlocksUtils::saveItem('image_' . $i, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}

                            }
                            if($params['type_image_' . $i] == 2){
                                if(isset($params['color_image_' . $i])) $image1 = $params['color_image_' . $i];
                                if(isset($params['color_image_' . $i])){ $result['image_1'] = $image1; BlocksUtils::saveItem('image_' . $i, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                                if(isset($params['color_texture_image_' . $i])){$result['color_texture_image' . $i] = $params['color_texture_image_' . $i]; BlocksUtils::saveItem('image_color_' . $i, $params['color_texture_image_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                        }
                    }                    
                    
                    if(isset($params['menu_texto_color'])){ $result['menu_texto_color'] = $params['menu_texto_color']; BlocksUtils::saveItem('menu_texto_color', $params['menu_texto_color'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['menu_texto_hover'])){ $result['menu_texto_hover'] = $params['menu_texto_hover']; BlocksUtils::saveItem('menu_texto_hover', $params['menu_texto_hover'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['menu_borda'])){ $result['menu_borda'] = $params['menu_borda']; BlocksUtils::saveItem('menu_borda', $params['menu_borda'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2'];BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3'];BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    $result['url'] = '';
                    break;
                
                case 'noticias':
                case 'novidades':
                case 'dicas':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_4'])){ $result['cor_4'] = $params['cor_4']; BlocksUtils::saveItem('cor_4', $params['cor_4'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_5'])){ $result['cor_5'] = $params['cor_5']; BlocksUtils::saveItem('cor_5', $params['cor_5'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_6'])){ $result['cor_6'] = $params['cor_6']; BlocksUtils::saveItem('cor_6', $params['cor_6'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_7'])){ $result['cor_7'] = $params['cor_7']; BlocksUtils::saveItem('cor_7', $params['cor_7'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Propriedade
                    if(isset($params['comecar_em'])){ $result['comecar_em'] = $params['comecar_em']; BlocksUtils::saveItem('comecar_em', $params['comecar_em'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['qtd_items'])){ $result['qtd_items'] = $params['qtd_items']; BlocksUtils::saveItem('qtd_items', $params['qtd_items'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['qtd_blocks'])){ $result['qtd_blocks'] = $params['qtd_blocks']; BlocksUtils::saveItem('qtd_blocks', $params['qtd_blocks'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    
                    //Cor das fontes das materias
                    if(isset($params['cor_titulo_materia'])){ $result['cor_titulo_materia'] = $params['cor_titulo_materia']; BlocksUtils::saveItem('cor_titulo_materia', $params['cor_titulo_materia'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_descricao_materia'])){ $result['cor_descricao_materia'] = $params['cor_descricao_materia']; BlocksUtils::saveItem('cor_descricao_materia', $params['cor_descricao_materia'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_icone_materia'])){ $result['cor_icone_materia'] = $params['cor_icone_materia']; BlocksUtils::saveItem('cor_icone_materia', $params['cor_icone_materia'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    //Alinhamento
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Cor das fontes dos items
                    if(isset($params['cor_titulo_item'])){ $result['cor_titulo_item'] = $params['cor_titulo_item']; BlocksUtils::saveItem('cor_titulo_item', $params['cor_titulo_item'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_descricao_item'])){ $result['cor_descricao_item'] = $params['cor_descricao_item']; BlocksUtils::saveItem('cor_descricao_item', $params['cor_descricao_item'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao'])){ $result['cor_botao'] = $params['cor_botao']; BlocksUtils::saveItem('cor_botao', $params['cor_botao'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao2'])){ $result['cor_botao2'] = $params['cor_botao2']; BlocksUtils::saveItem('cor_botao2', $params['cor_botao2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_avancar'])){ $result['cor_avancar'] = $params['cor_avancar']; BlocksUtils::saveItem('cor_avancar', $params['cor_avancar'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao_label'])){ $result['cor_botao_label'] = $params['cor_botao_label']; BlocksUtils::saveItem('cor_botao_label', $params['cor_botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['botao_label'])){ $result['botao_label'] = $params['botao_label']; BlocksUtils::saveItem('botao_label', $params['botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['botao_exibe'])){ $result['botao_exibe'] = 1; BlocksUtils::saveItem('botao_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['botao_exibe'] = 0; BlocksUtils::saveItem('botao_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['titulo_exibe'])){ $result['titulo_exibe'] = 1; BlocksUtils::saveItem('titulo_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['titulo_exibe'] = 0; BlocksUtils::saveItem('titulo_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['descricao_exibe'])){ $result['descricao_exibe'] = 1; BlocksUtils::saveItem('descricao_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['descricao_exibe'] = 0; BlocksUtils::saveItem('descricao_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['cor_paginacao'])){ $result['cor_paginacao'] = $params['cor_paginacao']; BlocksUtils::saveItem('cor_paginacao', $params['cor_paginacao'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_paginacao_ativo'])){ $result['cor_paginacao_ativo'] = $params['cor_paginacao_ativo']; BlocksUtils::saveItem('cor_paginacao_ativo', $params['cor_paginacao_ativo'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Special
                    if(isset($params['altura'])){ $result['altura'] = $params['altura']; BlocksUtils::saveItem('altura', $params['altura'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['intervalo'])){ $result['intervalo'] = $params['intervalo']; BlocksUtils::saveItem('intervalo', $params['intervalo'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['fullscreen'])){$result['fullscreen'] = 1; BlocksUtils::saveItem('fullscreen', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['fullscreen'] = 0; BlocksUtils::saveItem('fullscreen', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['autoplay'])){$result['autoplay'] = 1; BlocksUtils::saveItem('autoplay', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['autoplay'] = 0; BlocksUtils::saveItem('autoplay', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['animation'])){ $result['animation'] = $params['animation']; BlocksUtils::saveItem('animation', $params['animation'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['lightbox'])){$result['lightbox'] = 1; BlocksUtils::saveItem('lightbox', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['lightbox'] = 0; BlocksUtils::saveItem('lightbox', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['sombra'])){$result['sombra'] = 1; BlocksUtils::saveItem('sombra', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['sombra'] = 0; BlocksUtils::saveItem('sombra', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['caption'])){$result['caption'] = 1; BlocksUtils::saveItem('caption', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['caption'] = 0; BlocksUtils::saveItem('caption', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    
                    //Posição
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
  
                    
                    for($p = 1; $p < 5; $p++){
                        if(isset($params['type_image_' . $p])){
                            $result['image_type_' . $p] = $params['type_image_' . $p]; BlocksUtils::saveItem('image_type_' . $p, $params['type_image_' . $p], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                            if($params['type_image_' . $p] == 0){
                                if(isset($params['image_' . $p. "_background"])) $image1 = $params['image_' . $p . "_background"];
                                if(isset($params['image_' . $p."_background"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                            if($params['type_image_' . $p] == 1){
                                if(isset($params['image_' . $p ."_texture"])) $image1 = $params['image_' . $p . "_texture"];
                                if(isset($params['image_' . $p ."_texture"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                   
                            }
                            if($params['type_image_' . $p] == 2){
                                if(isset($params['image_' . $p ."_effect"])) $image1 = $params['image_' . $p . "_effect"];
                                if(isset($params['image_' . $p ."_effect"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                                if(isset($params['image_' . $p ."_color"])){ $result['image_color_' . $p] = $params['image_' . $p . "_color"]; BlocksUtils::saveItem('image_color_' . $p, $params['image_' . $p . "_color"], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                        }
                    }
                    $result['url'] = 'materias/';
                    break;
                    
                case 'redes_sociais':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] =trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['label_1'])){$result['label_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['label_1'], ENT_QUOTES, 'utf-8', false)));; BlocksUtils::saveItem('label_1', $params['label_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_1'])){$result['link_1'] = addslashes($params['link_1']); BlocksUtils::saveItem('link_1', $params['link_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_target_1'])){$result['link_target_1'] = addslashes($params['link_target_1']); BlocksUtils::saveItem('link_target_1', $params['link_target_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Posição
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['image_1'])){ $result['image_1'] = $params['image_1']; BlocksUtils::saveItem('image_1', $params['image_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Redes Sociais
                    if(isset($params['ch_facebook'])){ $result['ch_facebook'] = 1; BlocksUtils::saveItem('ch_facebook', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['ch_facebook'] = 0; BlocksUtils::saveItem('ch_facebook', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['ch_twitter'])){ $result['ch_twitter'] = 1; BlocksUtils::saveItem('ch_twitter', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['ch_twitter'] = 0; BlocksUtils::saveItem('ch_twitter', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['ch_google'])){ $result['ch_google'] = 1; BlocksUtils::saveItem('ch_google', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['ch_google'] = 0; BlocksUtils::saveItem('ch_google', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
  
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    $result['extra'] = BlocksSupportUtils::saveExtraContent($params, $data);
                    
                    $result['url'] = '';
                    break;
                
                case 'users':
                case 'produtos':
                case 'galeria':
                case 'promocao':
                case 'revista':
                case 'revistas':
                case 'publicidade_online':
                case 'publicidade_dirigida':
                case 'folha_pedidos':
                case 'eventos':
                case 'videos':
                    
                case "combo":
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    //Alinhamento
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['comecar_em'])){ $result['comecar_em'] = $params['comecar_em']; BlocksUtils::saveItem('comecar_em', $params['comecar_em'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['qtd_items'])){ $result['qtd_items'] = $params['qtd_items']; BlocksUtils::saveItem('qtd_items', $params['qtd_items'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['qtd_items_query'])){ $result['qtd_items_query'] = $params['qtd_items_query']; BlocksUtils::saveItem('qtd_items_query', $params['qtd_items_query'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['id_galeria'])){ $result['galeria'] = $params['id_galeria']; BlocksUtils::saveItem('galeria', $params['id_galeria'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}else{$result['galeria'] = 0;}
                    if(isset($params['categoria_galeria'])){ $result['categoria_galeria'] = $params['categoria_galeria']; BlocksUtils::saveItem('categoria_galeria', $params['categoria_galeria'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['categoria_galeria'] = 0;}
                    if(isset($params['order_by'])){ $result['order_by'] = $params['order_by']; BlocksUtils::saveItem('order_by', $params['order_by'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['modelo_banner'])){ $result['modelo_banner'] = $params['modelo_banner']; BlocksUtils::saveItem('modelo_banner', $params['modelo_banner'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['tipo_uso'])){ $result['tipo_uso'] = $params['tipo_uso']; BlocksUtils::saveItem('tipo_uso', $params['tipo_uso'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Cor das fontes dos items
                    if(isset($params['cor_titulo_item'])){ $result['cor_titulo_item'] = $params['cor_titulo_item']; BlocksUtils::saveItem('cor_titulo_item', $params['cor_titulo_item'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_descricao_item'])){ $result['cor_descricao_item'] = $params['cor_descricao_item']; BlocksUtils::saveItem('cor_descricao_item', $params['cor_descricao_item'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao'])){ $result['cor_botao'] = $params['cor_botao']; BlocksUtils::saveItem('cor_botao', $params['cor_botao'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao2'])){ $result['cor_botao2'] = $params['cor_botao2']; BlocksUtils::saveItem('cor_botao2', $params['cor_botao2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_avancar'])){ $result['cor_avancar'] = $params['cor_avancar']; BlocksUtils::saveItem('cor_avancar', $params['cor_avancar'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_botao_label'])){ $result['cor_botao_label'] = $params['cor_botao_label']; BlocksUtils::saveItem('cor_botao_label', $params['cor_botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['botao_label'])){ $result['botao_label'] = $params['botao_label']; BlocksUtils::saveItem('botao_label', $params['botao_label'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['botao_exibe'])){ $result['botao_exibe'] = 1; BlocksUtils::saveItem('botao_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['botao_exibe'] = 0; BlocksUtils::saveItem('botao_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['titulo_exibe'])){ $result['titulo_exibe'] = 1; BlocksUtils::saveItem('titulo_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['titulo_exibe'] = 0; BlocksUtils::saveItem('titulo_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['descricao_exibe'])){ $result['descricao_exibe'] = 1; BlocksUtils::saveItem('descricao_exibe', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['descricao_exibe'] = 0; BlocksUtils::saveItem('descricao_exibe', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['cor_paginacao'])){ $result['cor_paginacao'] = $params['cor_paginacao']; BlocksUtils::saveItem('cor_paginacao', $params['cor_paginacao'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_paginacao_ativo'])){ $result['cor_paginacao_ativo'] = $params['cor_paginacao_ativo']; BlocksUtils::saveItem('cor_paginacao_ativo', $params['cor_paginacao_ativo'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Special
                    if(isset($params['altura'])){ $result['altura'] = $params['altura']; BlocksUtils::saveItem('altura', $params['altura'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['intervalo'])){ $result['intervalo'] = $params['intervalo']; BlocksUtils::saveItem('intervalo', $params['intervalo'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['fullscreen'])){$result['fullscreen'] = 1; BlocksUtils::saveItem('fullscreen', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['fullscreen'] = 0; BlocksUtils::saveItem('fullscreen', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['autoplay'])){$result['autoplay'] = 1; BlocksUtils::saveItem('autoplay', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['autoplay'] = 0; BlocksUtils::saveItem('autoplay', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['animation'])){ $result['animation'] = $params['animation']; BlocksUtils::saveItem('animation', $params['animation'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['lightbox'])){$result['lightbox'] = 1; BlocksUtils::saveItem('lightbox', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['lightbox'] = 0; BlocksUtils::saveItem('lightbox', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['sombra'])){$result['sombra'] = 1; BlocksUtils::saveItem('sombra', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['sombra'] = 0; BlocksUtils::saveItem('sombra', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['caption'])){$result['caption'] = 1; BlocksUtils::saveItem('caption', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['caption'] = 0; BlocksUtils::saveItem('caption', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    
                    for($p = 1; $p < 5; $p++){
                        if(isset($params['type_image_' . $p])){
                            $result['image_type_' . $p] = $params['type_image_' . $p]; BlocksUtils::saveItem('image_type_' . $p, $params['type_image_' . $p], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                            if($params['type_image_' . $p] == 0){
                                if(isset($params['image_' . $p. "_background"])) $image1 = $params['image_' . $p . "_background"];
                                if(isset($params['image_' . $p."_background"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                            if($params['type_image_' . $p] == 1){
                                if(isset($params['image_' . $p ."_texture"])) $image1 = $params['image_' . $p . "_texture"];
                                if(isset($params['image_' . $p ."_texture"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                   
                            }
                            if($params['type_image_' . $p] == 2){
                                if(isset($params['image_' . $p ."_effect"])) $image1 = $params['image_' . $p . "_effect"];
                                if(isset($params['image_' . $p ."_effect"])){ $result['image_' . $p] = $image1; BlocksUtils::saveItem('image_' . $p, $image1, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                                if(isset($params['image_' . $p ."_color"])){ $result['image_color_' . $p] = $params['image_' . $p . "_color"]; BlocksUtils::saveItem('image_color_' . $p, $params['image_' . $p . "_color"], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                            }
                        }
                        
                        if(isset($params['exibe_extra_' . $p])){ $result['exibe_extra_' . $p] = 1; BlocksUtils::saveItem('exibe_extra_' . $p, 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['exibe_extra_' . $p] = 0; BlocksUtils::saveItem('exibe_extra_' . $p, 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                        if(isset($params['link_' . $p])){ $result['link_' . $p] = $params['link_' . $p]; BlocksUtils::saveItem('link_' . $p, $params['link_' . $p], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    }
                    
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    $result['url'] = '';
                    
                    break;
                    
                case 'banners':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Propriedade
                    if(isset($params['comecar_em'])){ $result['comecar_em'] = $params['comecar_em']; BlocksUtils::saveItem('comecar_em', $params['comecar_em'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    if(isset($params['order_by'])){ $result['order_by'] = $params['order_by']; BlocksUtils::saveItem('order_by', $params['order_by'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    $result['url'] = '';
                    break;
                    
                case 'precos':
                    if(isset($params['qtd_blocos'])){ $result['qtd_blocos'] = $params['qtd_blocos']; BlocksUtils::saveItem('qtd_blocos', $params['qtd_blocos'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    for($i = 1; $i < 5; $i++){
                        if(isset($params['titulo_' . $i])){ $result['titulo_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_' . $i, $params['titulo_' . $i], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['subtitulo_' . $i])){ $result['subtitulo_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['subtitulo_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_' . $i, $params['subtitulo_' . $i], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['texto_' . $i])){ $result['texto_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['texto_'. $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_' . $i, addslashes($params['texto_'. $i]), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['valor_' . $i])){ $result['valor_' . $i] = $params['valor_' . $i]; BlocksUtils::saveItem('valor_' . $i, $params['valor_' . $i], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                        if(isset($params['centavos_' . $i])){ $result['centavos_' . $i] = $params['centavos_' . $i]; BlocksUtils::saveItem('centavo_' . $i, $params['centavos_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['unidade_' . $i])){ $result['unidade_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['unidade_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('unidade_' . $i, $params['unidade_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['frequencia_' . $i])){ $result['frequencia_' . $i] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['frequencia_' . $i], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('frequencia_' . $i, $params['frequencia_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['label_' . $i])){ $result['label_' . $i] = $params['label_' . $i]; BlocksUtils::saveItem('label_' . $i, $params['label_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['link_' . $i])){ $result['link_' . $i] = $params['link_' . $i]; BlocksUtils::saveItem('link_' . $i, $params['link_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                        if(isset($params['destaque_' . $i])){$result['destaque_' . $i] = 1; BlocksUtils::saveItem('destaque_' . $i, 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['destaque_' . $i] = 0; BlocksUtils::saveItem('destaque_' . $i, 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    }
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_4'])){ $result['cor_4'] = $params['cor_4']; BlocksUtils::saveItem('cor_4', $params['cor_4'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['cor_block_1'])){ $result['cor_block_1'] = $params['cor_block_1']; BlocksUtils::saveItem('cor_block_1', $params['cor_block_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_block_2'])){ $result['cor_block_2'] = $params['cor_block_2']; BlocksUtils::saveItem('cor_block_2', $params['cor_block_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_block_3'])){ $result['cor_block_3'] = $params['cor_block_3']; BlocksUtils::saveItem('cor_block_3', $params['cor_block_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_block_4'])){ $result['cor_block_4'] = $params['cor_block_4']; BlocksUtils::saveItem('cor_block_4', $params['cor_block_4'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    $result['url'] = '';
                    break;
                    
                case 'tabela':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] =trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['label_1'])){$result['label_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['label_1'], ENT_QUOTES, 'utf-8', false)));; BlocksUtils::saveItem('label_1', $params['label_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_1'])){$result['link_1'] = addslashes($params['link_1']); BlocksUtils::saveItem('link_1', $params['link_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_target_1'])){$result['link_target_1'] = addslashes($params['link_target_1']); BlocksUtils::saveItem('link_target_1', $params['link_target_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //$result['texto_1'] = "Lorem ipsum \"dolor\" sit amet,\nconsectetur \\ adipiscing elit."; 
                    
                    //$result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', $result['texto_1']) );
                    
                    if(isset($params['image_1'])){ $result['image_1'] = $params['image_1']; BlocksUtils::saveItem('image_1', $params['image_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['qtd_colunas'])){ $result['qtd_colunas'] = $params['qtd_colunas']; BlocksUtils::saveItem('qtd_colunas', $params['qtd_colunas'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
                    
                    //Posição
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
  
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Colunas
                    for($i = 1; $i <= 5; $i++){
                    if(isset($params['col_cor_' . $i])){ $result['col_cor_' .$i] = $params['col_cor_' .$i]; BlocksUtils::saveItem('col_cor_' . $i, $params['col_cor_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['col_cor_font_' . $i])){ $result['col_cor_font_' .$i] = $params['col_cor_font_' .$i]; BlocksUtils::saveItem('col_cor_font_' . $i, $params['col_cor_font_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['col_alinhamento_' . $i])){ $result['col_alinhamento_' . $i] = $params['col_alinhamento_' .$i]; BlocksUtils::saveItem('col_alinhamento_' . $i, $params['col_alinhamento_' . $i], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    }
                    
                    $result['url'] = '';
                    break;
                    
                case 'ecommerce':
                    if(isset($params['titulo_1'])){ $result['titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('titulo_1', $params['titulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['subtitulo_1'])){ $result['subtitulo_1'] =trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['subtitulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('subtitulo_1', $params['subtitulo_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['texto_1'])){ $result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('texto_1', addslashes($params['texto_1']), 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['label_1'])){$result['label_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string) $params['label_1'], ENT_QUOTES, 'utf-8', false)));; BlocksUtils::saveItem('label_1', $params['label_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_1'])){$result['link_1'] = addslashes($params['link_1']); BlocksUtils::saveItem('link_1', $params['link_1'], 'descricao', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['link_target_1'])){$result['link_target_1'] = addslashes($params['link_target_1']); BlocksUtils::saveItem('link_target_1', $params['link_target_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //$result['texto_1'] = "Lorem ipsum \"dolor\" sit amet,\nconsectetur \\ adipiscing elit."; 
                    
                    //$result['texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', $result['texto_1']) );
                    
                    if(isset($params['image_1'])){ $result['image_1'] = $params['image_1']; BlocksUtils::saveItem('image_1', $params['image_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    //Posição
                    if(isset($params['layout_1'])){ $result['layout_1'] = $params['layout_1']; BlocksUtils::saveItem('layout_1', $params['layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
  
                    //Color
                    if(isset($params['cor_1'])){ $result['cor_1'] = $params['cor_1']; BlocksUtils::saveItem('cor_1', $params['cor_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_2'])){ $result['cor_2'] = $params['cor_2']; BlocksUtils::saveItem('cor_2', $params['cor_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['cor_3'])){ $result['cor_3'] = $params['cor_3']; BlocksUtils::saveItem('cor_3', $params['cor_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    
                    if(isset($params['alinhamento_1'])){ $result['alinhamento_1'] = $params['alinhamento_1']; BlocksUtils::saveItem('alinhamento_1', $params['alinhamento_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_2'])){ $result['alinhamento_2'] = $params['alinhamento_2']; BlocksUtils::saveItem('alinhamento_2', $params['alinhamento_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    if(isset($params['alinhamento_3'])){ $result['alinhamento_3'] = $params['alinhamento_3']; BlocksUtils::saveItem('alinhamento_3', $params['alinhamento_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
                    $result['url'] = '';
                    break;
     
            } 
            
            //Propriedade
            $result['id'] = $data['id_row'];
            if(isset($params['is_container'])){$result['is_container'] = 1; BlocksUtils::saveItem('is_container', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['is_container'] = 0; BlocksUtils::saveItem('is_container', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['margin_top'])){ $result['margin_top'] = $params['margin_top']; $set['margin_top'] = BlocksUtils::saveItem('margin_top', $params['margin_top'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['margin_bottom'])){ $result['margin_bottom'] = $params['margin_bottom']; $set['margin_bottom'] = BlocksUtils::saveItem('margin_bottom', $params['margin_bottom'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['padding_top'])){ $result['padding_top'] = $params['padding_top']; $set['padding_top'] = BlocksUtils::saveItem('padding_top', $params['padding_top'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['padding_bottom'])){ $result['padding_bottom'] = $params['padding_bottom']; $set['padding_bottom'] = BlocksUtils::saveItem('padding_bottom', $params['padding_bottom'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['is_full'])){$result['is_full'] = 1; BlocksUtils::saveItem('is_full', 1, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}else{$result['is_full'] = 0; BlocksUtils::saveItem('is_full', 0, 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');}
            if(isset($params['titulo_componente'])) $result['titulo_componente'] = BlocksUtils::saveItem('titulo_componente', $params['titulo_componente'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');
            
            if(isset($params['type_background'])) {
                $result['background_type'] = $params['type_background']; $set['type_background'] = BlocksUtils::saveItem('background_type', $params['type_background'], 'inteiro', $data['id_page'], $data['id_componente'], $data['id_row'], 'inteiro');
                if($params['type_background'] == 0){
                    $background = $params['image_background'];
                }else if($params['type_background'] == 2){                    
                    $background = $params['color_background'];  
                    $result['background_color'] = $params['cor_texture']; $set['cor_texture'] = BlocksUtils::saveItem('background_color', $params['cor_texture'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');
                
                }else{
                    $background = $params['texture_background'];                    
                }
                $result['background'] = $background; $set['background'] = BlocksUtils::saveItem('background', $background, 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');
            }
                 
            //array('titulo_1' => 'Teste', 'subtitulo_1' => 'Teste 2', 'texto_1' => 'Teste 2', 'url' =>'', 'is_full' => false, 'margin_bottom' => 0, 'margin_bottom' => 0,'margin_top' => 0,'padding_bottom' => 0,'padding_top' => 0, 'background' => '', 'background_type' => '', 'item1_cor_3' => '', 'item1_cor_2' => '', 'item1_cor_1' => '', 'item1_cor_4' => '', 'item1_alinhamento_1' => '', 'item1_alinhamento_2' => '', 'item1_alinhamento_3' => '', 'item2_cor_1' => '')
            $json = json_encode($result);
            $setJSON = BlocksUtils::updateComponenteAttribute($data['id_row'], 'json', $json);
            
            $update = BlocksCSSUtils::updateCSS($data);
            
            //Clear cache data
            $clearSessionArg = MethodUtils::cleanSessionData(array('SES_ROWS_' . $data['id_page']));
            $clearSessionArg = MethodUtils::clearAllCache();
            
            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockUtils - saveComponentContent() " . $e->getMessage();
        }
    }
    
    /**
     * Método para salvar conteúdo
     *
     * @param string
     *
    */
    public static function saveItem($label, $value, $field, $id_pagina, $id_componente, $id_row, $tipo, $plataforma = 'desktop'){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BlocksAttribute');

        $bA = new BlocksAttribute();
        $bA->setCurrentUser(0); 
        
        $result = $bA->adicionar($label, $value, $field, $id_pagina, $id_componente, $id_row, $tipo, $plataforma);
        
        return $result;
    }
    
    /**
     * Método para recuperar um atributo em especial
     *
     * @param number id
     *
    */
    public static function getItemAttribute($attribute, $id, $id_componente, $id_page, $field = 'texto'){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BlocksAttribute');

        $bA = new BlocksAttribute();
        $bA->setCurrentUser(0); 

        try{
            $recordset = $bA->recuperar($attribute, $field, $id_page, $id_componente, $id);
            
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockUtils - getItemAttribute() " .$e->getMessage();
        }
    }
    
   /**
     * Método para atualiza as propriedas da row do componente
     *
     * @param number
     * @param string
     * @param value
     *
    */
    public static function updateComponenteAttribute($id, $field, $value){
        
        $sql = "UPDATE paginas_rows SET $field = '$value' WHERE id = $id";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();  
            
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: BlockUtils - updateComponenteAttribute() ". $e->getMessage();
        }
    }
    
    /**
     * Método para editar um attributo adicional do componente. Utiliza a tabela
     * paginas_attributes
     *
     * @param number
     * @param string
     * @param value
     *
    */
    public static function addItemAttribute($data){
        
        $select = "id_componente, id_row, id_pagina, field1, field2, field3, field4, field5, n_index, tipo, number1, number2, number3, number4, number5";
        
        $values  = "'{$data['id_componente']}', '{$data['id_row']}', '{$data['id_pagina']}', '{$data['field1']}', '{$data['field2']}', '{$data['field3']}', '{$data['field4']}', '{$data['field5']}', '{$data['n_index']}', '{$data['tipo_item']}', ";
        $values .= "'{$data['number1']}', '{$data['number2']}', '{$data['number3']}', '{$data['number4']}', '{$data['number5']}'";
        
        $values2  = "field1 = '{$data['field1']}', field2 = '{$data['field2']}', field3 = '{$data['field3']}', field4 = '{$data['field4']}', field5 = '{$data['field5']}', n_index = '{$data['n_index']}', tipo = '{$data['tipo_item']}', ";
        $values2 .= "number1 = '{$data['number1']}', number2 = '{$data['number2']}', number3 = '{$data['number3']}', number4 = '{$data['number4']}', number5 = '{$data['number5']}'";
        
        if($data['action'] == 'novo')   $sql =  "INSERT INTO paginas_items ($select) VALUES ({$values})";
        if($data['action'] == 'editar') $sql =  "UPDATE paginas_items SET {$values2} WHERE id = {$data['id']}";
        
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            return $control;

        }catch(CDbException $e){
            echo "ERROR: BlockUtils - addItemAttribute() ". $e->getMessage();
        }
    }
}
?>