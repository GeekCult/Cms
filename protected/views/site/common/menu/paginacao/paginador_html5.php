<div class="clear"></div>

<?php if(isset($paginacao['total']) && $paginacao['total'] > 1){ ?>
<hr class="half" />
<div class="ctn_paginador_items" id="btPanel_<?php if(isset($preferences['pagination']))echo $preferences['pagination'] ?>">
    <?php if($paginacao['items'] > 1) { ?>
    <div class="ctn_pag_records_total left texto"><b>Registros - </b> <?php if($paginacao['total_records_viewed'] >= $paginacao['total_records']){$pfg = $paginacao['total_records'];}else{$pfg = $paginacao['total_records_viewed'];} echo $pfg . " | " . $paginacao['total_records'] ?> </div>
    <?php } ?>
    
    <?php if($paginacao['items'] > 1) { ?>
    <div class="ctn_pag_total right texto"><b>Páginas - </b> <?php echo $paginacao['ind'] . " | " . $paginacao['items'] ?> </div>
    <?php } ?>
    
    
    
    <?php if($paginacao['items'] > 1) { ?>
    <div class="clear divider_shadow"></div>    
    <div class="pagination">
        <ul>
            <li>
                <a href="<?php if($paginacao['ind'] > 1) { if(isset($paginacao['isGet'])){echo $paginacao['link'] . ($paginacao['ind'] - 1);}else{echo $paginacao['link'] . "/" . ($paginacao['ind'] - 1);} } else {echo "#"; }?>" class="ctn_it_pag"> 
                    <div class="item_paginador" id="anterior">
                        <div class="text_it_pag">Anterior</div>
                    </div>
                </a>
            </li>
            
            <?php for($i = $paginacao['begin']; $i <= $paginacao['final']; $i++){ ?>
            <li <?php if($paginacao['ind'] == $i) echo "class='active'"; ?>>
                <span class="ctn_it_pag pointer item_paginador" id="<?php if(isset($paginacao['isGet'])){echo $paginacao['link'] . $i;}else{echo $paginacao['link'] . "/" . $i;} ?>">
                    <div class="text_it_pag"><?php echo $i ?></div>
                </span>
            </li>
            <?php } ?>

            <li>                
                <a href="<?php if($paginacao['ind'] < $paginacao['items']) { if(isset($paginacao['isGet'])){echo $paginacao['link'] . ($paginacao['ind'] + 1);}else{echo $paginacao['link'] . "/" . ($paginacao['ind'] + 1);}}else{echo "#";} ?>" class="ctn_it_pag">
                    <div class="item_paginador" id="proximo">
                        <div class="text_it_pag">Próxima</div>
                    </div>
               </a>            
            </li>

        </ul>
    </div>
    <?php } ?>
</div>
<?php } ?>