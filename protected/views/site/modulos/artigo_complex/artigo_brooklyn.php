<div id="artigo_brooklyn_<?php echo $id ?>" class="fullCP">
    <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
    <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
    <div class="row-fluid no-link-decoration">
        <div class="container fullCT">
            <?php if($qtd_blocos == 1){ ?>
            <div class="row-fluid">
                <div class="grid <?php if(isset($extra['composite_layout_1']) && $extra['composite_layout_1'] != ''){ echo $extra['composite_layout_1'];}else{echo "cs-style-1";} ?>">
                    <div class="span12 pp_square_bg mgB">                        
                        <figure>
                            <img id="slot_picture<?php echo $id ?>" src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_1 != '0') echo $titulo_1 ?></h3>
                                    <span class="dItem"><?php if($subtitulo_1 != '0') echo $subtitulo_1 ?></span>
                                    <a class="fgHref" href="<?php if($item1_link_1 != '') echo $item1_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>  
                </div>
            </div>
            <?php } ?>

            <?php if($qtd_blocos == 2){ ?>
            <div class="row-fluid">
                <div class="grid <?php if(isset($extra['composite_layout_1']) && $extra['composite_layout_1'] != ''){ echo $extra['composite_layout_1'];}else{echo "cs-style-1";} ?>">
                    <div class="span6 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_1 != '0') echo $titulo_1 ?></h3>
                                    <span class="dItem"><?php if($texto_1 != '0') echo $texto_1 ?></span>
                                    <a class="fgHref" href="<?php if($item1_link_1 != '') echo $item1_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span6 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_2 ?>" alt="<?php echo $image_2 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_2 != '0') echo $titulo_2 ?></h3>
                                    <span class="dItem"><?php if($texto_2 != '0') echo $texto_2 ?></span>
                                    <a class="fgHref" href="<?php if($item2_link_1 != '') echo $item2_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>

            <?php } ?>

            <?php if($qtd_blocos == 3){ ?>
            <div class="row-fluid">
                <div class="grid <?php if(isset($extra['composite_layout_1']) && $extra['composite_layout_1'] != ''){ echo $extra['composite_layout_1'];}else{echo "cs-style-1";} ?>">
                    <div class="span4 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image. $image_1 ?>" alt="<?php echo $image_1 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_1 != '0') echo $titulo_1 ?></h3>
                                    <span class="dItem"><?php if($texto_1 != '0') echo $texto_1 ?></span>
                                    <a class="fgHref" href="<?php if($item1_link_1 != '') echo $item1_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span4 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image .$image_2 ?>" alt="<?php echo $image_2 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_2 != '0') echo $titulo_2 ?></h3>
                                    <span class="dItem"><?php if($texto_2 != '0') echo $texto_2 ?></span>
                                    <a class="fgHref" href="<?php if($item2_link_1 != '') echo $item2_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span4 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_3 ?>" alt="<?php echo $image_3 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_3 != '0') echo $titulo_3 ?></h3>
                                    <span class="dItem"><?php if($texto_3 != '0') echo $texto_3 ?></span>
                                    <a class="fgHref" href="<?php if($item3_link_1 != '') echo $item3_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>

            <?php } ?>

            <?php if($qtd_blocos == 4){ ?>
            <div class="row-fluid">

                <div class="grid <?php if(isset($extra['composite_layout_1']) && $extra['composite_layout_1'] != ''){ echo $extra['composite_layout_1'];}else{echo "cs-style-1";} ?>">
                    <div class="span3 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_1 != '0') echo $titulo_1 ?></h3>
                                    <span class="dItem"><?php if($texto_1 != '0') echo $texto_1 ?></span>
                                    <a class="fgHref" href="<?php if($item1_link_1 != '') echo $item1_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span3 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_2 ?>" alt="<?php echo $image_2 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_2 != '0') echo $titulo_2 ?></h3>
                                    <span class="dItem"><?php if($texto_2 != '0') echo $texto_2 ?></span>
                                    <a class="fgHref" href="<?php if($item2_link_1 != '') echo $item2_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span3 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_3 ?>" alt="<?php echo $image_3 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_3 != '0') echo $titulo_3 ?></h3>
                                    <span class="dItem"><?php if($texto_3 != '0') echo $texto_3 ?></span>
                                    <a class="fgHref" href="<?php if($item3_link_1 != '') echo $item3_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="span3 pp_square_bg mgB">                        
                        <figure>
                            <img src="<?php echo $path_image . $image_4 ?>" alt="<?php echo $image_4 ?>" />
                            <figcaption>
                                    <h3 class="tItem"><?php if($titulo_4 != '0') echo $titulo_4 ?></h3>
                                    <span class="dItem"><?php if($texto_4 != '0') echo $texto_4 ?></span>
                                    <a class="fgHref" href="<?php if($item4_link_1 != '') echo $item4_link_1 ?>">Saiba mais &raquo;</a>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>