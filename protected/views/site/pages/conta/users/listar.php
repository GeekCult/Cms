<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<script type="text/javascript" src="/js/admin/user.js"></script>
<div class="mainPan">
    <div class="wrap">
        <div class="pan_top"></div>
        <div class="pan" id="panMain">
            <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>
            <div id="loaderMainConta">
                <h1><?php echo Yii::t("siteStrings", "label_title_users"); ?></h1> 
                <div class="container_submenu_categorias">
                    <div id="menu_conta">                                              
                        <ul>
                            <li id="link_conta_0pf"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle"><a href="/conta/users/pf/listar" id="conta_avisos" name="101">PF</a></div><div class="tab_corner_disable_right"></div></li>
                            <li id="link_conta_0pj"><div class="tab_corner_disable_left"></div><div class="tab_corner_disable_middle"><a href="/conta/users/pj/listar" id="conta_avisos" name="1">PJ</a></div><div class="tab_corner_disable_right"></div></li>
                        </ul> 
                        <script type="text/javascript">setTabEnable('<?php echo $type_account_string ?>', "");</script>
                    </div>
                </div>
                <div class='clear'></div>
                <div class="divider_horizontal"></div>
                    <div class="table_support" id="table_site">
                        <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                            <thead>
                            <tr class="title_table" id="title_table">
                                <td width="1%"></td>
                                <td width="30%" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_name_user") ?></strong></td>
                                <td width="2%" align="center" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_type") ?></strong></td>                                
                                <td width="10%" class="title_table"><strong><?php echo Yii::t("adminForm", "common_menu_email") ?></strong></td>
                                <td width="3%" align="center" class="title_table"><strong><?php echo Yii::t("adminForm", "title_common_situation") ?></strong></td>
                                <td width="5%" class="edit_table" align="center" colspan="4"><strong><?php echo Yii::t("adminForm", "common_menu_edit") ?></strong></td>
                            </tr>
                            <tr class="rows_table_0">
                                <td><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                                <td><input type="text" style="width: 95%" id="search_name_user"/></td>
                                <td><select id="search_type_user"><option value="0">pf</option><option value="1">pj</option><option value="todos">todos</option></select></td>
                                <td><input type="text" id="email_user" style="width: 95%"/></td>
                                <td><select id="search_status_user"><option value="">todos</option><option value="1">ativo</option><option value="0">inativo</option><option value="3">aguardando</option><option value="4">alerta</option></select></td>
                                <td colspan="4"><input type="button" value="buscar" style="width: 95%"/></td>
                            </tr>
                            </thead>
                            <tbody id="base_row">
                            <?php if(count($content) != 0){$color="0"; foreach($content as $values){ if($values['field1'] != "") {?>                            
                            <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                                <td><?php if($values['type'] == "1"){echo  $values['field2'];} else{ echo  $values['field1'] . " " . $values['field2'];} ?></td>
                                <td align="center"><?php echo $values['type_name'] ?></td>                                
                                <td><?php echo $values['email'] ?></td>
                                <td align="center"><input type="button" title="<?php echo $values['account_states_id_string'] ?>" class="icon_status_<?php echo $values['account_status'] ?>"/></td>
                                <?php if($values['account_locked'] == 0){ ?>
                                <td align="center"><input type="button" id="bt_lock_open" name="<?php echo $values['id'] ?>" title="ativa" class="op_<?php echo $values['id'] ?>"/></td>
                                <?php } else if($values['account_locked'] == 2){//Incomplete locked ?>                    
                                <td align="center"><input type="button" id="bt_lock_close_red" name="<?php echo $values['id'] ?>" title="bloqueado incompleto" class="op_<?php echo $values['id'] ?>"/></td>
                                <?php } else{ //Just locked ?>
                                <td align="center"><input type="button" id="bt_lock_close" name="<?php echo $values['id'] ?>" title="bloqueado" class="op_<?php echo $values['id'] ?>"/></td>
                                <?php } ?>
                                <td align="center"><input type="button" id="bt_key" name="<?php echo $values['id'] ?>" title="reiniciar senha, envia email! " class="<?php echo $values['type'] ?>"/></td>
                                <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar" class="<?php echo $values['type'] ?>"/></td>
                                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                            </tr>
                            <?php if($color == "1"){$color = "2"; }else{$color = "1";} }}} else{ ?>
                            <tr>
                                <td height="30" align="center" colspan="7" >
                                    <strong><?php echo Yii::t("adminForm", "title_common_no_item") ?></strong>
                                </td>
                            </tr>               
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="container_qtd_users"><b>Total usuários:</b> <?php echo $qtd_cat ?> - <?php echo $qtd_users ?></div>
                    <p>&nbsp;</p>
                </div>
                <div class="clear"></div>
                <div class="divider_horizontal"></div>
            </div>
        </div>
        <div class="account_content_footer"></div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input type="hidden" value="conta" id="helper_tipo_controller"/>
<script type="text/javascript">initLiveSearchUser();initListenerMenuContaUser();</script>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>