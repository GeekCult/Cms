<div id="orcamentus_dakota_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
        <?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false; ?>
        <?php if($local_place){$path_image = "http://dev.purplepier.com.br/media/user/images/clients/";}else{$path_image = "/media/user/images/original/";} ?> 
        <div class="container fullCT">
            <?php if($layout_1 == 'simple' || $layout_1 == ''){ ?>
            <form id="form_cp_orcamentus">
               <div class="squarebox">
                   <div class="content">
                       <?php if($image_1 != ''){ ?>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="thumbnails center">
                                    <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                                    <img id="slot_picture<?php echo $id ?>" src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                                    <?php if($link_1 != ''){ ?></a><?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                                    <div class="ctnArtTxt">
                                        <?php if($titulo_1 != ""){ ?>
                                        <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                                        <?php } ?>
                                        <?php if($subtitulo_1 != ""){ ?>
                                        <div class="clear"></div>
                                        <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                                        <?php } ?>
                                        <?php if($texto_1 != ""){ ?>
                                        <div class="clear"></div>
                                        <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                                        <?php } ?>
                                    </div>
                                </div>            
                            </div>        
                       </div>
                       <div class="row-fluid">                       
                           <div id="orcamentus_step_1">
                               <input type="text" placeholder="O que você precisa?" class="span12" id="orcamentus_cp_titulo" name="titulo"/>
                               <textarea rows="2" class="span12" placeholder="Detalhes do que você precisa" id="orcamentus_cp_descricao" name="descricao"></textarea> 
                               <hr class="half2" />
                               <div id="orcamentus_cp_output"></div>
                               <div class="right_resp mgB2">
                                   <input type="button" class="botao btn-main" value="enviar" id="bt_orcamentus_step_1"/>
                               </div>
                               <div class="clear"></div>
                           </div>
                           <div id="orcamentus_step_2">
                               <div class="row-fluid">
                                   <input type="text" placeholder="Nome" class="span12 txt_plus" id="orcamentus_cp_nome" name="nome"/>
                               </div>

                               <div class="row-fluid">
                                   <div class="span8">
                                       <input type="email" placeholder="E-mail" class="span12 txt_plus" id="orcamentus_cp_email" name="email"/>
                                   </div>
                                   <div class="span4">
                                       <input type="text" placeholder="Celular" class="span12 txt_plus" id="orcamentus_cp_celular" name="celular"/>
                                   </div>                                
                               </div>                           
                               <hr class="half2" />
                                <div id="orcamentus_cp_output2"></div>
                               <div class="row-fluid">
                                   <div class="right_resp mgB2">
                                       <input type="button" class="botao left btn-main mgR" value="voltar" id="bt_orcamentus_back_step_1"/>
                                       <input type="button" class="botao btn-main" value="enviar" id="bt_orcamentus_step_2"/>
                                   </div>
                               </div>
                               <div class="clear"></div>
                           </div>
                       </div>
                   </div>
               </div>
           </form>
           <?php }  ?>
          
          <?php if($layout_1 == 'note'){ ?>

           <form id="form_cp_orcamentus">
               <div class="squarebox">
                   <div class="content">
                       
                        <div class="row-fluid">
                            <div class="row-fluid">
                                <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                                    <div class="ctnArtTxt">
                                        <?php if($titulo_1 != ""){ ?>
                                        <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                                        <?php } ?>
                                        <?php if($subtitulo_1 != ""){ ?>
                                        <div class="clear"></div>
                                        <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                                        <?php } ?>
                                        <?php if($texto_1 != ""){ ?>
                                        <div class="clear"></div>
                                        <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                                        <?php } ?>
                                    </div>
                                </div>            
                            </div> 
                            <div class="row-fluid">
                                <?php if($image_1 != ''){ ?>                           
                                    <div class="span8">
                                        <div class="thumbnails center">
                                            <?php if($link_1 != ''){ ?><a href="<?php echo $link_1 ?>" <?php if(isset($link_target_1)) echo " target='$link_target_1'"; ?>><?php } ?>
                                            <img id="slot_picture<?php echo $id ?>" src="<?php echo $path_image . $image_1 ?>" alt="<?php echo $image_1 ?>" />
                                            <?php if($link_1 != ''){ ?></a><?php } ?>
                                        </div>
                                    </div>                            
                                <?php } ?>
                                <div class="span4">
                                    <div class="wrapper">
                                       <div id="orcamentus_step_1">
                                           <input type="text" placeholder="O que você precisa?" class="span12" id="orcamentus_cp_titulo" name="titulo"/>
                                           <textarea rows="2" class="span12" placeholder="Detalhes do que você precisa" id="orcamentus_cp_descricao" name="descricao"></textarea> 
                                           <hr class="half2" />
                                           <div id="orcamentus_cp_output"></div>
                                           <div class="right_resp mgB2">
                                               <input type="button" class="botao btn-main" value="enviar" id="bt_orcamentus_step_1"/>
                                           </div>
                                           <div class="clear"></div>
                                       </div>
                                       <div id="orcamentus_step_2">
                                           <div class="row-fluid">
                                               <input type="text" placeholder="Nome" class="span12 txt_plus" id="orcamentus_cp_nome" name="nome"/>
                                           </div>

                                           <div class="row-fluid">
                                               <div class="span8">
                                                   <input type="email" placeholder="E-mail" class="span12 txt_plus" id="orcamentus_cp_email" name="email"/>
                                               </div>
                                               <div class="span4">
                                                   <input type="text" placeholder="Celular" class="span12 txt_plus" id="orcamentus_cp_celular" name="celular"/>
                                               </div>                                
                                           </div>                           
                                           <hr class="half2" />
                                            <div id="orcamentus_cp_output2"></div>
                                           <div class="row-fluid">
                                               <div class="right_resp mgB2">
                                                   <input type="button" class="botao left btn-main mgR" value="voltar" id="bt_orcamentus_back_step_1"/>
                                                   <input type="button" class="botao btn-main" value="enviar" id="bt_orcamentus_step_2"/>
                                               </div>
                                           </div>
                                           <div class="clear"></div>
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
           </form>               
           <?php }  ?>
          
        </div>
    </div>
</div>