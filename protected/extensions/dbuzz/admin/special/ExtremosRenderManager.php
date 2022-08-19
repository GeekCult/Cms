<?php
/*
 * This Class is used to controll all functions related the feature details
 * such as: Banners
 *
 * @author CarlosGarcia
 *
 * Date: 16/12/2014
 *
 */

class ExtremosRenderManager{
    
    /**
     * Método para recuperar as rpeferencisa de extremos
     *
     * @param 
     *
    */
    public function getContentExtremos($type){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');

        try{
            if($type == 'topo'){
                $recordset['topo_altura'] = PreferencesUtils::getAttributes('topo_altura', 'inteiro');
                $recordset['logo_altura'] = PreferencesUtils::getAttributes('logo_largura', 'inteiro');
                $recordset['logo_largura'] = PreferencesUtils::getAttributes('logo_altura', 'inteiro');
                $recordset['logo_pos_x'] = PreferencesUtils::getAttributes('logo_pos_x', 'inteiro');
                $recordset['logo_pos_y'] = PreferencesUtils::getAttributes('logo_pos_y', 'inteiro');
            }
            
            if($type == 'rodape'){
                $recordset['rodape_copyright'] = PreferencesUtils::getAttributes('rodape_copyright', 'descricao');
                $recordset['ft_menu'] = PreferencesUtils::getAttributes('ft_menu', 'texto');
                $recordset['ft_line2'] = PreferencesUtils::getAttributes('ft_line2', 'texto');
                $recordset['ft_txt_line2'] = PreferencesUtils::getAttributes('ft_txt_line2', 'texto');
                $recordset['ft_txt_menu'] = PreferencesUtils::getAttributes('ft_txt_menu', 'texto');
                $recordset['ft_txt_menu1'] = PreferencesUtils::getAttributes('ft_txt_menu1', 'texto');
                $recordset['ft_txt_menu2'] = PreferencesUtils::getAttributes('ft_txt_menu2', 'texto');
                $recordset['ft_menu2_espacamento'] = PreferencesUtils::getAttributes('ft_menu2_espacamento', 'inteiro');
                $recordset['ft_fb_bg'] = PreferencesUtils::getAttributes('ft_fb_bg', 'texto');
                $recordset['ft_ln_company_bg'] = PreferencesUtils::getAttributes('ft_ln_company_bg', 'texto');
                $recordset['ft_txt_line_company'] = PreferencesUtils::getAttributes('ft_txt_line_company', 'texto');   
                $recordset['ft_image_1'] = PreferencesUtils::getAttributes('ft_image_1', 'texto');
            }

            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());
            return false;
        }
    }
    
    /**
     * Metodo para atualizar um registro existente
     *
     * It sets the a new texture into preferences table
     * The get_post variable is a POST content from jQuery
     *
     * @param array
     *
    */
    public function updateBannerRender($data){
        
        Yii::import('application.extensions.utils.admin.PreferencesUtils');
        Yii::import('application.extensions.utils.banners.html_mainbanners.lampejo');
     
        try{             
            if($data['tipo'] != 'topos' && $data['tipo'] != 'rodapes') $result['update'] = lampejo::updateBanner($data); 
            if($data['tipo'] == 'topos') $result['update'] = lampejo::updateTopo($data); 
            if($data['tipo'] == 'rodapes') $result['update'] = lampejo::updateRodape($data); 
           
            $result['message'] = Yii::t('messageStrings', 'message_result_banner_updated');
            
            return $result;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }
    }
}

?>