 <div class="layoutGaleria">
    <div class="layoutLogos" id="images_support">
        <div id="Searchresult">
            <?php foreach($content as $values){ ?>
            <div class="imageFotos" id="img_container_<?php echo $values['id'] ?>">
                <div class='containerFotos'>
                    <div style="background: url(/media/images/textures/<?php echo $local ?>/<?php echo $values["url_textura"] ?>); " class="fake_img_paginas" title="<?php echo $values["nome"] ?>" id="<?php echo $values['url_textura'] ?>" alt="paginas" data-tipo="<?php echo $values['tipo'] ?>" data-modelo="<?php echo $attributes['bg_type'] ?>"></div>
                </div>
            </div>            
            <?php } ?>
        </div>
    </div>
</div>
<input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
<?php if(!$init){ ?>
<script type="text/javascript">initPagination();</script>
<?php } ?>
<script type="text/javascript">
        //initFancy();
        $("#images_support .fake_img_paginas").click(function(e) {
            //alert($("#bg_type").val());
            if(parent.$("#helper_action").attr('data-canvas') == 'playground'){
                parent.addBackground($("#bg_type").val(), this.id, $(this).attr('data-modelo'), true);
            }else{
                parent.addBackground($("#bg_type").val(), this.id, $(this).attr('data-tipo'), true);
            }
            
        });
</script>
    
   
    
    