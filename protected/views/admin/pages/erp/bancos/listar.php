<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Listagem</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <div class="clear mgL2">
        <div class="">
            <label for="categoria" class="filtro_pos"><?php echo Yii::t("adminForm", "title_common_filter") ?></label>
            <div class="left mgR0 hide">
                <select id="list_year" rel="year" class="form-control">
                    <option value="0">Dia</option>
                    <?php for($i = 1; $i <= count(31); $i++){ ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mgR0" style="display: inline-block">
                <div class="styled-select left">
                    <select id="list_month" rel="month" >
                        <option value="0">Mês</option>
                        <option value="1" <?php  if($month == 1)  echo 'selected' ?>>Janeiro</option>
                        <option value="2" <?php  if($month == 2)  echo 'selected' ?>>Fevereiro</option>
                        <option value="3" <?php  if($month == 3)  echo 'selected' ?>>Março</option>
                        <option value="4" <?php  if($month == 4)  echo 'selected' ?>>Abril</option>
                        <option value="5" <?php  if($month == 5)  echo 'selected' ?>>Maio</option>
                        <option value="6" <?php  if($month == 6)  echo 'selected' ?>>Junho</option>
                        <option value="7" <?php  if($month == 7)  echo 'selected' ?>>Julho</option>
                        <option value="8" <?php  if($month == 8)  echo 'selected' ?>>Agosto</option>
                        <option value="9" <?php  if($month == 9)  echo 'selected' ?>>Setembro</option>
                        <option value="10"<?php  if($month == 10) echo 'selected' ?>>Outubro</option>
                        <option value="11"<?php  if($month == 11) echo 'selected' ?>>Novembro</option>
                        <option value="12"<?php  if($month == 12) echo 'selected' ?>>Dezembro</option>                
                    </select>
                </div>
                <div class="styled-select left mgL2"> 
                    <select id="list_year" rel="year">
                        <option value="0">Ano</option>
                        <option value="2012" <?php  if($year == '2012')  echo 'selected' ?>>2012</option>
                        <option value="2013" <?php  if($year == '2013')  echo 'selected' ?>>2013</option>
                        <option value="2014" <?php  if($year == '2014')  echo 'selected' ?>>2014</option> 
                        <option value="2015" <?php  if($year == '2015')  echo 'selected' ?>>2015</option> 
                        <option value="2016" <?php  if($year == '2016')  echo 'selected' ?>>2016</option> 
                    </select>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="ItemManager">
        <div class="table_support">
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <tr class="title_table">
                    <td width="1%"  class="title_table checkbox-column" id="autoId"><input value="1" name="autoId_all" id="autoId_all" type="checkbox" onchange="checkAll(this);"></td>
                    <td width="50%" class="title_table"><?php echo Yii::t('adminForm', 'common_title') ?></td>
                    <td width="14%" class="title_table"><?php echo Yii::t('adminForm', 'common_menu_last_update') ?></td>
                    <td width="10%" class="title_table"><?php echo Yii::t('adminForm', 'common_due') ?></td>
                    <td width="10%" align="center" class="title_table"><?php echo Yii::t('adminForm', 'common_value') ?></td>   
                    <td width="10%" align="center" class="title_table"><?php echo Yii::t('adminForm', 'common_status') ?></td>   
                    <td width="3%" class="edit_table" align="center" colspan="4"><?php echo Yii::t('adminForm', 'common_menu_edit') ?></td>
                </tr>
                <?php if($content['registros']){$color = "0"; $row = 0; foreach($content['registros'] as $values){?>
                <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                    <td class="checkbox-column"><input value="<?= $values['id'] ?>" id="autoId_<?= $row ?>" name="autoId[]" type="checkbox"></td>
                    <td alignt="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20"/></td>
                    <td><div class="truncate"><?php echo $values['titulo'] ?></div></td>
                    <td><?php echo $values['last_update_string'] ?></td>
                    <td><?php echo $values['date']  ?></td>                   
                    <td align="right"><?php echo $values['valor_string'] ?></td>
                    <td align="right"><?php echo $values['status_string'] ?></td>
                    <td align="center"><input type="button" class="bt_recuperacao bt_protestar" data-id="<?php echo $values['id'] ?>" title="protestar"/></td>
                    <td align="center"><input type="button" class="bt_resume bt_registrar" data-id="<?php echo $values['id'] ?>" title="registrar"/></td>
                    <td align="center"><a href="/admin/bancos/editar/<?php echo $values['id'] ?>"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></a></td>
                    <td align="center"><input type="button" id="bt_delete" class="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
                </tr>
                <?php if($color == "1"){$color = "0"; }else{$color = "1";}; $row++;  }} else{ ?>
                <tr class="rows_table_0">
                    <td height="30" align="center" colspan="7" >
                        <?php echo Yii::t("adminForm", "title_common_no_item") ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <p>&nbsp;</p><p>&nbsp;</p>
            <input type="button" class="botao" value="registrar vários" id="bt_register_many"/>
            <input type="button" class="botao" value="atualizar status" id="bt_update_status"/>
        </div>
    </div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input type="button" class="bt_right" id="bt_submit" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
    <div class="clear"></div>
    <p>&nbsp;</p><p>&nbsp;</p>
    <div class="clear"></div>
    <p>&nbsp;</p><p>&nbsp;</p>
    <input id="helper_action" type="hidden" class="form" value="" data-js-action="list"/>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>

