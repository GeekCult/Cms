<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "user_page_title_list") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <div class="comboboxSelector_giant">
        <label for="" class="filtro_pos">Filtro</label>
        <div class="styled-select">
            <select id="filtro" name="filtro">
                <option value="">Todos</option>
                <option value="associado">Associados</option>
                <option value="colunista">Colunistas</option>
                <option value="funcionario">Funcionários</option>
                <option value="desenvolvedor">Desenvolvedores</option>
                <option value="parceiro">Parceiros</option>
                <option value="representante">Representantes</option>
                <option value="atendimento">Atendimentos</option>
                <option value="cliente">Clientes</option>
                <option value="acessor">Acessores</option>
                <option value="administrador">Administradores</option>
                <option value="prospectador">Prospectadores</option>
                <option value="profissional">Profissionais</option>
                <option value="rede_beneficios">Rede Benefícios</option>
                <option value="fornecedor">Fornecedores</option>
            </select>
        </div>
    </div>
    <div class="clear"></div>
    <div id="menu_conta" class="container_menu_right_table">
        <ul>
            <li id="link_conta_01">
                <a href="/admin/users/pf/listar_pf">
                    <div class="tab_corner_disable_left"></div>
                    <div class="tab_corner_disable_middle">
                        <div class="bt_support">PF</div>
                    </div>
                    <div class="tab_corner_disable_right"></div>
                </a>
            </li>
            <li id="link_conta_02"><div class="tab_corner_disable_left"></div>
                <a href="/admin/users/pj/listar_pj">
                    <div class="tab_corner_disable_middle">                                            
                        <div  class="bt_support">PJ</div>
                    </div>
                    <div class="tab_corner_disable_right"></div>
                </a>
            </li>
        </ul>
    </div>
    <div class="clear divider_horizontal"></div>
 
    <div id="ItemManager">
        <div class="table_support">            
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <thead>
                <tr class="title_table">
                    <td width="1%"></td>
                    <td width="30%" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_name_user") ?></strong></td>
                    <td width="2%" align="center" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_type") ?></strong></td>                    
                    <td width="10%" class="title_table" align="center"><strong><?php echo Yii::t("adminForm", "common_menu_email") ?></strong></td>
                    <td width="3%" align="center" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_situation") ?></strong></td>
                    <td width="5%" class="edit_table" align="center" colspan="3"><strong><?php echo Yii::t("adminForm", "common_menu_edit") ?></strong></td>
                </tr>
                <tr class="rows_table_0">
                    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                    <td><input type="text" style="width: 95%" id="search_name_user"/></td>
                    <td align="center"><select id="search_type_user"><option value="0">pf</option><option value="1">pj</option><option value="todos">todos</option></select></td>
                    <td><input type="text" id="email_user" style="width: 95%"/></td>
                    <td><select id="search_status_user"><option value="">todos</option><option value="1">ativo</option><option value="0">inativo</option><option value="3">aguardando</option><option value="4">alerta</option></select></td>
                    <td colspan="3"><input type="button" value="buscar" style="width: 95%"/></td>
                </tr>
                </thead>
                <tbody id="base_row">
                <?php if(isset($content[0]['id']) && count($content) > 0){$color="0"; foreach($content as $values){ ?>
                <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                    <td><?php if($values['type_name'] == "pj"){echo  $values['field1'];} else{ echo  $values['field1'] . " " . $values['field2'];} ?></td>
                    <td align="center"><?php echo $values['type_name'] ?></td>
                    <td><?php echo $values['email'] ?></td>
                    <td align="center"><input type="button" title="<?php echo $values['account_states_id_string'] ?>" class="icon_status_<?php echo $values['account_status'] ?>" name="<?php echo $values['id'] ?>" id="bt_status_account"/></td>                   
                    <?php if($values['account_locked'] == 0){ ?>
                    <td align="center"><input type="button" id="bt_lock_open" name="<?php echo $values['id'] ?>" title="ativa" class="op_<?php echo $values['id'] ?>"/></td>
                    <?php } else { ?>                    
                    <td align="center"><input type="button" id="bt_lock_close" name="<?php echo $values['id'] ?>" title="bloqueado" class="op_<?php echo $values['id'] ?>"/></td>
                    <?php } ?>
                    
                    <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar" class="<?php echo $values['type'] ?>"/></td>
                    <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>
                <?php if($color == "1"){$color = "0"; }else{$color = "1";}; }} else{ ?>
                <tr class="rows_table_0">
                    <td height="30" align="center" colspan="7" >
                        <strong><?php echo Yii::t("adminForm", "title_common_no_users") ?></strong>
                    </td>
                </tr>               
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php include Yii::app()->getBasePath() . '/views/site/common/menu/paginacao/paginador.php'; ?>
        <p>&nbsp;</p>
        <div class="container_qtd_users"><b>Quantidade total de usuários:</b> <?php echo $qtd_users ?></div>
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
</div>
<input type="hidden" value="admin" id="helper_tipo_controller"/>
<input type="hidden" value="10" id="helper_records"/>
<input type="hidden" value="users" id="local_page"/>
<input type="hidden" value="<?php echo $type ?>" id="local_page_type"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<script type="text/javascript">setTimeout(function(){initLiveSearchUser(); initListenerUsersTags()},1000);</script>