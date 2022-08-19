<div class="layoutGaleria" data-item-content="item_grid">
    <div class="layoutLogos" id="images_support">
        <div id="Searchresult">
        <?php if(count($content) > 1){ foreach ($content as $values) { ?>
            <?php if( $values['id'] != ""){ ?>
            <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                <div class='containerFotos'>
                    <img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" width='<?php echo $values['width'] ?>' height='<?php echo $values['height'] ?>' alt="" title="" style="<?php echo $values['margin'] ?>" width="120"/>
                </div>
                <div class='excluirFotos'>
                    <div class='imageExcluir'>
                        <a class="bt_remover" id="<?php echo $values['id'] ?>" href='#' title='exclui'>
                           <img alt="" src='/media/images/icons/excluir.gif'/>
                        </a>
                    </div>
                    <div class='bt_editarFotos'>
                        <a title="editar" href="/admin/images/editar/<?php echo $values['id'] ?>">
                            <img src='/media/images/icons/editar.gif' alt=""/>
                        </a>
                    </div>
                    <div class='bt_editarFotos'>
                        <a class="fancybox" title="<?php echo $values['titulo'] ?>" href="/media/user/images/original/<?php echo $values['foto'] ?>">
                            <img src='/media/images/icons/ver.png' alt=""/>
                        </a>
                    </div>
                </div>
            </div>
            <?php }}}else{ ?>
            <div class="result-message">
                <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
<script type="text/javascript">initImagesListeners();</script>
<?php if(!$init) { ?>
<script type="text/javascript">initPagination()</script>
<?php } ?>