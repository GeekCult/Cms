<?php

/**
 * Esta classe contém o mecanismo de controle das
 * regiões de venda de cada produto
 *
 */
class RegiaoManager {

    /**
     * Usado - Site
     *
     * Retorna todas as regiões encontradas no banco
     *
     *
     * @return boolean/object false ou as regiões encontradas.
     *
     */
    public function getAllContent() {

        $select = "id, regiao";

        $sql = "SELECT " . $select . " FROM general_regions";
        
        try {

            $command = Yii::app()->db->createCommand($sql);
            
            $recordset = $command->queryAll();
            
            if ($recordset != "") {

                return $recordset;

            } else {

                return false;
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }

    /**
     * Usado - Site
     *
     * Retorna todos os estados encontradas no banco
     *
     *
     * @return boolean/object false ou os estados encontrados.
     *
     */
    public function getAllStates() {

        $select = "id, name, uf";

        $sql = "SELECT " . $select . " FROM general_state";

        try {

            $command = Yii::app()->db->createCommand($sql);

            $recordset = $command->queryAll();

            if ($recordset != "") {

                return $recordset;

            } else {

                return false;
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }
    
    /**
     * Usado - Site
     *
     * Retorna todos os paisess encontradas no banco
     *
     *
     * @return boolean/object false ou os estados encontrados.
     *
     */
    public function getAllCountries() {

        $select = "id, nome, iso3";

        $sql = "SELECT " . $select . " FROM general_paises";

        try {

            $command = Yii::app()->db2->createCommand($sql);

            $recordset = $command->queryAll();

            if ($recordset != "") {

                return $recordset;

            } else {

                return false;
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            echo "ERROR " . $e->getMessage();

        }
    }

    /**
     * Usado - Site
     *
     * Retorna as regioes relacionadas ao estado submetido
     *
     *
     * @return boolean/array.
     *
     */
    public function getRegionsByUf($uf, $id_produto) {

        $select = "id, regiao, uf";

        $sql = "SELECT " . $select . " FROM general_regions WHERE uf = '$uf'";

        try {      
            
            $command = Yii::app()->db->createCommand($sql);

            $recordset = $command->queryAll();

            if ($recordset != "") {

                for($i = 0; $i < count($recordset); $i++){

                    $recordset[$i]['checked'] = $this->verifyCheckedRegions($recordset[$i]['id'], $id_produto);

                }
                
                return $recordset;

            } else {

                return "Não existem nenhuma região para este estado";
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }

    /**
     * Usado - Site
     *
     * Retorna as regioes relacionadas ao usuário logado
     * Ele verifica se o e-mail do usuário possui regioes relacionadas
     *
     *
     * @return boolean/array.
     *
     */
    public function getRegionsUser($uf, $email) {

        $select = "id, regiao, uf";

        $sql = "SELECT " . $select . " FROM general_regions WHERE uf = '$uf'";

        $sqr = "SELECT id, regiao_interesse FROM general_newsletter WHERE email = '$email'";

        try {

            $command = Yii::app()->db->createCommand($sql);

            $recordset = $command->queryAll();

            //Gets the string regions from general_newsletter
            $command2 = Yii::app()->db->createCommand($sqr);

            $regions = $command2->queryRow();

            $temp_regioes = explode(",", $regions['regiao_interesse']);

            if ($recordset != "") {

                for($i = 0; $i < count($recordset); $i++){

                    $recordset[$i]['checked'] = $this->verifyCheckedRegionsByEmail($recordset[$i]['id'], $temp_regioes);

                }

                return $recordset;

            } else {

                return "Não existe nenhuma região disponível para este estado";
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }
    
    /**
     * Usado - Site
     *
     * Retorna os paises relacionadas ao usuário logado
     * Ele verifica se o e-mail do usuário possui estados relacionadas
     *
     *
     * @return boolean/array.
     *
     */
    public function getCountriesUser($letter, $email) {
      
        $select = "id, iso3, nome";

        $sql = "SELECT " . $select . " FROM general_paises WHERE nome LIKE '$letter%'";

        $sqr = "SELECT id, regiao_interesse FROM general_newsletter WHERE email = '$email'";

        try {

            $command = Yii::app()->db2->createCommand($sql);

            $recordset = $command->queryAll();

            //Gets the string regions from general_newsletter
            $command2 = Yii::app()->db->createCommand($sqr);

            $regions = $command2->queryRow();

            $temp_regioes = explode(",", $regions['regiao_interesse']);

            if ($recordset != "") {

                for($i = 0; $i < count($recordset); $i++){

                    $recordset[$i]['checked'] = $this->verifyCheckedRegionsByEmail($recordset[$i]['id'], $temp_regioes);

                }

                return $recordset;

            } else {

                return "Não existe nenhum país disponível para esta pesquisa";
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }

    /**
     * Usado - Site
     *
     * Retorna as regioes relacionadas ao usuário logado
     * Ele verifica se o e-mail do usuário possui regioes relacionadas
     *
     *
     * @return boolean/array.
     *
     */
    public function getNewsLetterAttributes($email) {

        $sql = "SELECT id, regiao_interesse, newsletter FROM general_newsletter WHERE email = '$email'";

        try {

            //Gets the string regions from general_newsletter
            $command = Yii::app()->db->createCommand($sql);

            $newsletter_att = $command->queryRow();

            return $newsletter_att;

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }

    /**
     * Usado - Site
     *
     * Retorna todas as regiões encontradas que um determindao produto
     * Este método é usado para editar um produto.
     *
     *
     * @return boolean/object false ou as regiões encontradas.
     *
     */
    public function getRegionsByProdutoId($id_produto) {

        $select = "id_region";

        $sql = "SELECT " . $select . " FROM ecommerce_regions WHERE id_produto = $id_produto";

        try {

            $command = Yii::app()->db->createCommand($sql);

            $recordset = $command->queryAll();

            $temp_regions = "";

            //Este método transforma os registro em uma string assim como
            //é gravado no banco na sessão de regiões.
            if ($recordset != "") {

                foreach($recordset as $values){

                    $temp_regions .= $values['id_region'] . ",";

                }

                return $temp_regions;

            } else {

                return false;
            }

        } catch (CDbException $e) {

            Yii::trace("ERROR " . $e->getMessage());
            return false;

        }
    }

    /**
     * Metodo para salvar um novo registro com e-mail e região
     * do usário
     *
     * @param array
     *
    */
    public function submitContent($get_post) {

        $select = "email, regiao_interesse, newsletter, data";

        $values = $get_post[0]."', '".$get_post[1]."', '".$get_post[2]."', '".$get_post[3];

        $sql =  "INSERT INTO general_newsletter (". $select .") VALUES ('". $values . "') ON DUPLICATE KEY UPDATE regiao_interesse = '".$get_post[1]."'";

        try {

            $comando = Yii::app() -> db -> createCommand($sql);

            $control = $comando -> execute();

            echo "cadastro salvo com sucesso!";


        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Metodo para atualizar o registro com a região de interesse
     * do usário
     *
     * @param array
     *
    */
    public function atualizarContent($get_post) {

        $values = "regiao_interesse = '" . $get_post[1]."', newsletter = '" . $get_post[2] . "'";

        $sql =  "UPDATE general_newsletter SET $values WHERE id = $get_post[0]";

        try {

            $comando = Yii::app() -> db -> createCommand($sql);

            $control = $comando -> execute();

            echo "Dados alterados com sucesso!";


        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Metodo para atualizar o registro com a região de interesse
     * do usário
     *
     * @param array
     *
    */
    public function gerenciarContent($get_post) {

        $values = "regiao_interesse = '" . $get_post[0]."'";

        $sql =  "UPDATE general_newsletter SET $values WHERE email = '$get_post[1]'";

        try {

            $comando = Yii::app() -> db -> createCommand($sql);

            $control = $comando -> execute();

            echo "Dados alterados com sucesso!";


        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Usado - Site
     *
     * Salva as regioes relacionadas ao produto
     * É passado um string com todas as regions separadas por virgula
     * Ex: 2, 34, 77, 99,
     *
     * @param string $regions_string
     * @return boolean/array.
     *
     */
    public function saveProdutosRegions($id_produto, $regions_string) {

        $select = "id_produto, id_region";

        $region_sel = explode(",", $regions_string);

        try {
            
            //Primeiro remove todos os registros do banco com o id definido
            $this->removeprodutoRegions($id_produto);

            //Separa a string em registros e salva estes no banco um por vez
            for ($i = 0; $i < (count($region_sel)-1); $i++){

                $sql =  "INSERT INTO ecommerce_regions (". $select .") VALUES ('". $id_produto . "', '" . $region_sel[$i] . "')";

                $comando = Yii::app() -> db -> createCommand($sql);

                $control = $comando -> execute();

            }
            
        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }
        
    }

    /**
     * Usado - Site
     *
     * Remove as regioes relacionadas ao produto
     * 
     * @param number 
     *
     */
    public function removeProdutoRegions($id_produto) {


        try
        {
            $sql =  "DELETE FROM ecommerce_regions WHERE id_produto = $id_produto";

            $comando = Yii::app() -> db -> createCommand($sql);

            $control = $comando -> execute();

        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Usado - Site
     *
     * Verify if the region is selected
     *
     * @param number
     *
     */
    public function verifyCheckedRegions($id_uf, $id_produto) {
        
        try
        {

            if($id_produto != ""){

                $sql =  "SELECT id FROM ecommerce_regions WHERE id_produto = $id_produto AND id_region = $id_uf";

                $command = Yii::app()->db->createCommand($sql);

                $controll = $command->queryRow();

                if($controll != ""){

                    return "checked";

                }else{

                    return "";

                }

            }else{

                return false;

            }

        } catch (CDbException $e) {

            Yii::trace("ERROR ". $e->getMessage());

            echo "ERROR ". $e->getMessage();
        }

    }

    /**
     * Usado - Site
     *
     * It verifies if the region is selected or not
     *
     * @param number
     *
     */
    public function verifyCheckedRegionsByEmail($regiao, $temp_regioes){

        $temp_var = "";

        for($i = 0; $i < count($temp_regioes); $i++){

            if($regiao == $temp_regioes[$i]){

                $temp_var = "checked";

            }
        }

        return $temp_var;

    }

}

?>