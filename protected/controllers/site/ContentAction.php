<?php

class ContentAction extends CAction{

    /**
     *
     * Content
     *
     * Generic Class used to redirect to the right Action.
     * It gets the action, if it's not a controller it redirect to 
     * a specific action..
     *
     */
    public function run(){

        Yii::import('application.extensions.dbuzz.ControllerManager');

        $page = Yii::app()->getRequest()->getQuery('nr');
        $sub = Yii::app()->getRequest()->getQuery('sub');
        $helper = Yii::app()->getRequest()->getQuery('action');        
        $id = Yii::app()->getRequest()->getQuery('id');
        
        $setMenuAcive = MethodUtils::setSessionData('menu_active', $page);
        
        $manager = new ControllerManager();

        if(is_numeric($page))$this->getController()->forward('/site/perfil/' . $page); 
        
        //Sub é a sub pagina, se for uma página comum não tem necessidade
        //de adiconar uma sub pagina, mais se for uma feature, pedido, conta, produtos
        //e outros que podem tem um controller individual então necessário

        if($sub == ""){
            $action = $manager->getController($page);
            $this->getController()->forward('site/' . $action['controller']);
        
        }else if($page == "empregos" || $page == "redebeneficios" || $page == "ofertas" || $page == "videos" || $page == "agenda"){            
            $this->getController()->forward("/site/". $page. "/". $sub ."/" . $helper);
        
        }else{
            if($id != ""){
                $this->getController()->forward( "/" . $page . "/". $sub . '/' . $helper . '/' . $id);
            }else{  
                $this->getController()->forward( "/" . $page . "/". $sub . '/' . $helper);
            }
        }
             
    }
}
?>