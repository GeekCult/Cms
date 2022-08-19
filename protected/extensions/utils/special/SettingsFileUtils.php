<?php

/**
 * Description of SettingsFileUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class SettingsFileUtils {


    /**
     * Método para pegar as propriedades e definir em um arquivo PHP separado
     *
     * @param string
     *
    */
    public static function updateSettingsFile(){
        
       Yii::import('application.extensions.utils.admin.PaginasUtils'); 
       Yii::import('application.extensions.utils.admin.PreferencesUtils'); 
       Yii::import('application.extensions.utils.admin.SettingsAplicativosUtils'); 
       
       $session = MethodUtils::getSessionData();
      
            
       try{
            $nome = "Settings";
            $cria = fopen("media/user/files/".$nome . ".php", "w+");

            $dados  = "";
            $dados .= "<?php ";
            $dados .= "class Settings {";
            
            if(Yii::app()->params['tecnologia'] == 1) $dados .= "const CSS = " . '"' . "<link href='/css/lib/bootstrap.css' rel='stylesheet'>" . '"' . ";";
            if(Yii::app()->params['tecnologia'] == 0) $dados .= "const CSS = " . '"' . "<link rel='stylesheet' type='text/css' href='/css/lib/reset.css'/><link rel='stylesheet' type='text/css' href='/css/lib/form.css'/><link rel='stylesheet' type='text/css' href='/css/lib/buttons.css'/><link rel='stylesheet' type='text/css' href='/css/lib/cool/colors.css'/><link rel='stylesheet' type='text/css' href='/js/lib/upload/fileuploader.css'/><link rel='stylesheet' type='text/css' href='/css/site/components/special/button_colorful.css'/><link rel='stylesheet' type='text/css' href='/css/site/main/main.css' />" . '"' . ";";
            
            if(Yii::app()->params['tecnologia'] == 1) $dados .= "const CSS_U = " . '"' . "/css/lib/bootstrap.css" . '"' . ";";
            
            //USado em Hotsites
            $dados .= "const CSS_HTML5 = " . '"' . "<link href='/css/lib/bootstrap.css' rel='stylesheet'>" . '"' . ";";
            
            $dados .= "const CTT_COMPANY_NAME = " . '"' . PaginasUtils::getAttributesByUser('ctt_company_name', 'texto')  . '"' . ";";
            $dados .= "const CTT_ENDERECO = " . '"' . PaginasUtils::getAttributesByUser('ctt_address', 'descricao')  . '"' . ";";
            $dados .= "const CTT_CIDADE = " . '"' . PaginasUtils::getAttributesByUser('ctt_cidade', 'texto')  . '"' . ";";
            $dados .= "const CTT_ESTADO = " . '"' . PaginasUtils::getAttributesByUser('ctt_estado', 'texto')  . '"' . ";";
            $dados .= "const CTT_TEL_1 = " . '"' . PaginasUtils::getAttributesByUser('ctt_tel_1', 'texto')  . '"' . ";";
            $dados .= "const CTT_TEL_2 = " . '"' . PaginasUtils::getAttributesByUser('ctt_tel_2', 'texto')  . '"' . ";";
            $dados .= "const CTT_EMAIL = " . '"' . PaginasUtils::getAttributesByUser('ctt_email', 'texto')  . '"' . ";";
            $dados .= "const CTT_SITE = " . '"' . PaginasUtils::getAttributesByUser('ctt_site', 'texto')  . '"' . ";";
            $dados .= "const SITE_DESCRIPTION = " . '"' . PreferencesUtils::getPreferedItem('metatags')  . '"' . ";";
            
            $dados .=  SettingsAplicativosUtils::updatePurpleStoreAplicativos();          
            
            $dados .= "}";
            $dados .= "?>";


            if(!file_exists($nome . ".php")){        
               $escreve = fwrite($cria, $dados);
            }

            fclose($cria);
        
        } catch(CDbException $e) {
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR: SettingsUtils - updateSettingsFile() ' . $e->getMessage();
        }
    }

}
?>
