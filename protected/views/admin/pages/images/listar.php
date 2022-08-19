<script type="text/javascript" src="/js/lib/jquery.pagination.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="support-logo"><h1><?php echo Yii::t("adminForm", "images_page_title_list") ?></h1></div>
        <div class="logo-flickr-disable" title="desativado"></div>
        <div class="bug_tracker iframe"></div>
    </div>    
    <a href="novo">       
        <input type="button" class="bt_right"  value="<?php echo Yii::t("adminForm", "button_common_new") ?>" /> 
    </a>
    <div class="clear"></div>
    <div class="comboboxSelector_giant mgB">
        <label class="filtro_pos"><?php echo Yii::t("adminForm", "images_page_label_album") ?></label>
        <div class="styled-select left">
            <select id="categoria" size="1" >
                <option value="todas"><?php echo Yii::t("adminForm", "title_common_every_one") ?></option>
                <?php foreach ($categorias as $values) { ?>
                <option value="<?php echo $values['id'] ?>"><?php echo $values['nome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="filtro_pos">
            <a href="/admin/images/cool" class=""><?php echo Yii::t("adminForm", "images_page_label_coolimages") ?></a>
        </div>
    </div>
    
</div>
<div id="ItemManager">
    <div class="table_support">
        <table border="0" align="center" cellpadding="2" cellspacing="4" width="100%">
            <tr class="title_table">
                <td width="1%"></td>
                <td width="1%" align="center"><?php echo Yii::t("adminForm", "common_menu_id") ?></td>
                <td width="5%" align="center"><?php echo Yii::t("adminForm", "common_menu_image") ?></td>
                <td width="20%"><?php echo Yii::t("adminForm", "common_menu_title") ?></td>
                <td width="40%"><?php echo Yii::t("adminForm", "common_menu_description") ?></td>
                <td width="1%" align="center" colspan="2"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
            </tr>
            <tbody id="Searchresult">
            <?php if($content){$color = "0"; foreach($content as $values){ if(isset($values['id']) && $values['id'] != ''){ ?>
            <tr id="img_container_<?php echo $values['id'] ?>" class="rows_table_<?php echo $color ?>">
                <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                <td><?php echo $values['id'] ?></td>
                <?php if($values['tipo'] == "playground"){ ?>
                <td align="center"><a href="/media/user/images/original/<?php echo $values['foto'] ?>" name="<?php echo $values['titulo'] ?>" class="fancybox"><img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" alt="" title="<?php echo $values['titulo'] ?>" width="50px"/></a></td>
                <?php } else if($values['tipo'] == "embeded"){ ?>
                <td align="center"><div style="position:relative; display: inline-block; width: 90px; height: 120px;"><?php echo $values['embeded'] ?></div></td>
                <?php } else{ ?>
                <td align="center"><a href="/media/user/images/original/<?php echo $values['foto'] ?>" name="<?php echo $values['titulo'] ?>" class="fancybox"><img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" alt="<?php echo $values['titulo'] ?>" title="<?php echo $values['titulo'] ?>"/></a></td>
                <?php } ?>
                <td><?php echo $values['titulo'] ?></td>
                <td><?php echo $values['descricao'] ?></td>
                <td align="center"><input type="button" id="<?php echo $values['id'] ?>" name="<?php echo $values['foto'] ?>" title="editar" class="bt_edit"/></td>
                <td align="center"><input type="button" id="<?php echo $values['id'] ?>" name="<?php echo $values['foto'] ?>" title="excluir" class="bt_delete"/></td>
            </tr>
            <?php if($color == "1"){$color = "0"; }else{$color = "1";}; }}} else{ ?>
            <tr class="rows_table_0"><td height="30" align="center" colspan="7" ><?php echo Yii::t("adminForm", "title_common_no_items") ?></td></tr>
            <?php } ?>
            </tbody>
        </table>        
    </div>
    <?php include Yii::app()->getBasePath() . '/views/site/common/menu/paginacao/paginador.php'; ?>
</div>

<div class="clear"></div>
<input type="hidden" id="helper" value="<?php echo $id_page ?>"/>
<input type='hidden' id="file" value="listar"/>
<input type="hidden" id="local_page" value="images"/>
<input type="hidden" id="helper_records" value="<?php if(isset($content['records'])) echo $content['records']; else echo "0"; ?>"/>
<?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
<div class="buttons_right">    
    <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />   
</div>
<script type="text/javascript">initImagesListListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>