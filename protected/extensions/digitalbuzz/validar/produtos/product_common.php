<?php
    $error = array();
    
    if ($_POST['nome'] == "" ){
        $error[] = "É necessário preencher o campo nome produto";
    }
    
    if ($_POST['palavra_chave'] == "" ){
        $error[] = "É necessário preencher o campo palavras-chave";
    }
    
    //Marca não é importante para a maioria dos produtos
    if ($_POST['marca'] == "" ){
        //$error[] = "É necessário preencher o campo marca";
    }
    
    
    if ($_POST['descricao'] == "" ){
        $error[] = "É necessário preencher o campo descrição";        
    }

?>
