<?php

/**
 * Description of UserUpdateUtils
 * 
 * Support class to make shorter the UserUtils and UserSupportUtils
 * Here are some method to make easier the dealing with that.
 *
 * @author CarlosGarcia
 * 
 */
class UserUpdateUtils{    
    
    /**
     * Método para atualizar o status, mensagems e mais atualizações que
     * podem estar na fila de atualizações.
     *
     * @param number
     *
    */
    public static function dispatchUserUpdates($id_user){
        
        Yii::import('application.extensions.utils.users.UserUtils');        

        try{
            $userData = UserUtils::getUserFullById($id_user);
            
            if($userData['account_states_id'] == 3) UserUtils::setUserAccountState($id_user, 1);

        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo $e->getMessage();
        }
    } 
}
?>