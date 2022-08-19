<?php

/**
 * Description of BlocksUtils
 *
 * Here are some method to make easier the class Blcoks
 *
 * @author CarlosGarcia
 * 
 */
class BlocksSupportUtils{
    
    /**
     * Método para obter view do block
     *
     * @param string
     *
    */
    public static function getExtraContent($data){
        
        Yii::import('application.extensions.digitalbuzz.attributes.BlocksAttribute');

        $bA = new BlocksAttribute();
        $bA->setCurrentUser(0);
       
        try{
            $result['cor_composite_1'] = $bA->recuperar('cor_composite_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_2'] = $bA->recuperar('cor_composite_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_3'] = $bA->recuperar('cor_composite_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['cor_composite_titulo_1'] = $bA->recuperar('cor_composite_titulo_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_texto_1'] = $bA->recuperar('cor_composite_texto_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['cor_composite_titulo_2'] = $bA->recuperar('cor_composite_titulo_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_texto_2'] = $bA->recuperar('cor_composite_texto_2', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['cor_composite_titulo_3'] = $bA->recuperar('cor_composite_titulo_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_texto_3'] = $bA->recuperar('cor_composite_texto_3', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['composite_titulo_1'] = $bA->recuperar('composite_titulo_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['composite_texto_1'] = $bA->recuperar('composite_texto_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['cor_composite_botao_1'] = $bA->recuperar('cor_composite_botao_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['cor_composite_botao_label_1'] = $bA->recuperar('cor_composite_botao_label_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['composite_label_botao_1'] = $bA->recuperar('composite_label_botao_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['composite_titulo_exibe_1'] = $bA->recuperar('composite_titulo_exibe_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['composite_texto_exibe_1'] = $bA->recuperar('composite_texto_exibe_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            $result['composite_botao_exibe_1'] = $bA->recuperar('composite_botao_exibe_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            $result['composite_layout_1'] = $bA->recuperar('composite_layout_1', 'texto', $data['id_page'], $data['id_componente'], $data['id']);
            
            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockSupportUtils - getExtraContent() " . $e->getMessage();
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
    public static function saveExtraContent($params, $data){
        
        Yii::import('application.extensions.utils.special.BlocksUtils');
        
        $result = array();
        
        try{
            if(isset($params['cor_composite_1'])){ $result['cor_composite_1'] = $params['cor_composite_1']; BlocksUtils::saveItem('cor_composite_1', $params['cor_composite_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_2'])){ $result['cor_composite_2'] = $params['cor_composite_2']; BlocksUtils::saveItem('cor_composite_2', $params['cor_composite_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_3'])){ $result['cor_composite_3'] = $params['cor_composite_3']; BlocksUtils::saveItem('cor_composite_3', $params['cor_composite_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}

            if(isset($params['cor_composite_titulo_1'])){ $result['cor_composite_titulo_1'] = $params['cor_composite_titulo_1']; BlocksUtils::saveItem('cor_composite_titulo_1', $params['cor_composite_titulo_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_texto_1'])){ $result['cor_composite_texto_1'] = $params['cor_composite_texto_1']; BlocksUtils::saveItem('cor_composite_texto_1', $params['cor_composite_texto_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            if(isset($params['cor_composite_titulo_2'])){ $result['cor_composite_titulo_2'] = $params['cor_composite_titulo_2']; BlocksUtils::saveItem('cor_composite_titulo_2', $params['cor_composite_titulo_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_texto_2'])){ $result['cor_composite_texto_2'] = $params['cor_composite_texto_2']; BlocksUtils::saveItem('cor_composite_texto_2', $params['cor_composite_texto_2'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            if(isset($params['cor_composite_titulo_3'])){ $result['cor_composite_titulo_3'] = $params['cor_composite_titulo_3']; BlocksUtils::saveItem('cor_composite_titulo_3', $params['cor_composite_titulo_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_texto_3'])){ $result['cor_composite_texto_3'] = $params['cor_composite_texto_3']; BlocksUtils::saveItem('cor_composite_texto_3', $params['cor_composite_texto_3'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            
            if(isset($params['composite_titulo_1'])){ $result['composite_titulo_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_titulo_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('composite_titulo_1', trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_titulo_1'], ENT_QUOTES, 'utf-8', false))), 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['composite_texto_1'])){ $result['composite_texto_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_texto_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('composite_texto_1', trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_texto_1'], ENT_QUOTES, 'utf-8', false))), 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            if(isset($params['cor_composite_botao_1'])){ $result['cor_composite_botao_1'] = $params['cor_composite_botao_1']; BlocksUtils::saveItem('cor_composite_botao_1', $params['cor_composite_botao_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['cor_composite_botao_label_1'])){ $result['cor_composite_botao_label_1'] = $params['cor_composite_botao_label_1']; BlocksUtils::saveItem('cor_composite_botao_label_1', $params['cor_composite_botao_label_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['composite_label_botao_1'])){ $result['composite_label_botao_1'] = trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_label_botao_1'], ENT_QUOTES, 'utf-8', false))); BlocksUtils::saveItem('composite_label_botao_1', trim( preg_replace( '/(\r\n)|\n|\r/', '\\n', htmlentities( (string)$params['composite_label_botao_1'], ENT_QUOTES, 'utf-8', false))), 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            if(isset($params['composite_titulo_exibe_1'])){ $result['composite_titulo_exibe_1'] = $params['composite_titulo_exibe_1']; BlocksUtils::saveItem('composite_titulo_exibe_1', $params['composite_titulo_exibe_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['composite_texto_exibe_1'])){ $result['composite_texto_exibe_1'] = $params['composite_texto_exibe_1']; BlocksUtils::saveItem('composite_texto_exibe_1', $params['composite_texto_exibe_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            if(isset($params['composite_botao_exibe_1'])){ $result['composite_botao_exibe_1'] = $params['composite_botao_exibe_1']; BlocksUtils::saveItem('composite_botao_exibe_1', $params['composite_botao_exibe_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            if(isset($params['composite_layout_1'])){ $result['composite_layout_1'] = $params['composite_layout_1']; BlocksUtils::saveItem('composite_layout_1', $params['composite_layout_1'], 'texto', $data['id_page'], $data['id_componente'], $data['id_row'], 'texto');}
            
            
            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: BlockSupportUtils - saveExtraContent() " . $e->getMessage();
        }
    }
    
}
?>