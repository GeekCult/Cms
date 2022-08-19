<?php

/**
 * Description of DataUtils
 *
 * Here are some method to make easier the class launcher
 *
 * @author CarlosGarcia
 */
class DataUtils{
    
    /**
     * Método retornar o valor necessário
     *
     * @param string
     *
    */
    public static function getValue($string){
        
        $result = "";
        
        switch($string){
            case "CNPJ ":
                $result = 1;
                break;
            case "CPF  ":
                $result = 0;
                break;
        }        
        return $result;
    }
    
    /**
     * Método retornar o valor necessário do ramo de atuacao
     *
     * @param string
     *
    */
    public static function getRamoAtuacaoValue($id, $isString = true, $field = false){
        
        try {
            
            if($id == '' || !is_numeric($id)) $id = 0;
            
            if($isString){
                $ramo_atuacao = explode(" - ", $id);
                $result = $ramo_atuacao[0];
                
            }else{

                $select = "id, label, url";
                $sql = "SELECT ".$select." FROM general_ramo_atuacao WHERE id = $id";

                $command = Yii::app()->db2->createCommand($sql);
                $result = $command->queryRow();
            }

            if($field && $result) return $result[$field];
            
            return $result;
        
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo 'ERROR - DataUtils - getRamoAtuacaoValue: ' . $e->getMessage();
        }
    }
    
    /**
     * Método retornar as keywords de acordo com os ramos de atuação
     *
     * @param number
     *
    */
    public static function getKeyWords($id, $callback = 'keywords'){
      
        $select = "id, label, url, keywords";
        $sql = "SELECT ".$select." FROM general_ramo_atuacao WHERE id = $id";

        $command = Yii::app()->db2->createCommand($sql);
        $recordset = $command->queryRow();     
        
        return $recordset[$callback];
    }
    
