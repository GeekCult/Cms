<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Listagem de conteúdo</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <div class="clear"></div>
    <div class="container_devices_options">
        <div class="picture_container_page"></div>
        <div class="title_devices">Você está editando <span class="title_device_name"><?php echo $session['device']?></span></div>
        <div class="title_empty_texture">
            <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
            <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
            <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
        </div>
    </div>
    <div class="clear"></div>
    <div class="table_support">
        <table border="0" align="center" cellpadding="1" cellspacing="1" width="100%">
            <?php $i = 0;  if($content){?>
            <tr class="title_table">
                <td width="1%"  >&nbsp;</td>
                <td width="2%" align="center">ID</td>
                <td width="35%" >Nome </td>
                <td width="3%" align="center">Layout</td>
                <td width="1%" align="center">Tipo</td>
                <td width="5%" align="center">Categoria</td>
                <td width="2%" align="center">Indice</td>
                <td width="2%" align="center" class="hide"><?php echo Yii::t('adminForm', 'common_views');?></td>
                <td width="1%" align="center" colspan="<?php if($session['master_purple']){ echo '4';}else{echo '3';} ?>">Editar</td>              
            </tr>
            <?php $color = "0"; foreach($content as $values){ ?>
            <tr id="page_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>" style="height: 40px!important">
                <?php if ($values['menu_principal'] == 1) {?>
                <?php if($values['tipo'] == ""){ ?>
                <td height="30" align="center"><img src="/media/images/icons/pasta.png" width="23" height="23" alt=""/></td>
                <?php } else { ?>
                <td height="30" align="center"><img src="/media/images/icons/pasta_special.png" width="23" height="23" alt=""/></td>
                <?php }} else { ?>
                <?php if($values['tipo'] == ""){ ?>
                <td height="30" align="center"><img src="/media/images/icons/pasta_black.png" width="23" height="23" alt=""/></td>
                <?php } else { ?>
                <td height="30" align="center"><img src="/media/images/icons/pasta_black_special.png" width="23" height="23" alt=""/></td>
                <?php }} ?>
                <td align="center"><div class="legend"><?php echo $values['id'] ?></div></td>
                <td><?php echo $values['label'] ?></td>
                <td align="center">
                    <?php if ($values['layout'] != "") { ?>
                        <img src="/media/images/layout_pages/<?php echo $values['layout'] ?>.jpg" title="<?php echo $values['layout'] ?>" width="50" height="40" alt=""/>
                    <?php } else { ?>
                        <img src="/media/images/layout_pages/pagina_auxiliar.jpg" title="<?php echo $values['layout'] ?>" width="50" height="40" alt=""/>
                    <?php } ?>
                </td>
                <td align="center">
                    <div><?php if($values['tipo'] != ""){echo $values['tipo'];}else{echo "conteúdo";} ?></div>
                </td>
                <td align="left">
                    <div class="styled-select transparent">
                    <select name="select_<?php echo $values['id']?>" id="<?php echo $values['id']?>" class="groupItems">
                        <option value="0">Nenhuma categoria</option>
                        <?php foreach($categorias as $item){ ?>
                        <option value="<?php echo $item['id'] ?>" <?php if($values['id_categoria'] == $item['id'])echo "selected"; ?>><?php if($item['nome'] != "")echo $item['nome']; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                </td>
                <td align="center"><?php echo $values['n_index'] ?></td>
                <td align="center" class="hide"><?php echo $values['views'] ?></td>
                <?php if($session['master_purple']){  ?>
                <td align="center">
                    <?php if($is_hidden){  ?>
                    <input type="image" name="bt_show" src="/media/images/icons/icon_eye.png" title="ocultar" id="<?php echo $values['id'] ?>"/>
                    <?php }else{ ?>
                    <input type="image" name="bt_hide" src="/media/images/icons/icon_eye_hide.png" title="ocultar" id="<?php echo $values['id'] ?>"/>
                    <?php } ?>
                </td>
                <?php }else{ ?>
                <td align="center">
                    <?php if($is_hidden){  ?>
                    <input type="image" name="bt_show" src="/media/images/icons/icon_eye.png" title="ocultar" id="<?php echo $values['id'] ?>"/>  
                    <?php }else{ ?>
                    <input type="image" name="bt_hide" src="/media/images/icons/icon_eye_hide.png" title="ocultar" id="<?php echo $values['id'] ?>"/>
                    <?php } ?>
                </td>
                <?php } ?>
                <td align="center">
                    <?php if($values['tipo'] == ""){ ?>
                    <input type="image" name="bt_excluir" src="/media/images/icons/excluir.gif" title="excluir" width="20" height="20" id="<?php echo $values['id'] ?>"/>
                    <?php } else { ?>
                    <input type="image" name="bt_excluir_disable" src="/media/images/icons/excluir_disable.gif" title="não pode excluir" width="20" height="20" id=""/>
                    <?php } ?>                   
                </td>
                <td align="center">
                    <?php if($values['modelo'] == 0){ ?>
                    <input type="image" name="bt_editar" src="/media/images/icons/editar.gif" title="editar" id="<?php echo $values['id'] ?>"/>
                    <?php } else if($values['modelo'] == 1){ ?>
                    <input type="image" name="bt_editar_advanced" src="/media/images/icons/editar.gif" title="editar" id="<?php echo $values['id'] ?>"/>
                    <?php } else {?>
                    <input type="image" name="bt_editar_mix" src="/media/images/icons/editar.gif" title="editar" id="<?php echo $values['id'] ?>"/>
                    <?php } ?>
                </td>                
            </tr>
            <?php $i++; if($color == "1"){$color = "0"; }else{$color = "1";};}}  else { ?>
            <tr align="center">
                <td height="30" >
                    <b>Não existem páginas cadastradas para esse tipo de dispositivo no sistema atualmente.</b>
                </td>
            </tr>
            <tr><td></td></tr>
            <?php } ?>
        </table>
        <p>&nbsp</p>
        <div class="container_qtd_users"><b>Quantidade de páginas deste dispositivo: </b> <?php echo $i ?></div>
    </div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right"></div>
</div>
<input type="hidden" value="paginas" id="admin_local"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>