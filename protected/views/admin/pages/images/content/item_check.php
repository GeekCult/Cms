<script type="text/javascript" src="/js/admin/galeria.js"></script>
<?php foreach ($content as $values) { ?>
<?php if( $values['id'] != ""){ ?>
<div id="image_support" data-item-content="item_check">
    <div class='imageFotos'>
        <div class='containerFotos'>
            <img src="/media/user/images/thumbs_120/<?php echo $values['foto'] ?>" width='<?php echo $values['width'] ?>' height='<?php echo $values['height'] ?>' alt="" title="" style="<?php echo $values['margin'] ?>" width="120"/>
            <input type='hidden' id="img_<?php echo "ll" ?>" value="<?php echo $values['foto'] ?>"/>
        </div>
        <div class='excluirFotos'>
            <div class='imageExcluir'>
                <a href='#' class="bt_remover" title='excluir' id="<?php echo $values['id'] ?>">
                   <img alt="" src='/media/images/icons/excluir.gif'/>
                </a>
            </div>
            <div class='bt_editarFotos'>
                <a class='thickbox' title="<?php echo $values['titulo'] ?>" href="/media/user/images/original/<?php echo $values['foto'] ?>">
                    <img src='/media/images/buttons/bt_eye.png' alt=""/>
                </a>
            </div>
            <div class='bt_checkBox'>
                <div class='text_selecione'>Sel:</div>
                <input type='checkbox' name="<?php if($values['id_page']) echo $values['id_page'] ?>" value="<?php echo $values['foto'] ?>" id="check_select" alt="<?php if($values['slotUsed']){ echo $values['slotUsed']; }?>" <?php if($values['slotUsed']){?> checked <?php } ?> />
            </div>
        </div>
    </div>
</div>
<?php }} ?>
<script type="text/javascript">initGaleriaListeners();</script>