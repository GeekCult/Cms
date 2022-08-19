<div id="topPanAdmin">
    <div class="logo_main"></div>    
    <div class="header_background_admin">
        <div id="buttons-device-support">
            <div class="container_macs">
                <?php if(isset($this->all['canal']['qtd_all']) && $this->all['canal']['qtd_all'] > 0){ ?><div class="bb_avisos"><div id="bbMain" class="bubble bt_bubbles pointer" title="Você tem avisos não lidos, clique no rodapé"><p><?php echo $this->all['canal']['qtd_all'] ?></p></div></div><?php } ?>
                <div class="divider_vertical hide"></div>
                <a href="/?KeepThis=true&TB_iframe=true&height=800&width=1024&device=desktop" class="fancybox hide">
                    <div class="icon_imac pp-edit-layout_desktop iframe right" title="Versão desktop"></div>
                </a>
                <a href="/?KeepThis=true&TB_iframe=true&height=760&width=1000&device=ipad" class="fancybox hide">
                    <div class="icon_ipad pp-edit-layout_ipad iframe right" title="Versão iPad"></div>
                </a>
                <a href="/?KeepThis=true&TB_iframe=true&height=462&width=300&device=iphone" class="fancybox hide">
                    <div class="icon_iphone pp-edit-layout_iphone iframe right" title="Versão iPhone"></div>
                </a>                
            </div>
        </div>
    </div>
</div>
