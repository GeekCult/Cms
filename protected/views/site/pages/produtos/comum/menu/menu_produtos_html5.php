<div class="main_menu_store" id="menu_ecommerce_support">
    <div class="main_menu_store_top"></div>
    <div class="main_menu_store_middle list-group">        
        <?php if(count($menu_ecommerce)){ ?>
        <div class="container_menu_total_items ">
            <?php foreach ($menu_ecommerce as $values){ ?>
                <div class="menu_item_ecommerce list-group-item <?php if($bread_crumb['cat'] == $values['categoria_url']) echo 'active'; ?>">
                    <?php if($menu_produtos_tipo == 'link' || count($values['menu_subcategoria']) == 0){ ?>
                    <a href="/produtos/<?php echo $values['categoria_url'] ?>" class="menu_item_cat bold <?php if(count($values['menu_subcategoria']) > 0) echo "parent"; ?>" id="cat_c<?php echo $values['id_categoria'] ?>"><?php echo $values['categoria_label'] ?> </a>
                    <?php }else{ ?>
                    <div class="menu_item_cat pointer bt_cat_retratil bold parent" id="cat_c<?php echo $values['id_categoria'] ?>" data-id="<?php echo $values['id_categoria'] ?>"><?php echo $values['categoria_label'] ?> </div>
                    <?php } ?>
                    <div id="cat_items_c<?php echo $values['id_categoria'] ?>" class="<?php if(($values['categoria_url'] != $bread_crumb['cat']) || count($values['menu_subcategoria']) == 0 ){?>menu_support_items<?php } ?> subcat_items">
                    
                    <?php $p = 0;foreach ($values['menu_subcategoria'] as $subvalues) { ?>
                        <?php if($p == 0){ ?><hr class="half2" /><div class="item_height"></div><?php }?>
                        
                        <?php if($menu_produtos_tipo == 'link' || count($subvalues['menu_subitem']) == 0){ ?>
                        <a href="/produtos/<?php echo $values['categoria_url']. "/" .$subvalues['subcategoria_url'] ?>"><div class="menu_item_subcat bold <?php if(count($subvalues['menu_subitem']) > 0) echo 'parent' ?>" id="subcat_s<?php echo $subvalues['id_subcategoria'] ?>"><?php echo $subvalues['subcategoria_label'] ?></div></a>
                        <?php }else{ ?>
                        <div class="menu_item_subcat bt_subcat_retratil parent" id="subcat_s<?php echo $subvalues['id_subcategoria'] ?>" data-id="<?php echo $subvalues['id_subcategoria'] ?>"><?php echo $subvalues['subcategoria_label'] ?></div>
                        <?php } ?>
                        <div class="clear"></div>
                        <hr class="half2" />
                        <div id="subcat_items_s<?php echo $subvalues['id_subcategoria'] ?>" class="<?php if($subvalues['subcategoria_url'] != $bread_crumb['subcat']){?>menu_support_items<?php } else{echo "display-none"; } ?>">
                        <?php foreach ($subvalues['menu_subitem'] as $subitem) { ?>
                            <a href="/produtos/<?php echo $values['categoria_url']. "/".$subvalues['subcategoria_url']."/".$subitem['subitem_url'] ?>"><div class="menu_item_subitem"><?php echo $subitem['subitem_label'] ?></div></a>
                            <div class="clear"></div>
                            <hr class="half2" />
                        <?php } ?>
                        </div>
                        
                    <?php $p++;} ?>  
                        
                    </div>                   
                </div>
            <?php }?>
            <!--<div class="menu_item_ecommerce_no_border">&nbsp;</div> -->
        </div>
        <?php } ?>
    </div>
    <div class="clear"></div>
    <div class="main_menu_store_bottom"></div>    
</div>