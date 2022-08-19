<?php for($i = 0; $i < count($headers); $i++){ ?>
<?php if($i == 0){ ?>
<div class="ctnItemAdv">
    <div class="ctnImgAdv mgB">
        <img id="mainBlockItem"src="/media/images/layout_block/<?php echo $headers[$i]['thumb'] ?>" alt="<?php echo $headers[$i]['thumb'] ?>" />
    </div>
    <div class="ctnLegendAdv">
        <h4 id="mainBlockTitulo"><?php echo $headers[$i]['titulo'] ?></h4>
        <p  id="mainBlockTexto"><?php echo $headers[$i]['descricao'] ?></p>
    </div>
</div>
<div class="ctnBt_aplly">
    <input type="button" class="botao bt_apply_block" id="bt_aplicar_component" value="aplicar" data-id_page="<?php echo $id_page ?>" data-id_component="<?php echo $headers[$i]['id'] ?>"/>
</div>
<?php } ?>
<div class="ctnItemAdvThumbs" data-id_item="<?php echo $headers[$i]['id'] ?>" data-titulo="<?php echo $headers[$i]['titulo'] ?>" data-descricao="<?php echo $headers[$i]['descricao'] ?>" data-image="<?php echo $headers[$i]['thumb'] ?>">
    <div class="ctnImgAdv mgB">
        <img src="/media/images/layout_block/<?php echo $headers[$i]['thumb'] ?>" alt="<?php echo $headers[$i]['thumb'] ?>" width="220" height="67"/>
    </div>
    <div class="ctnLegendAdvThumb">
        <div><?php echo $headers[$i]['titulo'] ?></div>
    </div>
</div>
<?php } ?>