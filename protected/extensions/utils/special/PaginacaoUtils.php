<?php

/**
 * Description of PaginacaoUtils
 *
 * Here are some method to make easier the class Themes
 *
 * @author CarlosGarcia
 * 
 */
class PaginacaoUtils{
    
    /**
     * Método para dar resize no video
     *
     * @param string
     *
    */
    public static function getPaginationInfo($data, $type){
        
        Yii::import('application.extensions.utils.DataBaseUtils');
        
        $session = MethodUtils::getSessionData();
        
        try{
        
            switch($type){

                case 'prospects':
                case 'prospects_fv':
                    $query = "tipo = 'prospects' AND status = " . $session['listProspects_status']. "";
                    if ($session['idProspectador'] != '') $query = "tipo = 'prospects' AND id_user = ". $session['idProspectador'] . " AND status = ".$session['listProspects_status'] ."";
                    $table = 'user_company';
                    $link = '/conta/prospects/' . $data['action'];
                    if($type == "prospects_fv") $link = '/admin/forca_vendas/' . $data['action'];
                    $skip = 10;
                    break;
                 
                case 'prospects_search':
                    $query = "tipo = 'prospects' AND status = " . $session['listProspects_status']. "";
                    $table = 'user_company';
                    $link = '/conta/prospects/' . $data['action'];
                    $skip = 10;
                    break;
                
                case 'prospects_associados':
                case 'prospects_clientes':    
                    $query = "name = 'associado'";
                    $table = 'user_attribute';
                    $link = '/conta/prospects/' . $data['action'];
                    $skip = 10;
                    break;
                
                case 'users':
                    
                    if($data['action'] == 'pf') $data['action'] = 'paginar_pf'; 
                    if($data['action'] == 'pj') $data['action'] = 'paginar_pj'; 
                    
                    $query = "type = " . $data['type'];
                    $table = 'user_data';
                    $link = '/admin/users/' . $data['action'];
                    $skip = 10;
                    break;
                    
                case 'users_attribute':
                case 'users_attribute_rh':
                case 'users_entity':
                   
                    if($data['action'] == 'pf') $data['action'] = 'paginar_pf'; 
                    if($data['action'] == 'pj') $data['action'] = 'paginar_pj'; 
                    
                    $query = "name = '" . $data['type'] . "'";
                    $table = 'user_attribute';
                    $link = '/admin/users/' . $data['action'];
                    
                    if($type == "users_attribute_rh") $link = '/admin/recursos_humanos/' . $data['action']. "/listar";
                    if($type == 'users_entity') $link = '/admin/users_selection/exibir_kind';
                    $skip = 10;
                    break;
                    
                case 'ecommerce':
          
                    $session = MethodUtils::getSessionData();
                    
                    $query = "A.id_categoria = " . $data['prd']['id_categoria'] . " AND A.exibe_ecommerce = 1 AND B.qtd > 0 ";                    
                    if(isset($data['prd']['id_subcategoria'])) $query = "A.id_categoria = " . $data['prd']['id_categoria'] ." AND A.id_subcategoria = " . $data['prd']['id_subcategoria'] ." AND A.exibe_ecommerce = 1 AND B.qtd > 0 ";
                    if(isset($data['prd']['id_subitem'])) $query = "A.id_categoria = " . $data['prd']['id_categoria'] ." AND A.id_subcategoria = " . $data['prd']['id_subcategoria'] ." AND A.id_subitem = " . $data['prd']['id_subitem'] . " AND A.exibe_ecommerce = 1 AND B.qtd > 0 ";
                    
                    $link = '/loja/' . $data['prd']['categoria'];
                    $link = $link . '?p=';
                    //$result['isGet'] = true;
                    ($session["ecommerce_limit_max"] != '') ? $skip = $session["ecommerce_limit_max"] : $skip = 10;
                    
                    break;
                    
                case 'produtos':
                case 'produtos_simples':
         
                    $session = MethodUtils::getSessionData();
                    
                    $query = " exibe_produtos = 1 ";
                    if(isset($data['prd']['id_categoria'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} AND exibe_produtos = 1 ";                    
                    if(isset($data['prd']['id_subcategoria'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND exibe_produtos = 1 ";
                    if(isset($data['prd']['id_subitem'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND id_subitem = {$data['prd']['id_subitem']} AND exibe_produtos = 1  ";

                    $table = 'ecommerce_produtos';
                    $link = '/produtos/' . $data['prd']['categoria'];
                    if(isset($data['prd']['subcategoria']) && $data['prd']['subcategoria'] != '')$link = '/produtos/' . $data['prd']['categoria'] . "/" . $data['prd']['subcategoria'];
                    if(isset($data['prd']['subitem']) && $data['prd']['subitem'] != '')$link = '/produtos/' . $data['prd']['categoria'] . "/" . $data['prd']['subcategoria'] . "/" . $data['prd']['subitem'];
                    $link = $link . '?p=';
                    //$result['isGet'] = true;
                    ($session["ecommerce_limit_max"] != '') ? $skip = $session["ecommerce_limit_max"] : $skip = 10;
                    
                    break;
                    
                case 'produtos_admin':               
                    
                    Yii::import('application.extensions.utils.ProdutosUtils');
                    $session = MethodUtils::getSessionData();
                    
                    $filter = ProdutosUtils::getMoreFilters();
                    $query = "tipo = 'simples' $filter ";
                    if(isset($data['prd']['id_categoria'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} $filter ";                    
                    if(isset($data['prd']['id_subcategoria'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} $filter ";
                    if(isset($data['prd']['id_subitem'])) $query = "tipo = 'simples' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND id_subitem = {$data['prd']['id_subitem']} $filter ";

                    $table = 'ecommerce_produtos';
                    $link = '/admin/produtos/' . $data['prd']['categoria'];
                    $link = $link . '?p=';
                    //$result['isGet'] = true;
                    ($session["ecommerce_limit_max"] != '') ? $skip = $session["ecommerce_limit_max"] : $skip = 10;
                    
                    break;
                    
                case 'auto':
                case 'autos':
                    $session = MethodUtils::getSessionData();
                    
                    $query = " exibe_produtos = 1 ";
                    if(isset($data['prd']['id_categoria'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} AND exibe_produtos = 1 ";                    
                    if(isset($data['prd']['id_subcategoria'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND exibe_produtos = 1 ";
                    if(isset($data['prd']['id_subitem'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND id_subitem = {$data['prd']['id_subitem']} AND exibe_produtos = 1  ";

                    $table = 'ecommerce_produtos';
                    $link = '/autos/' . $data['prd']['categoria'];
                    if(isset($data['prd']['subcategoria']) && $data['prd']['subcategoria'] != '')$link = '/autos/' . $data['prd']['categoria'] . "/" . $data['prd']['subcategoria'];
                    if(isset($data['prd']['subitem']) && $data['prd']['subitem'] != '')$link = '/autos/' . $data['prd']['categoria'] . "/" . $data['prd']['subcategoria'] . "/" . $data['prd']['subitem'];
                    
                    
                    $link = $link . '?p=';
                    //$result['isGet'] = false;
                    ($session["ecommerce_limit_max"] != '') ? $skip = $session["ecommerce_limit_max"] : $skip = 10;
                    
                    break;
                    
                case 'autos_admin':               
                    
                    Yii::import('application.extensions.utils.ProdutosUtils');
                    $session = MethodUtils::getSessionData();
                    
                    $filter = ProdutosUtils::getMoreFilters();
                    $query = "tipo = 'auto' $filter ";
                    if(isset($data['prd']['id_categoria'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} $filter ";                    
                    if(isset($data['prd']['id_subcategoria'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} $filter ";
                    if(isset($data['prd']['id_subitem'])) $query = "tipo = 'auto' AND id_categoria = {$data['prd']['id_categoria']} AND id_subcategoria = {$data['prd']['id_subcategoria']} AND id_subitem = {$data['prd']['id_subitem']} $filter ";
                    
                    $table = 'ecommerce_produtos';
                    $link = '/admin/autos/' . $data['prd']['categoria'];
                    $link = $link . '?p=';
                    //$result['isGet'] = true;
                    $skip = 10;
                    
                    break;
                    
                case 'ordem_servico':                    
                    $query = " ordem_servico = 1 ";
                    $table = 'ecommerce_produtos';
                    $link = '/admin/erp_atividades/' . $data['action'];
                    $skip = 10;
                    
                    break;
                
                case 'curriculos':
                    /* Curriculo quer dizer que é uma empresa buscando curriculos */
                    $query = "profile_level = 2";
                    if($session['area']) $query .= " AND extra_2 = {$session['area']}";
                    if($session['expecializacao']) $query .= " AND extra_1 = {$session['especializacao']}";
                    if($session['hierarquia']) $query .= " AND extra_3 = {$session['hierarquia']}";
                    if($session['pretensao']) $query .= " AND extra_1 = {$session['pretensao']}";
                    if($session['cidade']) $query .= " AND cidade = '{$session['cidade']}'";
                    if($session['estado']) $query .= " AND estado = '{$session['estado']}'";
                    $table = 'user_data';
                    $link = '/bancodecurriculos/listar/curriculos';                    
                    $skip = 10;                    
                    break;
                    
                case 'curriculos_admin':
                    /* Curriculo quer dizer que é uma empresa buscando curriculos */
                    $query = "profile_level = 2";
                    if($session['area']) $query .= " AND extra_2 = {$session['area']}";
                    if($session['expecializacao']) $query .= " AND extra_1 = {$session['especializacao']}";
                    if($session['hierarquia']) $query .= " AND extra_3 = {$session['hierarquia']}";
                    if($session['pretensao']) $query .= " AND extra_1 = {$session['pretensao']}";
                    if($session['cidade']) $query .= " AND cidade = '{$session['cidade']}'";
                    if($session['estado']) $query .= " AND estado = '{$session['estado']}'";
                    $table = 'user_data';
                    $link = '/admin/curriculums/listar';                    
                    $skip = 10;                    
                    break;
                
                case 'vagas':
                    /* Vaga quer dizer que é um candidado buscando vagas */
                    $query = "tipo = 'vaga'";
                    if($session['area']) $query .= " AND setor = {$session['area']}";
                    if($session['expecializacao']) $query .= " AND especializacao = {$session['especializacao']}";
                    if($session['hierarquia']) $query .= " AND extra_3 = {$session['hierarquia']}";
                    if($session['pretensao']) $query .= " AND extra_1 = {$session['pretensao']}";
                    if($session['cidade']) $query .= " AND cidade = '{$session['cidade']}'";
                    if($session['estado']) $query .= " AND estado = '{$session['estado']}'";
                    if($session['keyword']) $query .= " AND (titulo LIKE '%{$session['keyword']}%' OR descricao LIKE '%{$session['keyword']}%')";
                    $table = 'controle_pedidos';
                    $link = '/bancodecurriculos/listar/vagas';
                    $skip = 10;                    
                    break;
                
                case 'vagas_admin':
                    $query = "tipo = 'vaga'";
                    $table = 'controle_pedidos';
                    $link = '/admin/vagas/listar_todas';
                    $skip = 10;                    
                    break;
                
                case 'newsletter':
                    $query = "newsletter != 2";
                    $table = 'general_newsletter';
                    $link = '/admin/newsletter/listar';
                    $skip = 10;                    
                    break;
                
                case 'elearn':
                    $query = "id_user = {$session['estudar_curso']}";
                    $table = 'paginas_data';
                    $link = '/conta/elearn/estudar';
                    $skip = 10;                    
                    break;
                
                case 'images':
                    $query = "tipo != 'playground'";
                    $table = 'conteudo_images';
                    $link = '/admin/images/listar';
                    $skip = 10;                    
                    break;
            }
            
            $result['link'] = $link;
            
            if($type != 'ecommerce' && $type != 'produtos' && $type != 'produtos_simples'  && $type != 'elearn'){
                $rows = DataBaseUtils::getCountRecordsSpecial($table, $query, $skip);
            }else if($type == 'produtos' || $type == 'produtos_simples'){
                $rows = DataBaseUtils::getCountRecordsProdutos($query, $skip);
            }else if($type == 'elearn'){
                $rows = DataBaseUtils::getCountRecordsElearn($table, $query, $skip);
            }else{
                $rows = DataBaseUtils::getCountRecordsEcommerce($query, $skip);
            }
           
            //Split up result rows
            $result['items'] = $rows['partial'];
            $result['total'] = $rows['total'];

            return $result;
        
        }catch(CDbException $e) {
            Yii::trace("ERROR ".$e->getMessage());
            echo "ERROR: PaginacaoUtils - getPaginationInfo() " . $e->getMessage();
        }

    }
    
}
?>