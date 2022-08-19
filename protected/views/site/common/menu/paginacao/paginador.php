<div class="ctn_paginador_items" id="btPanel_<?php if(isset($preferences['pagination']))echo $preferences['pagination'] ?>">
    <?php if($paginacao['items'] > 1) { ?>
    <div class="ctn_pag_records_total"><b>Registros - </b> <?php if($paginacao['total_records_viewed'] >= $paginacao['total_records']){$pfg = $paginacao['total_records'];}else{$pfg = $paginacao['total_records_viewed'];} echo $pfg . " | " . $paginacao['total_records'] ?> </div>
    <?php } ?>
    <?php if($paginacao['items'] > 1) { ?>
    <div class="ctn_it_pag">
        <?php if($paginacao['ind'] > 1) { ?><a href="<?php if(isset($paginacao['isGet'])){echo $paginacao['link'] . ($paginacao['ind'] - 1);}else{echo $paginacao['link'] . "/" . ($paginacao['ind'] - 1);} ?>"><?php } ?> 
            <div class="item_paginador" id="anterior">
                <div class="text_it_pag">Anterior</div>
            </div>
        <?php if($paginacao['ind'] > 1) { ?></a><?php } ?>
    </div>
    <?php for($i = $paginacao['begin']; $i <= $paginacao['final']; $i++){ ?>
    <div class="ctn_it_pag pointer">
        <div class="item_paginador <?php if($paginacao['ind'] == $i) echo "active"; ?>" id="<?php if(isset($paginacao['isGet'])){echo $paginacao['link'] . $i;}else{echo $paginacao['link'] . "/" . $i;} ?>">
            <div class="text_it_pag"><?php echo $i ?></div>
        </div>
    </div>
    <?php } ?>
    <div class="ctn_it_pag">
        <?php if($paginacao['ind'] < $paginacao['items']) { ?><a href="<?php if(isset($paginacao['isGet'])){echo $paginacao['link'] . ($paginacao['ind'] + 1);}else{echo $paginacao['link'] . "/" . ($paginacao['ind'] + 1);} ?>"><?php } ?>
        <div class="item_paginador" id="proximo">
            <div class="text_it_pag">Próxima</div>
        </div>
        <?php if($paginacao['ind'] < $paginacao['items']) { ?></a><?php } ?>
    </div>
    <?php } ?>
    <?php if($paginacao['items'] > 1) { ?>
    <div class="ctn_pag_total"><b>Páginas - </b> <?php echo $paginacao['ind'] . " | " . $paginacao['items'] ?> </div>
    <?php } ?>
</div>