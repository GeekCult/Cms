<script type="text/javascript" src="/js/admin/images.js"></script>
<script type="text/javascript" src="/js/lib/jquery.pagination.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <h1>Listagem de fotos</h1>
    </div>    
    <a href="novo">
        <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", "button_common_add_picture") ?>" />
    </a>
    <form action="">
        <div class="combo_categorias_fotos_listar">
            <span class="label_text">Escolha o álbum</span>
           
            <a href="/admin/images/listar" class="">Normal</a>
        </div>
    </form>
</div>
<div id="ItemManager">
    <div class="layoutGaleria">
         <?php $i = 1;?>
        <div class="layoutLogos" id="images_support">
            <div id="Searchresult">
            <?php if(count($content > 1)) { foreach ($content as $values) { ?>
                <?php if( $values['id'] != ""){ ?>
                <?php $urlFlash = $values["cor"]."&block=".$values["modelo"]."&isAdmin=fancy". "&stage_size=" . $stage_size .$values["cool"]."&local=".$local."&path_customize=/media/swf/banners/".$link;?>
                <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                    <div class='containerFotos'>
                        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                            codebase="http://download.adobe.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"
                            width="<?php echo $values['largura'] ?>" height="<?php echo $values['altura'] ?>">
                            <param name="movie" value="/media/swf/banners/base6.swf">
                            <param name="quality" value="high">
                            <param name="wmode" value="transparent"/>
                            <param name="FlashVars" value="<?php echo $urlFlash ?>"/>
                            <embed src="/media/swf/banners/base6.swf"
                               flashvars="<?php echo $urlFlash ?>" quality="high"
                               pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" type="application/x-shockwave-flash"
                               width="<?php echo $values['largura'] ?>" height="<?php echo $values['altura'] ?>">
                            </embed>
                        </object>
                    </div>
                    <div class='excluirFotos'>
                        <div class='imageExcluir'>
                            <a href='#' class="bt_remover_cool_image" title='excluir' id="<?php echo $values['id'] ?>">
                               <img alt="" src='/media/images/icons/excluir.gif'/>
                            </a>
                        </div>
                        <div class='bt_editarFotos'>
                            <a title="editar" href="/admin/banners/cool_image/editar/<?php echo $values['id'] ?>">
                                <img src='/media/images/icons/editar.gif' alt=""/>
                            </a>
                        </div>
                        <div class='bt_editarFotos'>
                            <a class='fancybox' title="<?php echo $values['id'] ?>" href="/media/images/user/<?php echo $values['id'] ?>">
                                <img src='/media/images/icons/ver.png' alt=""/>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } }}else{ ?>
            <div class="result-message">
                <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
            </div>
            <?php } ?>
            <input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
            </div>
        </div>
    </div>
</div>
<div id="Pagination">Falhou carregamento!</div>
<input type="hidden" id="helper" value=""/>
<input type='hidden' id="file" value="listar"/>
<div class="buttons_right">
    <input type="button" class="bt_right" id="bt_define" value="<?php echo Yii::t("adminForm", "button_common_define") ?>" />
</div>
<script type="text/javascript">initPagination();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>