<?php

/**
 * Description of CommentsUtils
 *
 * Here are some method to make easier the dealing to that.
 *
 * @author CarlosGarcia
 */
class CommentsUtils{
    
    /**
     * Método para retornar a frase completa para a quantidade
     * de pessoas que cliclaram, singular e plural
     * 
     * @param number
     * @param string
     *
    */
    public static function getPhrase($num, $type){
        
        $result = "";
        
        if($num == 1){            
            if($type == "like"){
                $result = $num . " pessoa gostou";
            }else{
                $result = $num . " pessoa não gostou";
            }
            
        }else if($num == 0){
            $result = "";            
            
        }else{            
            if($type == "like"){
                $result = $num . " pessoas gostaram";
            }else{
                $result = $num . " pessoas não gostaram";
            }
        }
  
        return $result;
    }
    
    /**
     * Método para retornar o status aprovado, aberto
     * reprovado
     * 
     * @param string
     *
    */
    public static function getStatus($type){
        
        $result = 0;
        
        if($type == "aprovados"){            
            $result = 1;            
        }
        
        if($type == "abertos"){            
            $result = 0;            
        }
        
        return $result;
    }
    
    /**
     * Método para retornar o tipo do voto que esta sendo 
     * usado no momento, materia, produto, usuario.
     * 
     * @param string
     *
    */
    public static function getTypeVote($type){       
        
        switch($type){
        
            case"user_pj":
            case"user_pf":            
                $result = "user_vote";            
                break;
        
            case "produtos":            
                $result = "produto_vote"; 
                break;
            
            case "materias":            
                $result = "materias_vote"; 
                break;
            
            default:
                $result = ""; 
                break;
        }
        return $result;
    }
}
?>