    /**
     * Método setar as keywords de acordo com os ramos de atuação
     *
     * @param number
     *
    */
    public static function setKeyWords($id, $keywords){
        echo $id . " ".  $keywords;
      
        $values = "keywords = '$keywords'";
        $sql =  "UPDATE user_data SET ". $values ." WHERE id = $id";
        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            return $control;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        } 
        
        
    }
    
    /**
     * Método retornar o valor necessário do ramo de atuacao
     *
     * @param string
     *
    */
    public static function getStateId($string){        
   
        $select = "id";
        $sql = "SELECT ".$select." FROM general_state WHERE uf = '$string'";

        $command = Yii::app()->db->createCommand($sql);
        $recordset = $command->queryRow();
        
        $result =  $recordset['id'];

        return $result;
    }
    
    /**
     * Método retornar o valor necessário do ramo de atuacao
     *
     * @param string
     *
    */
    public static function getAddressFix($address){        
        
        Yii::import('application.extensions.utils.StringUtils');
        $vowels = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
  		
        //Endereco
        $stub = str_replace(",,", ",", $address);
        $stub2 = str_replace(", , ", ",", $stub);
        $add = explode("-", $stub2);
        $rua = trim($add[1]);
        $rua = str_replace(",", ":", $rua);
        $rua = str_replace("/", "", $rua);
        $rua = str_replace(" ", "", $rua);
        $endereco = trim($add[0]);
        
        //Número
        $add_n = $rua . " " . $endereco;
        $nr = preg_replace("/[^0-9]/"," ",$add_n);
        $nr = trim($nr);
        $result['end'] = StringUtils::StringToLowerCase(str_replace($vowels, '', $add_n));
        $nr_expl = explode(" ", $nr);
        $result['nr'] = $nr;
        if(count($nr_expl) > 0)$result['nr'] = $nr_expl[0];

        return $result;
    }
    
    /**
     * Método verificar ser um deteminado documento já está cadastrado.
     * Isso indica que o usuário já está cadastrado previamente.
     *
     * @param string
     * @param number
     *
    */
    public static function getDocument($doc, $type){               
        
        $select = "name, texto";
        
        if($type == 0){
            $sql = "SELECT ".$select." FROM user_attribute WHERE name = 'usuario_CPF' AND texto = '$doc'";
        }else{
            $sql = "SELECT ".$select." FROM user_attribute WHERE name = 'usuario_CNPJ' AND texto = '$doc'";
        }
        
        try{
            $command = Yii::app()->db->createCommand($sql);
            $recordset = $command->queryRow();
                      
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }        
    }
    
    /*
     * Define o banco de dados que será utilizado para cadastrar ou buscar 
     * conteudo
     * 
     */
    public static function setUserBd($data_bases = null){
        
        //Local
        //$user1 = array("host" => 'localhost',"user" => "root",'database' => 'hari_embalagens', 'password' => 'root'); 
        //$user2 = array("host" => 'localhost',"user" => "root",'database' => 'acic','password' => 'root');

        //Real
        //$user1 = array("host" => '187.45.216.45', "user" => "purple", 'database' => 'site_purplepier', 'password' => '465000Po');
        //$user2 = array("host" => 'localhost',     "user" => "root",   'database' => 'cdl',             'password' => 'root');
        
        if($data_bases == null) $data_bases = array($user1);
        
        try{

            foreach ($data_bases as $values){
                $db = Yii::createComponent(array(
                   'class' => 'CDbConnection',
                    // other config properties...
                     'connectionString'=>"mysql:host=".$values['host'].";port=3306;dbname=".$values['database']."",
                        'username'=> $values['user'],
                        'password'=> $values['password'],
                        'charset'=>'utf8',
                        'emulatePrepare' => true,
                        'enableParamLogging'=>true,
                        'enableProfiling' => true,
                ));
                
                $setDB = Yii::app()->setComponent('db_user', $db);
                
            }
            
            
        }catch(CDbException $e){
            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();
        } 
    }
    
    /**
     * Método adicionar uma mensagem para um usuário
     *
     * @param string
     * @param number
     *
    */
    public static function setUserMessage($doc, $type){               
        
        $select = "name, texto";
        
        if($type == 0){
            $sql = "SELECT ".$select." FROM user_attribute WHERE name = 'usuario_CPF' AND texto = '$doc'";
        }else{
            $sql = "SELECT ".$select." FROM user_attribute WHERE name = 'usuario_CNPJ' AND texto = '$doc'";
        }
        
        try{
            $command = Yii::app()->db_user->createCommand($sql);
            $recordset = $command->queryRow();
                      
            return $recordset;
            
        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo "ERROR ". $e->getMessage();
        }        
    }
    
    /**
     * Método adicionar uma mensagem para um usuário
     *
     * @param string
     * @param number
     *
    */
    public static function insertProduto($data = array()){               
        
        Yii::import('application.extensions.digitalbuzz.produtosAttribute.dbProdutosAttribute');
        $pa = new dbProdutosAttribute();
                
        $url = StringUtils::StringToUrl($data['nome'], true, '-');
        if($data['id_subcategoria'] == '') $data['id_subcategoria'] = 0;
        
        $select  = "referencia, nome, marca, id_categoria, id_subcategoria, exibe_produtos, exibe_ecommerce, url, status, tipo, data, last_update, unidade, sob_consulta";
        $values  = "'{$data['ref']}', '{$data['nome']}', '{$data['marca']}', {$data['id_categoria']}, {$data['id_subcategoria']}, {$data['exibe_produto']}, {$data['exibe_produto']}, '$url', ";
        $values .= "{$data['status']}, '{$data['tipo']}', '{$data['date']}', '{$data['last_update']}', '{$data['unidade']}', {$data['sob_consulta']}";
        
        $sql = "INSERT INTO ecommerce_produtos ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Get Id
            $id = Yii::app()->db->getLastInsertID();
            
            if(isset($data['foto']) && $data['foto'] != ""){                
                $pa->setCurrentProduto($id);

                //Working with pictures
                $pa->adicionar("produto_IMG_1", $data['foto']);                   
               
            } 
                        
            return $id;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: DataUtils - insertProduto() ' . $e->getMessage();
        }      
    }
    
    /**
     * Método adicionar uma mensagem para um usuário
     *
     * @param string
     * @param number
     *
    */
    public static function insertProdutoCategorias($data = array()){               
        
        if(!$data['id_special']){
            $select  = "categoria_label, categoria_url, exibe";
            $values  = "'{$data['categoria_label']}', '{$data['categoria_url']}', {$data['exibe']} ";
        }
        
        if( $data['id_special']){
            $select  = "id_categoria, categoria_label, categoria_url, tipo, exibe";
            $values  = "{$data['id']}, '{$data['categoria_label']}', '{$data['categoria_url']}', {$data['tipo']}, {$data['exibe']}";
        }
      
        $sql = "INSERT INTO ecommerce_categorias ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Get Id
            $id = Yii::app()->db->getLastInsertID();          
                        
            return $id;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: DataUtils - insertProdutoCategorias() ' . $e->getMessage();
        }      
    }
    
    /**
     * Método adicionar uma mensagem para um usuário
     *
     * @param string
     * @param number
     *
    */
    public static function insertProdutoSubCategorias($data = array()){               
       
        
        if(!$data['id_special']){
            $select  = "id_categoria, subcategoria_label, subcategoria_url, tipo";
            $values  = "{$data['id_categoria']}, '{$data['subcategoria_label']}', '{$data['subcategoria_url']}', {$data['tipo']}";
        }
        
        if( $data['id_special']){
            $select  = "id_subcategoria, id_categoria, subcategoria_label, subcategoria_url, tipo";
            $values  = "{$data['id']}, {$data['id_categoria']}, '{$data['subcategoria_label']}', '{$data['subcategoria_url']}', {$data['tipo']}";
        }
      
        $sql = "INSERT INTO ecommerce_subcategorias ($select) VALUES ($values)";

        try{
            $comando = Yii::app()->db->createCommand($sql);
            $control = $comando->execute();
            
            //Get Id
            $id = Yii::app()->db->getLastInsertID();          
                        
            return $id;

        }catch(CDbException $e){
            Yii::trace("ERROR ". $e->getMessage());
            echo 'ERROR: DataUtils - insertProdutoSubCategorias() ' . $e->getMessage();
        }      
    }
}
?>