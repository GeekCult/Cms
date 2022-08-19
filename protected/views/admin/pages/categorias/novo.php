<script type="text/javascript" src="/js/admin/categorias.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1><?php echo Yii::t("adminForm", "category_page_title_new") ?></h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <a href="/admin/categorias/listar" id="bt_list">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_list") ?>"/>
    </a>
    <form action="">
        <fieldset class="adminFormContent">
            <ul>
                <li class="rows">
                   <p></p>
                </li>
                <li class="rows">                    
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "category_page_label_1") ?></div>
                    <div class="styled-select">
                        <select name="categoria" id="categoria" size="1" >                            
                            <?php foreach ($pages as $values) { ?>
                            <option value="<?php echo $values['id'] ?>" <?php if($values['id'] == $content['id_page']) echo " selected "; ?>><?php echo $values['label'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>
                <li class="rows">
                    <div class="label_text_Admin"><?php echo Yii::t("adminForm", "category_page_label_2") ?></div>
                    <div class="text half">
                        <input id="nome_categoria" type="text" class="form" value="<?php echo $content['nome'] ?>"/>
                    </div>
                </li>
                <li class="rows">
                   <p></p>
                </li>
            </ul>
        </fieldset>
        <div class="clear"></div>
        <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
        <div class="buttons_right">            
            <input type="button" class="bt_right" id="bt_submit" value="<?php if($action == "novo"){echo Yii::t("adminForm", "button_common_submit");}else{echo Yii::t("adminForm", "button_common_update");} ?>"/>
        </div>
    </form>
</div>
<input type="hidden" value="<?php echo $action ?>" id="helper_action"/>
<input type="hidden" value="<?php echo $id_album ?>" id="helper_id_categoria"/>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>