<div class="container_all_info_tips">    
    <div class="container_info_dicas">
        <div class="container_divider_info">
            <div class="divider_corner_left"></div>
            <div class="divider_corner_middle"></div>
            <div class="divider_corner_rigth"></div>
        </div>
        <div class="rows_dicas_bottom">
            <div class="conf_container_text_tip">
                <h5><?php echo $dicas['title'] ?></h5>
                <p class="conf_text_tip"><?php echo $dicas['subtitle1'] ?></p>
                <p class="conf_text_tip"><?php echo $dicas['subtitle2'] ?></p> 
                <p class="conf_text_tip"><?php echo $dicas['subtitle3'] ?></p>   
                <p class="conf_text_tip"><?php echo $dicas['subtitle4'] ?></p>   
            </div>
          
            <a href="/admin/howto/tags" class="fancy-how-to-tags" title="dicas de HTML" style="margin-right: 20px;">
                <div class="container-info-tags"></div>
            </a>
            <?php (isset($purplestore_item)) ? $link_purplestore = $purplestore_item : $link_purplestore = "componente_site";  ?>
            <a href="/admin/purplestore/exibe/<?php  echo $link_purplestore ?>" class="fancybox-purplestore" >
                <div class="container-buy-pp" title="comprar conteúdo"></div>
            </a>
            <a href="<?php echo $dicas['link'] ?>" class="fancybox-wiki hide">
                <div class="container-tip-pp" title="Ver dicas deste conteúdo"></div></a>
        </div>            
    </div>        
</div>