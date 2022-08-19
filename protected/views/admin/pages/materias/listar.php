<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo $attributes['title'] ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/<?php echo $attributes['controller'] ?>/novo">
        <input name="Cadastrar" type="button" class="bt_right" id="Cadastrar" value="<?php echo Yii::t("adminForm", "button_common_new") ?>" />
    </a>
    <div class="clear"></div>
    <div class="comboboxSelector_giant left">
        <div class="<?php if($status) echo "hide"?>">
            <label for="categoria" class="filtro_pos"><?php echo Yii::t("adminForm", "title_common_filter") ?></label>
            <div class="left mgR0 hide">
                <select id='filtro_dia' class='styled' name='filtro_dia'>
                    <?php foreach ($days as $value) { 
                        $value = $value['day']; ?>
                        <option value='<?php echo $value; ?>' <?php if ($day == $value) echo 'selected' ?>><?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="left mgR0">
                <div class="styled-select">
                    <select id="filtro_mes" name='filtro_mes'>
                        <option value="0" <?php  if ($month == '') echo 'selected' ?>>Selecione um mês</option>
                        <?php foreach ($months as $value) { ?>
                            <option value="<?php echo $value['value']; ?>" <?php  if ($month == $value['value']) echo 'selected' ?>><?php echo $value['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="left mgR0">
                <div class="styled-select-small">
                    <select id="filtro_ano" name='filtro_ano'>
                        <option value="0" <?php  if ($years == '') echo 'selected' ?>>Selecione um ano</option>
                        <?php foreach ($years as $value) { 
                            $value = $value['year']; ?>
                            <option value="<?php echo $value; ?>" <?php  if ($year == $value) echo 'selected' ?>><?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="container_links_fechados">
            <a href="/admin/<?php echo $attributes['controller'] ?>/listar"  class="<?php if(!$status) echo "a_focus"?>"><?php echo Yii::t("adminForm", "title_common_filter"); ?></a>
            <label>|</label>
            <a href="/admin/<?php echo $attributes['controller'] ?>/todos" class="<?php if($status) echo "a_focus"?>"><?php echo Yii::t("adminForm", "title_common_all"); ?></a>
        </div>
    </div>
    <div class="contentLine right">
        <a href="/site/purplestore/exibe_conteudo/noticias" class="fancybox-purplestore iframe">
            <div class="bt_comprar_pp left" title="comprar conteúdo"></div>
        </a>
    </div>
    <div class="clear"></div>
    <div class="table_support">
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">  
            <tr class="title_table">
                <td width="1%"></td>
                <td width="1%" align="center"><?php echo Yii::t("adminForm", "common_menu_id") ?></td>
                <td width="20%"><?php echo Yii::t("adminForm", "common_menu_title") ?></td>
                <?php if($attributes['controller'] == "colunas"){ ?><td width="28%" >Keywords</td><?php } ?>
                <td width="10%"align="center"><?php echo Yii::t("adminForm", "common_menu_last_update") ?></td>
                <td width="5%"align="center"><?php echo Yii::t("adminForm", "common_views") ?></td>
                <td width="1%" colspan="3" align="center"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>             
            </tr>
            <?php $i=0;if($content){$color = "0"; foreach($content as $values){?>
            <tr id="obj_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td align="center"><div class="item_materia_listar legend"><?php echo $values['id'] ?></div></td>
                <td><div class="item_materia_listar"><?php echo $values['titulo'] ?></div></td>
                <?php if($attributes['controller'] == "colunas"){ ?><td><?php echo $values['keywords'] ?></td><?php } ?>                
                <td align="left"><?php echo $values['last_update'] ?></td>
                <td align="center"><?php echo $values['views'] ?></td>
                <td align="center"><a href="/site/publicar" class="fancybox-publicar iframe"><input type="button" id="bt_speaker" name="<?php echo $values['id'] ?>" title="Corneta: publicar, compartilhar e vender"/></a></td>
                <td align="center"><input type="button" id="bt_edit" name="<?php echo $values['id'] ?>" title="editar"/></td>
                <td align="center"><input type="button" id="bt_delete" name="<?php echo $values['id'] ?>" title="excluir"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";}; $i++;} } else{ ?>
            <tr align="center" class="rows_table_0">
                <td height="30" align="center" colspan="6">
                    <div class="text_center bold">
                    <?php echo Yii::t("adminForm", "materias_page_list_message") ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <p>&nbsp</p>
        <div class="container_qtd_users"><b>Quantidade de materias: </b> <?php echo $i ?></div>
    </div>
    <div class="clear"></div>
    <input id="helper_tipo" type="hidden" value="<?php echo $attributes['controller'] ?>" />
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">
        <input name="show" class="bt_right" type="button" id="" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
    </div>
</div>
<input type="hidden" id="helper_type_publish" value="noticias"/>
<input type="hidden" id="helper_type_content" value="<?php echo $attributes['controller'] ?>"/>
<input type="hidden" id="helper_type_id" value=""/>
<script type="text/javascript">setListenerListArticles();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>