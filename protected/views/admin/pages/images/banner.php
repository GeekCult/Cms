<?php include Yii::app()->getBasePath() . '/languages/portugues/language_portugues.php'; ?>
<script type="text/javascript" src="/js/admin/images.js"></script>
<script type="text/javascript" src="/js/lib/jquery.pagination.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <h1>Listagem de fotos</h1>
    </div>
    <div class="bt_rigth">
        <a href="novo">adicionar fotos</a>
    </div>
    <form action="">
        <div class="combo_cat_launcher">
            <span class="label_text">Escolha o álbum</span>
            <select name="album" class="combo_cat" size="1" onChange="if (this.value != 0) {document.form_album.submit();};" >
                <option value="" selected="selected">Nenhum</option>
                <? foreach ($content as $values) { ?>
                    <option value=""></option>
                <? } ?>
            </select>
        </div>
    </form>
</div>
<div class="layoutGaleria">
    <?php $slotUsed = "foto_01"; ?>
    <div class="layoutLogos">
        <div id="Searchresult">
        <?php foreach ($content as $values) { ?>
            <?php if( $values['id'] != ""){ ?>
            <div id="image_support">
                <div class='imageFotos'>
                    <div class='containerFotos'>
                        <img src="/media/user/images/<?php echo $values['foto'] ?>" width='120' height='120' alt="" title=""/>
                    </div>
                    <div class='excluirFotos'>
                        <div class='imageExcluir'>
                            <a href='' title='exclui'
                               <img alt="" src='/media/images/icons/excluir.gif'/>
                            </a>
                        </div>
                        <div class='bt_editarFotos'>
                            <a class='fancybox' title="<?php echo $values['titulo'] ?>" href="/media/user/images/<?php echo $values['foto'] ?>">
                                <img src='/media/images/buttons/bt_eye.png' alt=""/>
                            </a>
                        </div>
                        <div class='bt_checkBox'>
                            <div class='text_selecione'>Sel:</div>
                            <input type='checkbox' name="<?php echo $values['id_page'] ?>" value="<?php echo $values['foto'] ?>" id="check_select" alt="<?php if($values['slotUsed']){ echo $values['slotUsed']; $slotUsed = $values['slotUsed'];}?>" <?php if($values['slotUsed']){?> checked <?php } ?> />
                        </div>
                    </div>
                </div>
            </div>
        <?php } }?>
        </div>
    </div>
</div>
<div id="Pagination"></div>
<input type="hidden" id="helper" value="<?php echo $id_page ?>" title="<?php echo $content[0]['slotLastUsed'];?>"/>
<div class="buttons_right">
    <div class="bt_rigth">
        <input type="button" class="noform" id="bt_define" value="<?php echo $common_button_define ?>" />
    </div>
</div>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>