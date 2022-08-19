<?php

/**
 * Description of StatusUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 * 
**/
class StatusUtils {
    
    /**
     * Método para retornar o tipo de ícone dependendo da string que é usada para
     * definir este estado. Tipo: Sem e-mail é um alerta. 
     * 
     * @param string
     *
    */
    public static function getTypeStringToIcon($string){ 
        
        switch($string){
            case "Sem e-mail":
            case "4":
                $string = "alerta";
                break;
            
            case "Aguardando":
            case "3":
                $string = "aguardando";
                break;
            
            case "Ativo":
            case "1":
                $string = "ativo";
                break;
            
            case "Inativo":
            case "0":
                $string = "inativo";
                break;
            
            case "Erro":
                $string = "erro";
                break;
            
            default:
                $string ="alerta";
        }        
        return $string;
    }
    
    /**
     * Método para retornar o tipo de ícone dependendo da string que é usada para
     * definir este estado. Tipo: Sem e-mail é um alerta. 
     * 
     * @param string
     *
    */
    public static function getStatusIcon($id, $tipo){ 
        
        $result = array();
        
        switch($id){
            case "Sem e-mail":
            case "4":
                $result['id'] = $id;
                $result['status'] = "alerta";
                $result['image'] = "icon_status_alerta";
                $result['classe'] = "icon_status_alerta";
                $result['message'] = Yii::t('messageStrings', 'message_status_alerta_' . $tipo);
                
                break;
            
            case "Aguardando":
            case "3":
                $result['id'] = $id;
                $result['status'] = "aguardando";
                $result['image'] = "icon_status_aguardando";
                $result['classe'] = "icon_status_aguardando";
                $result['message'] = Yii::t('messageStrings', 'message_status_aguardando_' . $tipo);
                break;
            
            case "Ativo":
            case "1":
                $result['id'] = $id;
                $result['status'] = "ativo";
                $result['image'] = "icon_status_ativo";
                $result['classe'] = "icon_status_ativo";
                $result['message'] = Yii::t('messageStrings', 'message_status_ativo_' . $tipo);
                break;
            
            case "Inativo":
            case "0":
                $result['id'] = $id;
                $result['status'] = "inativo";
                $result['image'] = "icon_status_inativo";
                $result['classe'] = "icon_status_inativo";
                $result['message'] = Yii::t('messageStrings', 'message_status_inativo_' . $tipo);
                break;
            
            case "Erro":
                $result['id'] = $id;
                $result['status'] = "error";
                $result['image'] = "icon_status_error";
                $result['classe'] = "icon_status_error";
                $result['message'] = Yii::t('messageStrings', 'message_status_error_' . $tipo);
                break;
            
            default:
                //$string ="alerta";
        }        
        return $result;
    }
    
    /**
     * Método para retornar o tipo de pagaemnto
     * 
     * @param string
     *
    */
    public static function getPaymentStatus($string){ 
        
        switch($string){
            case "0":
            case 0:
                $string = "Aberto";
                break;
            
            case "1":
            case 1:
                $string = "Pago";
                break;
            
            case "2":
            case 1:
                $string = "aguardando";
                break;
            
         
            default:
                $string ="Aberto";
        }        
        return $string;
    }

}
?>