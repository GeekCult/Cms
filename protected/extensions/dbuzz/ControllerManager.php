<?php

/**
 * This Class is used to set and retrieve the controller was defined in the DataBase
 * @author Carlos Garcia
 *
 * Usage Notes
 *
 * $recordSet - array default as return
 *
 */

class ControllerManager{

    /*
     * Método para recuperar o controller e a
     * action. A action é para agilizar comandos e
     * setar as páginas que não podem ser removidas ou alteradas do
     * conteúdo páginas.
     *
     * Esta classe é similar a classe DBManager
     * Quando alterar aqui, altere também lá!
     *
    */
    public function getController($page){

        $select = "id, controller, action";
        $sql = "SELECT $select FROM paginas_data WHERE nome = '$page'" ;

        try{
            $command = Yii::app()->db->createCommand($sql);            
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage()); 
            echo "ERROR: ControllerManager - getController()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - Site ControllerManager - getController()', 'trace' => $e->getMessage()), true);
        }
    }

    /**
     * Método para recuperar o layout quando existe uma action cadastrada
     * na página, essa action utiliza um controller separado.
     * Essa action também significa que esta página não pode ser excluída,
     * somente alterada e pode ou não fazer parte do plano gold, premium e etc.
     *
     * @param string page
     *
     */
    public function getControllerByAction($action, $controller){

        $select = "id, layout, controller, nome, action";
        $sql = "SELECT $select FROM paginas_data WHERE action = '$action' AND controller = '$controller'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: ControllerManager - getControllerByAction()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - Site ControllerManager - getControllerByAction()', 'trace' => $e->getMessage()), true);
        }
    }
    
    /**
     * Método para recuperar o layout de paginas especiais
     * inicialmente foi utilizada para pegar o layout dos pedidos e
     * produtos e pode ser utilizada para pegar outros layouts.
     *
     * @param string page
     *
     */
    public function getLayoutByController($controller, $plataforma = 'desktop'){

        $select = "id, layout, nome, tipo";
        $sql = "SELECT $select FROM paginas_data WHERE controller = '$controller' AND id_user = 0 AND plataforma = '$plataforma'";

        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
            return $recordset;

        }catch(CDbException $e){
            Yii::trace("ERROR ".$e->getMessage());            
            echo "ERROR: ControllerManager - getLayoutByController()".$e->getMessage();
            MethodUtils::sendError(array('message' => 'ERROR - Site ControllerManager - getLayoutByController()', 'trace' => $e->getMessage()), true);
        }
    }
}
?>