<?php

/**
 * Description of BlocksCSSUtils
 *
 * Here are some method to make easier the class Blcoks
 *
 * @author CarlosGarcia
 * 
 */
class BlocksCSSUtils{
    
    /**
     * Método atualizar o CSS da página
     *
     * @param string
     *
    */
    public static function updateCSS($data){
        
        Yii::import('application.extensions.utils.admin.PaginasAdvancedUtils');
        

        $content = PaginasAdvancedUtils::getModule($data['id_page']);

        $dados = '';
        foreach ($content as $values){
            $dados .= BlocksCSSUtils::getCSSLayout($values['info']['cool'], $values['json']);
        }
       
        try{            
            $nome = "page_" . $data['id_page'];
            $cria = fopen("media/user/css/".$nome . ".css", "w+");

            if(!file_exists($nome . ".css")){        
               $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
            }

            fclose($cria);            
            
            return true;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockCSSUtils - updateCSS() " . $e->getMessage();
        }
    }
    
    /**
     * Método atualizar o CSS da página
     *
     * @param string
     *
    */
    public static function updateCSSTemplates($data){
        
        Yii::import('application.extensions.utils.admin.special.TemplatesUtils');
        Yii::import('application.extensions.utils.admin.special.BlocksCSSUtils');
        

        $content = TemplatesUtils::getModule($data['id_template']);

        $dados = '';
        foreach ($content as $values){
            $dados .= BlocksCSSUtils::getCSSLayout($values['info']['cool'], $values['json']);
        }
        
        try{            
            $nome = "article_" . $data['id_template'];
            $cria = fopen("media/user/css/".$nome . ".css", "w+");

            if(!file_exists($nome . ".css")){        
               $escreve = fwrite($cria, utf8_encode("$dados\r\n"));
            }

            $create = fclose($cria);            
       
            return $create;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockCSSUtils - updateCSSMaterias() " . $e->getMessage();
        }
    }
    
