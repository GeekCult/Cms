<script type="text/javascript" src="/js/admin/texturas.js"></script>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent">
        <div class="combo_categorias_fotos_listar">
            <div class="container_title_fancy">
                <span class="label_text_tab">Fotos</span>
                <select id="categoria_fancy" class="styled" size="1" >                
                    <option value="site">Texturas</option>
                    <option value="detalhes">Detalhes</option>                    
                </select>
            </div>
        </div>
        <a class="" href="/admin/texturas/<?php echo $attributes['link'] ?>/exibir" title="carregar Detalhes">
        <div class="container_categorias_option">
            <div class="container_title_fancy">
                <span class="label_text_tab_option"><?php echo $attributes['title_tab'] ?></span>
            </div>
        </div>
        </a>
    </div>
    <div class="container_properties_fancy">        
        <a class="bt_buy_stuff" href="/admin/galeria/adicionar" title="comprar mais cools"></a>
        <a class="bt_add_stuff" href="/admin/galeria/adicionar" title="adiciona cool"></a>
        <a class="bt_remove_bg" href="#" title="remover background"></a>
    </div>
    <div class="divider-fancybox"></div>
</div>
<div id="ItemManager">
    <div class="layoutGaleria">
        <div class="layoutLogos" id="images_support">
            <div id="Searchresult">
            <?php foreach($content as $values){ ?>
                <?php if($values["url_textura"] != ""){ ?>
                <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                    <div class='containerFotos'>
                        <div style="background: url(/media/images/textures/<?php echo $values["local"] ?>/<?php echo $values["url_textura"] ?>); " class="fake_img_paginas" title="<?php echo $values["nome"] ?>" id="<?php echo $values['url_textura'] ?>" alt="paginas" data-tipo="<?php echo $values['tipo'] ?>" data-modelo="<?php echo $attributes['bg_type'] ?>"></div>
                    </div>
                </div>            
            <?php } }?>
            <input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
            </div>
        </div>
    </div>
</div>
<div id="Pagination">Falhou carregamento!</div>
<input type="hidden" id="helper" value="<?php echo $attributes['id_page'] ?>"/>
<input type='hidden' id="file" value="listar"/>
<input type="hidden" id="local_page" value="texturas/<?php echo $local ?>"/>
<input type="hidden" id="helper_type_images" value="images"/>
<input type="hidden" id="bg_type" value="<?php echo $attributes['bg_type'] ?>"/>
<script type="text/javascript">initImagesFancy();initPagination();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<!-- It's used inside a iframe, because it's used a parent. -->
<script language="javascript" type="text/javascript"> 
        $("#images_support .fake_img_paginas").click(function(e) {
            if(parent.$("#helper_action").attr('data-canvas') == 'playground'){
                parent.addBackground($("#bg_type").val(), this.id, $(this).attr('data-modelo'), true);
            }else{
                parent.addBackground($("#bg_type").val(), this.id, $(this).attr('data-tipo'), true);
            }
            //alert($("#bg_type").val());
            
        });
        
        /*
         * Bind background transparent
         */
        $('.bt_remove_bg').bind('click', function(){
            parent.addBackground(0, "transparent.png", 0, true);
        });
</script>


