<?php $p = 0; $l=1; for($i = 0; $i < count($blocks); $i++){ ?>
<?php if($i == 0){ ?>
<div class="ctnItemAdv">
    <div class="ctnImgAdv mgB">
        <img id="mainBlockItem"src="/media/images/layout_block/<?php echo $blocks[$i]['thumb'] ?>" alt="<?php echo $blocks[$i]['thumb'] ?>" />
    </div>
    <div class="ctnLegendAdv">
        <h4 id="mainBlockTitulo"><?php echo $blocks[$i]['titulo'] ?></h4>
        <p  id="mainBlockTexto"><?php echo $blocks[$i]['descricao'] ?></p>
    </div>
</div>
<div class="ctnBt_aplly">
    <input type="button" class="botao bt_apply_block" id="bt_aplicar_component" value="aplicar" data-id_page="<?php echo $page_attributes ?>" data-id_component="<?php echo $blocks[$i]['id'] ?>"/>
</div>

<div class="sliderP">
    <ul>
        
<?php } ?>
    
<?php if($p == 0){ ?>
<li>
<?php $l++;} ?>

<div class="ctnItemAdvThumbs" data-id_item="<?php echo $blocks[$i]['id'] ?>" data-titulo="<?php echo $blocks[$i]['titulo'] ?>" data-descricao="<?php echo $blocks[$i]['descricao'] ?>" data-image="<?php echo $blocks[$i]['thumb'] ?>" data-type="Block">
    <div class="ctnImgAdv mgB">
        <img src="/media/images/layout_block/<?php echo $blocks[$i]['thumb'] ?>" alt="<?php echo $blocks[$i]['thumb'] ?>" width="220" height="67"/>
    </div>
    <div class="ctnLegendAdvThumb">
        <div><?php echo $blocks[$i]['titulo'] ?></div>
    </div>
</div>

<?php $p++; if($p == 4){ ?>
</li>
<?php }  if($p >= 4)$p=0; ?>


<?php if($i == count($blocks) -1){ ?>
        
    </ul>
</div>
<div class="ctnBtBlcLeft"><a href="javascript:sliders[0].goToPrev()"><input type="button" class="arrow-left"/></a></div>
<div class="ctnBtBlcRight"><a href="javascript:sliders[0].goToNext()"><input type="button" class="arrow-right"/></a></div>
<?php } ?>


<?php }?>
<script type="text/javascript">setTimeout(function(){$('.sliderP').each(function() {sliders.push(new Slider(this))});},1000);</script>
