<input type="hidden" id="helper_width" value="<?php echo $width_banner ?>"/>
<input type="hidden" id="helper_height" value="<?php echo $height_banner ?>"/>
<input type="hidden" id="helper_font" value="<?php echo $font_banner ?>"/>
<input type="hidden" id="helper_resize" value="<?php echo $resize_banner ?>"/>
<input type="hidden" id="helper_id_html_action" value="exibir" />
<link rel="stylesheet" type="text/css" href="/css/lib/cool/cool_html.css"/>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent">
        <div class="combo_categorias_fotos_listar">
            <div class="container_title_fancy">
                <span class="label_text_tab">Htmlbanners</span>
                <select id="categoria_fancy" class="styled" size="1" >
                    <option value="todas">Todas</option>
                    
                </select>
            </div>
        </div>
        <a class="" href="/admin/images/banner/0/9" title="carregar fotos">
            <div class="container_categorias_option">
                <div class="container_title_fancy">
                    <span class="label_text_tab_option">Fotos</span>                
                </div>
            </div>
        </a>
    </div>
    <div class="container_properties_fancy">
        <a class="bt_buy_stuff" href="/admin/images/adicionar" title="comprar mais cools"></a>
        <a class="bt_add_stuff" href="/admin/images/adicionar" title="adiciona cool"></a>
    </div>
    <div class="divider-fancybox"></div>
</div>
<div id="ItemManager">
    <div class="layoutGaleria">
        <div class="layoutLogos" id="html_banners_support">
            <div id="Searchresult">
            <?php foreach ($content as $values) { ?>
            <?php if( $values['tipo'] != ""){ ?>            
            <div class="banner_html_support" id="<?php echo $values['id'] ?>">
                <input  type="button" value="" class="bt_html_support" id="<?php echo $values["cool"]?>" name="<?php echo $values["id"] ?>"/>
                <div class="canvas_stage<?php echo $values["id"] ?>" id="stage"></div>
                <script type="text/javascript">addBannerHTML('<?php echo json_encode($values["cool2"])?>', '<?php echo $values["id"] ?>')</script>
                <script type="text/javascript">setSizeBannerFancyBox('<?php echo round($values["altura"]) ?>', '<?php echo round($values["largura"]) ?>', '<?php echo $values['id'] ?>');</script>
                <input type="hidden" id="helper_width<?php echo $values["id"] ?>" value="<?php echo round($values["largura_slot"]) ?>"/>
                <input type="hidden" id="helper_height<?php echo $values["id"] ?>" value="<?php echo round($values["altura_slot"]) ?>"/>
            </div>                           
            <?php }} ?>
            <input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
            </div>
        </div>
    </div>
</div>
<div id="Pagination">Falhou carregamento!</div>
<input type="hidden" id="helper_local" value="<?php echo $local ?>"/>
<input type="hidden" id="local_page" value="banners"/>
<input type="hidden" id="helper_font" value="5"/><?php // valor promorcional ao tamanho do slot tipo será divido 7 vezes ?>
<input type="hidden" id="helper_resize" value="8"/>
<script type="text/javascript">initPagination();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<!-- It's used inside a iframe, because it's using a parent. -->
<script language="javascript" type="text/javascript">
        
        $("#html_banners_support :button").click(function(e) {
              parent.applyCoolHtmlStuff(this.name, parent.$("#helper_id_slot").val());            
        });

</script>


