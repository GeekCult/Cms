<?php

/**
 * Description of Banner utils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * related mathematic
 *
 * @author CarlosGarcia
 * 
**/
class lampejo {
    
    /**
     * Método retornar a progress bar de acordo com a porcentagem dos valores
     * passados
     *
     * @param number
     * 
     * /$result['t'][$i] =  $bIt->adicionar($data['tipo'], $data['src'], $data['p_x'], $data['p_y'], $data['width'], $data['height'], $data['color'], $data['f_type'], $data['s_text'], $data['s_thumb'], $data['link'], $data['variante'], $params['texto1'], $data['z_index']);
     * / adicionar -> $type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $z_index, $label = "", $name = '', $descricao = ''
    */
    public static function updateBanner($data){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BannersItems');
        Yii::import('application.extensions.utils.special.BannerElementsUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        Yii::import('application.extensions.utils.StringUtils');
        $bIt = new BannersItems();
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        $bIt->setCurrentBanner($data['id']);
        
        try{
            if(isset($params['nome_banner'])) BannersUtils::updateBannerAttribute($data['id'], 'nome', $params['nome_banner']);
            if(isset($params['titulo_banner'])) BannersUtils::updateBannerAttribute($data['id'], 'titulo', $params['titulo_banner']);
            if(isset($params['descricao_banner'])) BannersUtils::updateBannerAttribute($data['id'], 'descricao', $params['descricao_banner']);
            if(isset($params['link1'])) BannersUtils::updateBannerAttribute($data['id'], 'link', $params['link1']);
            if(isset($params['link1_modo'])) BannersUtils::updateBannerAttribute($data['id'], 'link_modo', $params['link1_modo']);
            
            (isset($params['link1_modo'])) ? $link1_modo = $params['link1_modo'] : $link1_modo = 1;
            
            ///Salva os items do modelo
            //$type, $src, $left, $top, $width, $height, $color, $f_type, $s_text, $s_thumb, $link, $variante, $texto, $z_index, $label = ""
            $isTituloExist = $bIt->checkItemByName($data['id'], 'titulo1');            
            if( $isTituloExist) if(isset($params['titulo1'])) $result['titulo1'] = $bIt->atualizarByName('titulo1', 't', '', '', '', '', '', "#".$params['cor_titulo1'], $params['font_titulo1'], $params['tamanho_titulo1'], '', '', '', '', $params['titulo1'], 1);      
            if(!$isTituloExist) if(isset($params['titulo1'])) $result['titulo1'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_titulo1'], $params['font_titulo1'], '1', '', '', '', $params['titulo1'], 1, $params['titulo1'], 'titulo1', $params['titulo1']);
          
            $isTextoExist = $bIt->checkItemByName($data['id'], 'texto1');
            if( $isTextoExist) if(isset($params['texto1'])) $result['texto1'] = $bIt->atualizarByName('texto1', 't', '', '', '', '', '', "#".$params['cor_texto1'], $params['font_texto1'], $params['tamanho_texto1'], '', '', '', '', StringUtils::breakline(addslashes($params['texto1'])), 1);
            if(!$isTextoExist) if(isset($params['texto1'])) $result['texto1'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_texto1'], $params['font_texto1'], '1', '', '', '', $params['texto1'], 1, $params['texto1'], 'texto1', StringUtils::breakline($params['texto1']));
            
            $isTitulo2Exist = $bIt->checkItemByName($data['id'], 'titulo2');            
            if( $isTitulo2Exist) if(isset($params['titulo2'])) $result['titulo2'] = $bIt->atualizarByName('titulo2', 't', '', '', '', '', '', "#".$params['cor_titulo2'], $params['font_titulo2'], $params['tamanho_titulo2'], '', '', '', '', $params['titulo2'], 1);      
            if(!$isTitulo2Exist) if(isset($params['titulo2'])) $result['titulo2'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_titulo2'], $params['font_titulo2'], '1', '', '', '', $params['titulo2'], 1, $params['titulo2'], 'titulo2', $params['titulo2']);
            
            $isTexto2Exist = $bIt->checkItemByName($data['id'], 'texto2');
            if( $isTexto2Exist) if(isset($params['texto2'])) $result['texto2'] = $bIt->atualizarByName('texto2', 't', '', '', '', '', '', "#".$params['cor_texto2'], $params['font_texto2'], $params['tamanho_texto2'], '', '', '', '', StringUtils::breakline($params['texto2']), 1);
            if(!$isTexto2Exist) if(isset($params['texto2'])) $result['texto2'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_texto2'], $params['font_texto2'], '1', '', '', '', $params['texto2'], 1, $params['texto2'], 'texto2', StringUtils::breakline($params['texto2']));
            
            $isTitulo3Exist = $bIt->checkItemByName($data['id'], 'titulo3');            
            if( $isTitulo3Exist) if(isset($params['titulo3'])) $result['titulo3'] = $bIt->atualizarByName('titulo3', 't', '', '', '', '', '', "#".$params['cor_titulo3'], $params['font_titulo3'], $params['tamanho_titulo3'], '', '', '', '', $params['titulo3'], 1);      
            if(!$isTitulo3Exist) if(isset($params['titulo3'])) $result['titulo3'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_titulo3'], $params['font_titulo3'], '1', '', '', '', $params['titulo3'], 1, $params['titulo3'], 'titulo3', $params['titulo3']);
            
            $isTexto3Exist = $bIt->checkItemByName($data['id'], 'texto3');
            if( $isTexto3Exist) if(isset($params['texto3'])) $result['texto3'] = $bIt->atualizarByName('texto3', 't', '', '', '', '', '', "#".$params['cor_texto3'], $params['font_texto3'], $params['tamanho_texto3'], '', '', '', '', StringUtils::breakline($params['texto3']), 1);
            if(!$isTexto3Exist) if(isset($params['texto3'])) $result['texto3'] =  $bIt->adicionar('t', '', 0, 0, 0, 0, "#".$params['cor_texto3'], $params['font_texto3'], '1', '', '', '', $params['texto3'], 1, $params['texto3'], 'texto3', StringUtils::breakline($params['texto3']));
            
            $isImageExist = $bIt->checkItemByName($data['id'], 'image1');
            if( $isImageExist) if(isset($params['image1'])) $result['image1'] = $bIt->atualizarByName('image1', 'i', $params['image1'], '', '', '', '', '', '', '', '', $params['link1'], $link1_modo, '', '', 1);
            if(!$isImageExist) if(isset($params['image1'])) {$result['image1'] =  $bIt->adicionar('i', $params['image1'], 0, 0, 0, 0, '', '', '', '', '', '', $params['link1'], $link1_modo, 'Imagem - 1', 'image1', 'texto');}
            
            $isImageExist2 = $bIt->checkItemByName($data['id'], 'image2');
            if( $isImageExist2) if(isset($params['image2'])) $result['image2'] = $bIt->atualizarByName('image2', 'i', $params['image2'], '', '', '', '', '', '', '', '', $params['link1'], '', '', '', 1);
            if(!$isImageExist2) if(isset($params['image2'])) $result['image2'] =  $bIt->adicionar('i', $params['image2'], 0, 0, 0, 0, '', '', '', '', '', '', $params['link1'], 1, 'Imagem - 2', 'image2', 'texto');
            
            $isImageExist3 = $bIt->checkItemByName($data['id'], 'image3');
            if( $isImageExist3) if(isset($params['image3'])) $result['image3'] = $bIt->atualizarByName('image3', 'i', $params['image3'], '', '', '', '', '', '', '', '', $params['link2'], '', '', '', 1);
            if(!$isImageExist3) if(isset($params['image3'])) $result['image3'] =  $bIt->adicionar('i', $params['image3'], 0, 0, 0, 0, '', '', '', '', '', '', $params['link2'], 1, 'Imagem - 3', 'image3', 'texto');
            
            $isImageExist4 = $bIt->checkItemByName($data['id'], 'image4');
            if( $isImageExist4) if(isset($params['image4'])) $result['image4'] = $bIt->atualizarByName('image4', 'i', $params['image4'], '', '', '', '', '', '', '', '', $params['link3'], '', '', '', 1);
            if(!$isImageExist4) if(isset($params['image4'])) $result['image4'] =  $bIt->adicionar('i', $params['image4'], 0, 0, 0, 0, '', '', '', '', '', '', $params['link3'], 1, 'Imagem - 4', 'image4', 'texto');
            
            //Link
            $isLinkExist1 = $bIt->checkItemByName($data['id'], 'link1');
            if( $isLinkExist1) if(isset($params['link1'])) $result['link1'] = $bIt->atualizarByName('link1', 'lnk', $params['link1'], '', '', '', '', '', '', "", "{$params['link1_modo']}", $params['link1'], "", '', '', 1);
            if(!$isLinkExist1) if(isset($params['link1'])) $result['link1'] =  $bIt->adicionar('lnk', $params['link1'], 0, 0, 0, 0, '', '', '', '', '',"{$params['link1_modo']}", $params['link1'], "", 'Link - 1', 'link1', 'Saiba Mais');
            
            $isLinkExist2 = $bIt->checkItemByName($data['id'], 'link2');
            if( $isLinkExist2) if(isset($params['link2'])) $result['link2'] = $bIt->atualizarByName('link2', 'lnk', $params['link2'], '', '', '', '', '', '', "", "{$params['link2_modo']}", $params['link2'], "", '', '', 1);
            if(!$isLinkExist2) if(isset($params['link2'])) $result['link2'] =  $bIt->adicionar('lnk', $params['link2'], 0, 0, 0, 0, '', '', '', '', '',"{$params['link2_modo']}", $params['link2'], "", 'Link - 2', 'link2', 'Saiba Mais');
            
            
            //Botoes
            $isBotaoExist1 = $bIt->checkItemByName($data['id'], 'botao1');
            if( $isBotaoExist1) if(isset($params['botao1'])) $result['botao1'] = $bIt->atualizarByName('botao1', 'bt', $params['botao1'], '', '', '', '', '', '', "", "{$params['modo1']}", $params['link1'], "{$params['botao1']}", '', $params['botao1_label'], 1);
            if(!$isBotaoExist1) if(isset($params['botao1'])) $result['botao1'] =  $bIt->adicionar('bt', $params['botao1'], 0, 0, 0, 0, '', '', '', '', '',"{$params['modo1']}", $params['link1'], "{$params['botao1']}", 'Botao - 1', 'botao1', $params['botao1_label']);
            
            $isBotaoExist2 = $bIt->checkItemByName($data['id'], 'botao2');
            if( $isBotaoExist2) if(isset($params['botao2'])) $result['botao2'] = $bIt->atualizarByName('botao2', 'bt', $params['botao2'], '', '', '', '', '', '', "", "{$params['modo2']}", $params['link2'], "{$params['botao2']}", '', $params['botao2_label'], 1);
            if(!$isBotaoExist2) if(isset($params['botao2'])) $result['botao2'] =  $bIt->adicionar('bt', $params['botao2'], 0, 0, 0, 0, '', '', '', '', '',"{$params['modo2']}", $params['link2'], "{$params['botao2']}", 'Botao - 2', 'botao2', $params['botao2_label']);
            
            $isBotaoExist3 = $bIt->checkItemByName($data['id'], 'botao3');
            if( $isBotaoExist3) if(isset($params['botao3'])) $result['botao3'] = $bIt->atualizarByName('botao3', 'bt', $params['botao3'], '', '', '', '', '', '', "", "{$params['modo3']}", $params['link3'], "{$params['botao3']}", '', $params['botao3_label'], 1);
            if(!$isBotaoExist3) if(isset($params['botao3'])) $result['botao3'] =  $bIt->adicionar('bt', $params['botao3'], 0, 0, 0, 0, '', '', '', '', '',"{$params['modo3']}", $params['link3'], "{$params['botao3']}", 'Botao - 3', 'botao3', $params['botao3_label']);
            
            
            //Texturas
            $isTexture1Exist = $bIt->checkItemByName($data['id'], 'textura1');
            if(isset($params['opacidade_textura1'])){$opacidade1 = 1;}else{$opacidade1 = 0;}
            if( $isTexture1Exist) if(isset($params['textura1'])) $result['textura1'] = $bIt->atualizarByName('textura1', 'ttr', $params['textura1'], '', '', '', '', '', '', '', '', '', "{$opacidade1}", '', '', 1);
            if(!$isTexture1Exist) if(isset($params['textura1'])) $result['textura1'] =  $bIt->adicionar('ttr', $params['textura1'], 0, 0, 0, 0, '', '', '', '', '', "{$opacidade1}", '', 0, 'Textura - 1', 'textura1', '');
            
            $isTexture2Exist = $bIt->checkItemByName($data['id'], 'textura2');
            if(isset($params['opacidade_textura2'])){$opacidade2 = 1;}else{$opacidade2 = 0;}
            if( $isTexture2Exist) if(isset($params['textura2'])) $result['textura2'] = $bIt->atualizarByName('textura2', 'ttr', $params['textura2'], '', '', '', '', '', '', '', '', '', "{$opacidade2}", '', '', 1);
            if(!$isTexture2Exist) if(isset($params['textura2'])) $result['textura2'] =  $bIt->adicionar('ttr', $params['textura2'], 0, 0, 0, 0, '', '', '', '', '', "{$opacidade2}", '', 0, 'Textura - 2', 'textura2', '');
            
            $isTexture3Exist = $bIt->checkItemByName($data['id'], 'textura3');
            if(isset($params['opacidade_textura3'])){$opacidade3 = 1;}else{$opacidade3 = 0;}
            if( $isTexture3Exist) if(isset($params['textura3'])) $result['textura3'] = $bIt->atualizarByName('textura3', 'ttr', $params['textura3'], '', '', '', '', '', '', '', '', '', "{$opacidade3}", '', '', 1);
            if(!$isTexture3Exist) if(isset($params['textura3'])) $result['textura3'] =  $bIt->adicionar('ttr', $params['textura3'], 0, 0, 0, 0, '', '', '', '', '', "{$opacidade3}", '', 0, 'Textura - 3', 'textura3', '');
            
            if(isset($params['type_background']) && $params['type_background'] == 0){
                if(isset($params['image_background']))$result['setImage'] = BannersUtils::saveImageBackground($data['id'], $params['image_background'], $params['type_background']);
            }else{
                if(isset($params['texture_background']))$result['setImage'] = BannersUtils::saveImageBackground($data['id'], $params['texture_background'], $params['type_background']);
            }
            
            if(isset($params['font_titulo1'])) MethodUtils::setActivityServer('fonte', $data['id'], 'font_titulo1', $params['font_titulo1']);
            if(isset($params['font_texto1'])) MethodUtils::setActivityServer('fonte', $data['id'], 'font_texto1', $params['font_texto1']);
          
            $setAttributes = BannerElementsUtils::updateBannerAttributes($data, $params);
            
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: LampejoUtils - updateBanner() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar um rodape
     *
     * @param number
     * 
    */
    public static function updateRodape($data){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BannersItems');
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        $bIt = new BannersItems();
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        $bIt->setCurrentBanner($data['id']);
        
        try{
            
            if(isset($params['titulo_banner'])) $result['titulo'] = BannersUtils::updateBannerAttribute($data['id'], 'titulo', $params['titulo_banner']);
            if(isset($params['descricao_banner'])) $result['titulo'] = BannersUtils::updateBannerAttribute($data['id'], 'descricao', $params['descricao_banner']);
            
            if(isset($params['chamada_titulo'])) $result['chamada_titulo'] = PreferencesUtils::setAttributes('chamada_titulo',  $params['chamada_titulo'],'texto');
            if(isset($params['chamada_texto'])) $result['chamada_texto'] = PreferencesUtils::setAttributes('chamada_texto',  $params['chamada_texto'],'texto');
            
            if(isset($params['titulo1'])) $result['titulo1'] = PreferencesUtils::setAttributes('titulo_column_1',  $params['titulo1'],'texto');
            if(isset($params['texto1'])) $result['texto1'] = PreferencesUtils::setAttributes('texto_column_1',  $params['texto1'],'texto');
            if(isset($params['link1'])) $result['link1'] = PreferencesUtils::setAttributes('link_column_1',  $params['link1'],'texto');
            if(isset($params['image_1'])) $result['image_1'] = PreferencesUtils::setAttributes('ft_image_1',  $params['image_1'],'texto');
            
            //Facebook
            if(isset($params['facebook_2'])) $result['facebook_2'] = PreferencesUtils::setAttributes('facebook_2',  $params['facebook_2'],'texto');
            if(isset($params['facebook_3'])) $result['facebook_3'] = PreferencesUtils::setAttributes('facebook_3',  $params['facebook_3'],'texto'); 
            
            //Layout
            if(isset($params['container_layout_1'])){$result['container_layout_1'] = PreferencesUtils::setAttributes('container_layout_1',  1,'inteiro');}else{$result['container_layout_1'] = PreferencesUtils::setAttributes('container_layout_1',  0,'inteiro');}
            if(isset($params['container_layout_2'])){$result['container_layout_2'] = PreferencesUtils::setAttributes('container_layout_2',  1,'inteiro');}else{$result['container_layout_2'] = PreferencesUtils::setAttributes('container_layout_2',  0,'inteiro');} 
            if(isset($params['rodape_layout_pos'])){$result['rodape_layout_pos'] = PreferencesUtils::setAttributes('rodape_layout_pos',  $params['rodape_layout_pos'],'texto');}else{$result['rodape_layout_pos'] = PreferencesUtils::setAttributes('rodape_layout_pos',  '','texto');} 
            
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: LampejoUtils - updateRodape() ". $e->getMessage();
        }
    }
    
    /**
     * Método para atualizar topo
     * 
     * @param array
     * 
     *
    */
    public static function updateTopo($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.BannersUtils');
        
        $params = array();
        parse_str($_POST['data'], $params);
        
        try{
            
            if(isset($params['titulo_banner'])) $result['titulo'] = BannersUtils::updateBannerAttribute($data['id'], 'titulo', $params['titulo_banner']);
            if(isset($params['descricao_banner'])) $result['titulo'] = BannersUtils::updateBannerAttribute($data['id'], 'descricao', $params['descricao_banner']);
            
            if(isset($params['topo_titulo_1'])) $result['topo_titulo_1'] = PreferencesUtils::setAttributes('topo_titulo_1',  $params['topo_titulo_1'],'texto');
            if(isset($params['topo_titulo_2'])) $result['topo_titulo_2'] = PreferencesUtils::setAttributes('topo_titulo_2',  $params['topo_titulo_2'],'texto');
            
            if(isset($params['topo_link_1'])) $result['topo_link_1'] = PreferencesUtils::setAttributes('topo_link_1',  $params['topo_link_1'],'texto');
            if(isset($params['topo_link_2'])) $result['topo_link_2'] = PreferencesUtils::setAttributes('topo_link_2',  $params['topo_link_2'],'texto');
            
            if(isset($params['topo_cor_1'])) $result['topo_cor_1'] = PreferencesUtils::setAttributes('topo_cor_1',  $params['topo_cor_1'],'texto');
            if(isset($params['topo_cor_2'])) $result['topo_cor_2'] = PreferencesUtils::setAttributes('topo_cor_2',  $params['topo_cor_2'],'texto');
            if(isset($params['topo_cor_3'])) $result['topo_cor_3'] = PreferencesUtils::setAttributes('topo_cor_3',  $params['topo_cor_3'],'texto');
            
            if(isset($params['topo_cor_4'])) $result['topo_cor_4'] = PreferencesUtils::setAttributes('topo_cor_4',  $params['topo_cor_4'],'texto');
            if(isset($params['topo_cor_5'])) $result['topo_cor_5'] = PreferencesUtils::setAttributes('topo_cor_5',  $params['topo_cor_5'],'texto');
            if(isset($params['topo_cor_6'])) $result['topo_cor_6'] = PreferencesUtils::setAttributes('topo_cor_6',  $params['topo_cor_6'],'texto');
            
            if(isset($params['topo_layout'])) $result['topo_layout'] = PreferencesUtils::setAttributes('topo_layout',  $params['topo_layout'],'texto');
            
            
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR: LampejoUtils - updateRodape() ". $e->getMessage();
        }
    }
    
    
    
}
?>
