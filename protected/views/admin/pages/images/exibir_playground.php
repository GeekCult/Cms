<script type="text/javascript" src="/js/admin/images.js"></script>
<div class="header_purple_store">
    <div class="logo_pp_header"></div>
</div>
<div class="container_pan">
    <div class="titleContent">
        <div class="combo_categorias_fotos_listar">
            <div class="container_title_fancy">
                <span class="label_text_tab">Suas Fotos</span>
            </div>
        </div>
        <a class="" href="/admin/cool/<?php echo $type_images ?>/0/3" title="carregar Cool Images">
        <div class="container_categorias_option">
            <div class="container_title_fancy">
                <span class="label_text_tab_option">Cool</span>
            </div>
        </div>
        </a>
    </div>
    <div class="container_properties_fancy">        
        
    </div>
    <div class="divider-fancybox"></div>
</div>
<div id="ItemManager">
    <div class="layoutGaleria">
        <div class="layoutLogos" id="images_support">
            <div id="Searchresult">
            <?php if(count($content) > 0){ ?>
            <?php foreach ($content as $values) { ?>
            <?php if( $values['foto'] != ""){ ?>
            <div class="imageFotos">
                <div class='containerFotos'>                        
                    <?php if($type_images == "images" || $values['tipo'] == "playground"){ ?>
                    <input type="button" class="container_empty" alt="<?php echo $values['tipo'] ?>" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['foto'] ?>" name="<?php echo $values['id'] ?>"/>
                    <?php }else {?>
                    <div id="bt-size-p"><input value="" type="button" name="p" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-m"><input value="" type="button" name="m" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-g"><input value="" type="button" name="g" id="<?php echo $values['foto'] ?>"/></div>
                    <div id="bt-size-j"><input value="" type="button" name="j" id="<?php echo $values['foto'] ?>"/></div>
                    <?php } ?>                   
                    <img class="container_img" src="/media/user/images/purplecanvas/thumbs/<?php echo $values['foto'] ?>" alt="" title="<?php echo $values['titulo'] ?>" id="<?php echo $values['foto'] ?>" width="120"/>                                       
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
                <input type="hidden" id="helper_records" value="<?php echo $content['records'] ?>"/>
            <?php }else{ ?>
                <div class="message_result">Você não tem nenhuma foto cadastrada ainda!</div>
            <?php } ?>           
            </div>
        </div>
    </div>
</div>
<?php if(count($content) > 0){ ?><div id="Pagination">Falhou carregamento!</div><?php } ?>
<input type="hidden" id="helper" value="<?php echo $id_page ?>"/>
<input type='hidden' id="file" value="listar"/>
<input type="hidden" id="local_page" value="images"/>
<input type="hidden" id="helper_type_images" value="<?php //echo $type_images ?>"/>
<script type="text/javascript">initPagination();initImagesFancy();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>
<!-- It's used inside a iframe, because it's using a parent. -->
<script type="text/javascript"> 
 
    $("#ItemManager :button").click(function(e) {
       
        //alert("T:  " + this.id + this.name + this.title + "f");
        //Argument f is the first letter from foto
        <?php if(!$id_page){ ?>
            <?php if($type_images == "galeria"){ ?>            
                parent.addImageStuff(this.id, this.name, this.title, $(this).attr("alt"));
            <?php  }else{ ?>                
                <?php if(!$is_user){ ?>
                parent.addImageSlots(this.id, this.name, this.title, "f");
                <?php } else{?>
                parent.addImageStuff(this.id, this.name, this.title, "f");
                <?php } ?>
            <?php   } ?>
        <?php }else{?>
            
            parent.addImageStuff(this.id, this.name);
        <?php }?>
    });
     
        
</script>


