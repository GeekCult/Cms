
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Market Places</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <div class="clear"></div>
            
               
        <div class="table_support">
            <h2><?php echo Yii::t("adminForm", "common_details") ?></h2> 
            <p>&nbsp;</p>
            <h3>Produto: <?php echo $content['nome'] ?></h3>
            <p>&nbsp;</p>
            <table border="0" align="center" cellpadding="1" cellspacing="2" width="100%">
                <tr class="title_table">
                    <td width="1%"  ></td>
                    <td width="89%" ><?php echo Yii::t("adminForm", "common_menu_name") ?></td>
                    <td width="10%"  align="center" colspan="4"><?php echo Yii::t("adminForm", "common_menu_edit") ?></td>
                </tr>                
                <tbody>    
                    <?php $market_places = array('submarino', 'extra'); ?>
                    <?php foreach($market_places as $values){ ?>
                    <tr id="container_" class="rows_table_0">
                        <td align="center"><img alt="" src="/media/images/icons/icon_mais.png" width="20" height="20" /></td>
                        <td style="font-weight: bold; text-transform: capitalize"><?php echo $values ?></td>        
                        <td align="center"><input type="button" data-id="<?php echo $content['id'] ?>" data-action="ver_produto" value="ver produto" data-place="<?php echo $values ?>"/></td>
                        <td align="center"><input type="button" data-id="<?php echo $content['id'] ?>" data-action="atualizar" value="atualizar" data-place="<?php echo $values ?>"/></td>
                        <td align="center"><input type="button" data-id="<?php echo $content['id'] ?>" data-action="vendas" value="vendas" data-place="<?php echo $values ?>"/></td>
                        <td align="center"><input type="button" data-id="<?php echo $content['id'] ?>" data-action="publicar" value="publicar" data-place="<?php echo $values ?>"/></td>
                    </tr>
                    <?php } ?>
                </tbody>                
            </table>
        </div>
    
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
    <div class="buttons_right">        
        <input type="button" class="bt_right" id="bt_update" value="<?php echo Yii::t("adminForm", "button_common_update"); ?>" />     
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo Yii::t("adminForm", "button_common_clear"); ?>"/>        
    </div>
    <div class="clear height_support"></div>    
    <input id="helper_action" type="hidden" value="gerenciar"/>
</div>

<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>