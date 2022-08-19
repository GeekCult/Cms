<?php

/**
 * Description of MAteriasUtils
 *
 * Here are some method to make easier the dealing to all kind of subject
 * since it is about PurplePier
 *
 * @author CarlosGarcia
 */
class MateriasUtils {


    /**
     * Método para pegar as propriedades do tipo de matéria
     *
     * @param string
     *
    */
    public static function getAttributes($type) {
            
       $result['controller'] = $type;    
            
       switch($type){
           
           case "colunas":               
               $result['title'] = "Lista de colunas";               
               break;
           case "noticias":               
               $result['title'] = "Lista de notícias";               
               break;
           case "dicas":               
               $result['title'] = "Lista de dicas";               
               break;
           case "novidades":               
               $result['title'] = "Lista de novidades";               
               break;
           case "blog":               
               $result['title'] = "Lista de notícias do blog";               
               break;
           default:               
               $result['title'] = "Lista de notícias";               
               break;
       }         
       return $result;
    }
    
    /**
     * Método para pegar as propriedades do tipo de matéria, usado en Novo e editar
     * Este métod agrupa as propriedades do objeto em um arrya para facilitar o uso deste
     * na view.
     * 
     * @type
     * @action
     * @id_controller
     * @id_page
     *
     * @param string 
     * @param string
     *
    */
    public static function getProperties($type, $action, $id_controller, $id_page) {
            
        $result['controller'] = $type; 
        $result['action'] = $action;
        $result['id_controller'] = $id_controller;
        $result['id_page'] = $id_page;
            
       switch($type){
           
           case "colunas":               
               $result['title'] = "Cadastrar colunas";               
               break;
           case "noticias":               
               $result['title'] = "Cadastrar notícias";               
               break;
           case "dicas":               
               $result['title'] = "Cadastrar dicas";               
               break;
           case "novidades":               
               $result['title'] = "Cadastrar novidades";               
               break;
           case "blog":               
               $result['title'] = "Cadastrar notícias do blog";               
               break;
           case "wiki":               
               $result['title'] = "Cadastrar dicas do Wiki";               
               break;
           default:               
               $result['title'] = "Cadastrar notícias";               
               break;
       }        
       return $result;
    }
    
    /**
     * Método para recuperar o nome do colunista da coluna em 
     * pauta
     *
     * @param number
     *
    */
    public static function getColunaName($id_coluna){    
            
       $select = "id, nome";
       $sql = "SELECT ".$select." FROM conteudo_categorias WHERE id = $id_coluna ";

       $command = Yii::app()->db->createCommand($sql);
       $recordset = $command->queryRow();
       
       return $recordset['nome'];
    }
    
    /**
     * Método para recuperar os valores vazios para criar uma nova materia
     * Esse é um bom padrão para utilizar.
     *
     *
    */
    public static function getDataClearArticle(){    
            
       $result['id'] = "";
       $result['tipo'] = "";
       $result['materia'] = "";
       $result['id_categoria'] = "";
       $result['titulo'] = "";
       $result['subtitulo'] = "";
       $result['keywords'] = "";
       $result['id_colunista'] = "";
       
       return $result;
    }

}
?>