    /**
     * Método obter o layout
     *
     * @param string
     *
    */
    public static function getCSSLayout($modelo, $json){
        
        try{
            
            $result = '';
            $var = json_decode($json, true);

            $id = '#' . $modelo . "_" . $var['id'];
            $px = "px"; $is = '!important'; $bg = '';
            
            if($var['is_full']){$ctn = '.fullCP';}else{$ctn = ' .fullCT';}
            
            if($var['padding_top'] != '' && $var['padding_top'] != 0){$pd_top = "padding-top:" . $var['padding_top'] . $px . ";";}else{$pd_top = "";}
            if($var['padding_bottom'] != '' && $var['padding_bottom'] != 0){$pd_bot = "padding-bottom:" . $var['padding_bottom'] . $px . ";";}else{$pd_bot = "";}
            if($var['margin_top'] != '' && $var['margin_top'] != 0){$mg_top = "margin-top:" . $var['margin_top'] . $px . ";";}else{$mg_top = "";}
            if($var['margin_bottom'] != '' && $var['margin_bottom'] != 0){$mg_bot = "margin-bottom:" . $var['margin_bottom'] . $px . ";";}else{$mg_bot = "";}
            
            if(isset($var['background_type']) && ($var['background_type'] == 0 && $var['background'] != '')){$bg = "background: url(/media/user/images/original/{$var['background']});";} 
            if(isset($var['background_type']) && ($var['background_type'] == 2 && $var['background'] != '')){$bg = "background: url(/media/images/textures/efeitos/{$var['background']}); background-color: {$var['background_color']};";}
            if(isset($var['background_type']) && ($var['background_type'] == 1 && $var['background'] != '')){$bg = "background: url(/media/images/textures/site/{$var['background']});";}
            
            $result .= $id . $ctn . "{". $pd_top . $pd_bot . $mg_bot . $mg_top . $bg ."}";
            
            switch ($modelo){

                case "tarjenta_destaque":
                case "botao_download":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], '', $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.well:before', 'border-left-color', $var['cor_2'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElementTriple('.well', 'background-color', $var['cor_3'].$is, 'border-left', "4px solid {$var['cor_2']}{$is} ", 'border-color', $var['cor_3']);
                    break;
                
                case "tarjenta":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTar', $var['cor_1'], '', $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.sTar', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    break;
                
                case "cincinnati_artigo":
                case "aplicativos_los_angeles":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));
                    if(isset($var['cor_extra_1'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.hero-unit', 'background-color', $var['cor_extra_1'], true);
                    break;
                
                case "promocao_space":
                case "galeria_lasvegas":
                case "galeria_destaques":
                case "galeria_stack":
                case "tabela_seattle":
                case "texas_artigo":
                case "artigo_coral_springs":
                case "artigo_denver":
                case "registros_iwoa":
                case "registros_connecticut":
                case "busca_memphis":
                case "orcamentus_dakota":
                case "busca_siliconvalley":
                case "display_nevada":
                case "handtome_search":
                case "revista_simples":
                case "block_image_text_left":
                case "tip_artigo":
                case "block_novidades_tetriz":
                case "folha_pedidos":
                case "reserva_minnesota":
                case "times_square":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    break;
                
                case "block_novidades_zambe":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2.tZam', $var['cor_6'], ((isset($var['font_6'])) ? $var['font_6'] : ''), ((isset($var['alinhamento_6'])) ? $var['alinhamento_6'] : ''));
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.txtZam', $var['cor_7'], ((isset($var['font_7'])) ? $var['font_7'] : ''), ((isset($var['alinhamento_7'])) ? $var['alinhamento_7'] : ''));
                    $result .= $id .  BlocksCSSUtils::getCSSForBackground('.ctnZambBG', $var['image_type_1'], $var['image_1'], (isset($var['image_color_1']) ? $var['image_color_1'] : ''));
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.ctnZambBorder', 'border-color', $var['cor_5'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.baseTextZambe', 'background', $var['cor_4'], true);
                    break;
                
                case "mural_noticias":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.cTM', $var['cor_titulo_materia'], ((isset($var['font_1'])) ? $var['font_1'] : ''), '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.cDM', $var['cor_descricao_materia'], ((isset($var['font_2'])) ? $var['font_2'] : ''), '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.cIM', $var['cor_icone_materia'], ((isset($var['font_3'])) ? $var['font_3'] : ''), '');
                    break;
                
                case "newsletter_easy":
                case "newsletter_portland":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tNwl', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.stNwl', ((isset($var['cor_2'])) ? $var['cor_2'] : ''), ((isset($var['font_2'])) ? $var['font_2'] : ''), ((isset($var['alinhamento_2'])) ? $var['alinhamento_2'] : ''));
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', ((isset($var['cor_3'])) ? $var['cor_3'] : ''), ((isset($var['font_3'])) ? $var['font_3'] : ''), ((isset($var['alinhamento_3'])) ? $var['alinhamento_3'] : ''));
                    break;
                
                case "users_slider":
                case "videos_indiana":
                case "novidades_baltimore":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-indicators li', 'background-color', $var['cor_paginacao'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-indicators li.active', 'background-color', $var['cor_paginacao_ativo'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.c_tItem', 'color', $var['cor_titulo_item'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-control', 'background', $var['cor_avancar'], false);
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));            
                    break;
                    
                 case "vitrine_barcelona":
                 case "produto_alasca":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-indicators li', 'background-color', $var['cor_paginacao'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-indicators li.active', 'background-color', $var['cor_paginacao_ativo'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.c_tItem', 'color', $var['cor_titulo_item'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.carousel-control', 'background', $var['cor_avancar'], false);
                    $result .= $id .  BlocksCSSUtils::getCSSForElementTriple('.tItem', 'color', $var['cor_titulo_item'].$is, 'line-height', "25px", 'text-align', 'center');
                    $result .= $id .  BlocksCSSUtils::getCSSForElementTriple('.dItem', 'color', $var['cor_descricao_item'].$is, 'line-height', "18px", 'text-align', 'justify');
                    $result .= $id .  BlocksCSSUtils::getCSSForBackground('.thumbnail', $var['image_type_1'], $var['image_1'], (isset($var['image_color_1']) ? $var['image_color_1'] : ''));
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));            
                    break;
                
                case "massachusetts_artigo":
                case "kansas_artigo":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));
                    break;
                
                case "publicidade_online":
                case "banners_klondike":
                case "eventos_long_island":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));
                    break;
                    
                case "tenesi_artigo":
                case "artigo_chicago":
                case "arkansas_artigo":
                case "artigo_boston":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_1', ((isset($var['icone_cor_1'])) ? $var['icone_cor_1'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_1', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_1', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_1', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_2', ((isset($var['icone_cor_2'])) ? $var['icone_cor_2'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_2', $var['item2_cor_1'], ((isset($var['item2_font_1'])) ? $var['item2_font_1'] : ''), $var['item2_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_2', $var['item2_cor_2'], ((isset($var['item2_font_2'])) ? $var['item2_font_2'] : ''), $var['item2_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_2', $var['item2_cor_3'], ((isset($var['item2_font_3'])) ? $var['item2_font_3'] : ''), $var['item2_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_3', ((isset($var['icone_cor_3'])) ? $var['icone_cor_3'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_3', $var['item3_cor_1'], ((isset($var['item3_font_1'])) ? $var['item3_font_1'] : ''), $var['item3_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_3', $var['item3_cor_2'], ((isset($var['item3_font_2'])) ? $var['item3_font_2'] : ''), $var['item3_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_3', $var['item3_cor_3'], ((isset($var['item3_font_3'])) ? $var['item3_font_3'] : ''), $var['item3_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_4', ((isset($var['icone_cor_4'])) ? $var['icone_cor_4'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_4', $var['item4_cor_1'], ((isset($var['item4_font_1'])) ? $var['item4_font_1'] : ''), $var['item4_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_4', $var['item4_cor_2'], ((isset($var['item4_font_2'])) ? $var['item4_font_2'] : ''), $var['item4_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_4', $var['item4_cor_3'], ((isset($var['item4_font_3'])) ? $var['item4_font_3'] : ''), $var['item4_alinhamento_3']);
                    
                    if(isset($var['bg_bloco_1'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_1', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_1'] . ")", true);
                    if(isset($var['bg_bloco_2'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_2', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_2'] . ")", true);
                    if(isset($var['bg_bloco_3'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_3', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_3'] . ")", true);
                    if(isset($var['bg_bloco_4'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_4', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_4'] . ")", true);
                    
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));
                    break;
                    
                 case "new_orleans_artigo":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2, .spWi', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.inverted', 'background', $var['item3_cor_1'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.word_inverted', 'color', $var['item3_cor_2'], true);
                    break;
                
                case "priceboxes":
           
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.cBl1', 'background', $var['cor_block_1'], false);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.cBl2', 'background', $var['cor_block_2'], false);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.cBl3', 'background', $var['cor_block_3'], false);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.cBl4', 'background', $var['cor_block_4'], false);
                    break;
                
                case "el_paso":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    
                    if(isset($var['cor_titulo_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem', 'color', $var['cor_titulo_item'], false);
                    if(isset($var['cor_descricao_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.dItem', 'color', $var['cor_descricao_item'], true);
                    
                    
                    if(isset($var['cor_botao'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('figcaption', 'background', $var['cor_botao'], true);
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.grid figcaption a', 'background', $var['cor_botao2'], true);
                    break;
                    
                case "texas_hold":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    
                    if(isset($var['cor_titulo_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem', 'color', $var['cor_titulo_item'], false);
                    if(isset($var['cor_descricao_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.dItem', 'color', $var['cor_descricao_item'], true);
                    
                    if(isset($var['cor_botao'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('figcaption', 'background', $var['cor_botao'], true);
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.grid figcaption a', 'background', $var['cor_botao2'], true);
                    
                    if(isset($var['extra']['cor_composite_1']) && $var['extra']['cor_composite_1'] != ''){
                        $color = HelperUtils::hex2rgb($var['extra']['cor_composite_1']);                        
                        $result .= $id .  BlocksCSSUtils::getCSSForElement('.mask', 'background-color', "rgba({$color[0]}, {$color[1]},{$color[2]}, 0.7)", true);                        
                    }
                    
                    if(isset($var['extra']['cor_composite_2']) && $var['extra']['cor_composite_2'] != ''){
                        if($var['extra']['composite_layout_1'] != 'view-tenth' && $var['extra']['composite_layout_1'] != 'view-fourth') $result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem', 'background-color', $var['extra']['cor_composite_2'], true);
                        if($var['extra']['composite_layout_1'] === "view-tenth" || $var['extra']['composite_layout_1'] === "view-fourth") $result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem', 'border-bottom', "1px solid {$var['extra']['cor_composite_1']}", true);
                    }
                    if(isset($var['extra']['cor_composite_titulo_1']) && $var['extra']['cor_composite_titulo_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElementTriple('.tItem', 'color', $var['extra']['cor_composite_titulo_1'], 'text-align', 'center', 'text-align', 'center');}
                    if(isset($var['extra']['cor_composite_texto_1']) && $var['extra']['cor_composite_texto_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.dItem', 'color', $var['extra']['cor_composite_texto_1'], false);}
                    if(isset($var['extra']['cor_composite_botao_1']) && $var['extra']['cor_composite_botao_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('a', 'background-color', $var['extra']['cor_composite_botao_1'], false);}
                    
                    break;
                
                case "artigo_charlotte":
                case "artigo_laredo":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    
                    if(isset($var['cor_titulo_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem', 'color', $var['cor_titulo_item'], false);
                    if(isset($var['cor_descricao_item'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.dItem', 'color', $var['cor_descricao_item'], true);
                    
                    if(isset($var['cor_botao'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('figcaption', 'background', $var['cor_botao'], true);
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.grid figcaption a', 'background', $var['cor_botao2'], true);
                    
                    if(isset($var['extra']['cor_composite_1']) && $var['extra']['cor_composite_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.bgArtCh', 'background-color', $var['extra']['cor_composite_1'], true);}
                    if(isset($var['extra']['cor_composite_2']) && $var['extra']['cor_composite_2'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.bgArtCh2', 'background-color', $var['extra']['cor_composite_2'], true);}
                    if(isset($var['extra']['cor_composite_3']) && $var['extra']['cor_composite_3'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.bgArtCh3', 'background-color', $var['extra']['cor_composite_3'], true);}
                    
                    if(isset($var['extra']['cor_composite_texto_1']) && $var['extra']['cor_composite_texto_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem1', 'color', $var['extra']['cor_composite_texto_1'], false);}
                    if(isset($var['extra']['cor_composite_texto_2']) && $var['extra']['cor_composite_texto_2'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem2', 'color', $var['extra']['cor_composite_texto_2'], false);}
                    if(isset($var['extra']['cor_composite_texto_3']) && $var['extra']['cor_composite_texto_3'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.tItem3', 'color', $var['extra']['cor_composite_texto_3'], false);}
                    
                    break;
                
                case "artigo_brooklyn":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_1', ((isset($var['icone_cor_1'])) ? $var['icone_cor_1'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_1', $var['item1_cor_1'], ((isset($var['item1_font_1'])) ? $var['item1_font_1'] : ''), $var['item1_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_1', $var['item1_cor_2'], ((isset($var['item1_font_2'])) ? $var['item1_font_2'] : ''), $var['item1_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_1', $var['item1_cor_3'], ((isset($var['item1_font_3'])) ? $var['item1_font_3'] : ''), $var['item1_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_2', ((isset($var['icone_cor_2'])) ? $var['icone_cor_2'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_2', $var['item2_cor_1'], ((isset($var['item2_font_1'])) ? $var['item2_font_1'] : ''), $var['item2_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_2', $var['item2_cor_2'], ((isset($var['item2_font_2'])) ? $var['item2_font_2'] : ''), $var['item2_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_2', $var['item2_cor_3'], ((isset($var['item2_font_3'])) ? $var['item2_font_3'] : ''), $var['item2_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_3', ((isset($var['icone_cor_3'])) ? $var['icone_cor_3'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_3', $var['item3_cor_1'], ((isset($var['item3_font_1'])) ? $var['item3_font_1'] : ''), $var['item3_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_3', $var['item3_cor_2'], ((isset($var['item3_font_2'])) ? $var['item3_font_2'] : ''), $var['item3_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_3', $var['item3_cor_3'], ((isset($var['item3_font_3'])) ? $var['item3_font_3'] : ''), $var['item3_alinhamento_3']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'i.iC_4', ((isset($var['icone_cor_4'])) ? $var['icone_cor_4'] : ''), '', '');
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.tTen_4', $var['item4_cor_1'], ((isset($var['item4_font_1'])) ? $var['item4_font_1'] : ''), $var['item4_alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.txtTen_4', $var['item4_cor_2'], ((isset($var['item4_font_2'])) ? $var['item4_font_2'] : ''), $var['item4_alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', '.pTen_4', $var['item4_cor_3'], ((isset($var['item4_font_3'])) ? $var['item4_font_3'] : ''), $var['item4_alinhamento_3']);
                    
                    if(isset($var['bg_bloco_1'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_1', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_1'] . ")", true);
                    if(isset($var['bg_bloco_2'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_2', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_2'] . ")", true);
                    if(isset($var['bg_bloco_3'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_3', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_3'] . ")", true);
                    if(isset($var['bg_bloco_4'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.bg_bl_4', 'background-image', "url(/media/images/textures/site/" . $var['bg_bloco_4'] . ")", true);
                    
                    if(isset($var['cor_botao_label'])) $result .= $id .  BlocksCSSUtils::getCSSForButtons('.btn', $var['cor_botao_label'], $var['cor_botao'], ((isset($var['cor_botao2'])) ? $var['cor_botao2'] : ''));
                    
                    if(isset($var['extra']['cor_composite_1'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.grid figcaption', 'background', $var['extra']['cor_composite_1'], true);
                    if(isset($var['extra']['cor_composite_botao_1'])) $result .= $id .  BlocksCSSUtils::getCSSForElement('.grid figcaption a', 'background', $var['extra']['cor_composite_botao_1'], true);
                    
                    if(isset($var['extra']['cor_composite_titulo_1']) && $var['extra']['cor_composite_titulo_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElementTriple('.tItem', 'color', $var['extra']['cor_composite_titulo_1'], 'text-align', 'center', 'text-align', 'center');}
                    if(isset($var['extra']['cor_composite_texto_1']) && $var['extra']['cor_composite_texto_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('.dItem', 'color', $var['extra']['cor_composite_texto_1'], false);}
                    if(isset($var['extra']['cor_composite_botao_1']) && $var['extra']['cor_composite_botao_1'] != ''){$result .= $id .  BlocksCSSUtils::getCSSForElement('a', 'background-color', $var['extra']['cor_composite_botao_1'], false);}
                    
                    break;
                    
                case "tabela_seattle":
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h2', $var['cor_1'], ((isset($var['font_1'])) ? $var['font_1'] : ''), $var['alinhamento_1']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'h4', $var['cor_2'], ((isset($var['font_2'])) ? $var['font_2'] : ''), $var['alinhamento_2']);
                    $result .= $id .  BlocksCSSUtils::getCSSForFonts('completo', 'p.tP', $var['cor_3'], ((isset($var['font_3'])) ? $var['font_3'] : ''), $var['alinhamento_3']);
                    
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.colBs_1', 'background', $var['col_cor_1'], true);
                    $result .= $id .  BlocksCSSUtils::getCSSForElement('.colBs_1', 'color', $var['col_cor_font_1'], true);
                    break;
            }
            
            
            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockCSSUtils - getCSSLayout() " . $e->getMessage();
        }

    }
    
    /**
     * Método obter o layout elementos de textos
     *
     * @param string
     *
    */
    public static function getCSSForFonts($tipo, $elemento, $cor, $fonte, $alinhamento){
                
        ($cor != '') ? $f_c = "color: {$cor};" : $f_c = '';
        ($fonte != '') ? $f_ff = "font-family:". str_replace("+", " ", $fonte) ."; font-weight:normal;" : $f_ff = '';
        ($alinhamento != '') ? $f_al = "text-align:{$alinhamento};" : $f_al = '';
        $result = " {$elemento} {". $f_c . $f_ff . $f_al ."}";
        
        return $result;
    }
    
    /**
     * Método obter o layout de botoes
     *
     * @param string
     *
    */
    public static function getCSSForButtons($elemento, $cor_label, $cor1, $cor2){
       
        ($cor1 != '') ? $b_c = "background-image: linear-gradient({$cor1}, {$cor2}); background-color: {$cor2};" : $b_c = '';
        ($cor_label != '') ? $c_lb = "color:{$cor_label}; " : $c_lb = '';
       
        $result = " {$elemento} {". $b_c . $c_lb ."}";        
        return $result;
    }
    
    /**
     * Método obter o layout de elementos diversos
     *
     * @param string
     *
    */
    public static function getCSSForElement($elemento, $propriedade, $cor, $isImportant = false){
        
        $result = '';
        ($isImportant) ? $is = "!important" : $is = "";
        
        ($cor != '') ? $el = "$propriedade : {$cor}{$is};" : $el = '';       
        $result = " {$elemento} {". $el ."}";    
        
        return $result;
    }
    
    /**
     * Método obter o layout de elementos diversos
     *
     * @param string
     *
    */
    public static function getCSSForElementTriple($elemento, $propriedade1, $cor1, $propriedade2, $cor2, $propriedade3, $cor3){
        
        $result = '';
        
        ($cor1 != '') ? $el1 = "$propriedade1 : {$cor1};" : $el1 = ''; 
        ($cor2 != '') ? $el2 = "$propriedade2 : {$cor2};" : $el2 = '';
        ($cor3 != '') ? $el3 = "$propriedade3 : {$cor3};" : $el3 = '';
        
        $result = " {$elemento} {" .$el1 . $el2 . $el3 ."}";    
        
        return $result;
    }
    
    /**
     * Método obter o layout de elementos diversos
     *
     * @param string
     *
    */
    public static function getCSSForBackground($elemento, $image_type, $image_1, $image_color_1){
        
        $result = '';
        if($image_type == 0){$bg = "background: url(/media/user/images/original/{$image_1});";} 
        if($image_type == 2){$bg = "background: url(/media/images/textures/efeitos/{$image_1}); background-color: {$image_color_1};";}
        if($image_type == 1){$bg = "background: url(/media/images/textures/site/{$image_1});";} 
        
        $result = " {$elemento} {" .$bg ."}"; 
        
        return $result;
    }
    
    //style="<?php if($image_type_1 == 2){echo "background: url(/media/images/textures/efeitos/{$image_1}) {$image_color_1}; ";} if($image_type_1 == 1){echo "background: url(/media/images/textures/site/{$image_1}); ";} if($image_type_1 == 0){echo "background: url(/media/user/images/original/{$image_1});";}
}
?>