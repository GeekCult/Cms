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
    <div class="layoutGaleria">  
        <div class="layoutLogos" id="images_support">
            <div id="Searchresult">
            <?php foreach ($content as $values) { ?>
                <?php if( $values['id'] != ""){ ?>
                <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                    <div class='containerFotos'>
                        <img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" alt="" width='<?php echo $values['width'] ?>' height='<?php echo $values['height'] ?>' title="<?php echo $values['titulo'] ?>" style="<?php echo $values['margin'] .  $values['height']?>"/>
                    </div>
                    <div class='excluirFotos'>
                        <div class='imageExcluir'>
                            <a class="bt_remover" href='#' title='excluir' id="<?php echo $values['id'] ?>" name="<?php echo $values['foto'] ?>">
                               <img alt="" src='/media/images/icons/excluir.gif'/>
                            </a>
                        </div>
                        <div class='bt_editarFotos'>
                            <a title="editar" href="/admin/images/editar/<?php echo $values['id'] ?>">
                                <img src='/media/images/icons/editar.gif' alt=""/>
                            </a>
                        </div>
                        <div class='bt_editarFotos'>
                            <a class='fancybox' title="<?php echo $values['titulo'] ?>" href="/media/user/images/original/<?php echo $values['foto'] ?>">
                                <img src='/media/images/icons/ver.png' alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }} ?>
            <input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
            </div>
        </div>
    </div>
</div>
<div id="Pagination">Falhou carregamento!</div>
<div class="clear"></div>
<input type="hidden" id="helper" value="<?php echo $id_page ?>"/>
<input type='hidden' id="file" value="listar"/>
<input type="hidden" id="local_page" value="images"/>
<?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
<div class="clear"></div>
<p>&nbsp;</p><p>&nbsp;</p>
<script type="text/javascript">initImages2();initPagination();initImagesListeners();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>