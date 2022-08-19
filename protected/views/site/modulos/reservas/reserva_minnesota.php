<div id="reserva_minnesota_<?php echo $id ?>" class="fullCP">
    <div class="row-fluid">
      <div class="container fullCT">
            <?php if($layout_1 == 'up' || $layout_1 == ''){ ?>
            <div class="row-fluid">
                <div class="span6">
                    <div class="ctnArtTxtsAll <?php if(!$is_full) echo 'padding_l_10' ?>">            
                        <div class="ctnArtTxt">
                            <?php if($titulo_1 != ""){ ?>
                            <h2 class="mainTitle"><?php if($titulo_1 != ""){echo $titulo_1; }else{if(isset($isAdmin)) echo C::TITLE_LOREM;} ?></h2>
                            <?php } ?>
                            <?php if($subtitulo_1 != ""){ ?>
                            <h4><?php if($subtitulo_1 != ""){echo $subtitulo_1;}else{if(isset($isAdmin))echo C::SUBTITLE_LOREM;} ?></h4>
                            <?php } ?>
                            <?php if($texto_1 != ""){ ?>
                            <div class="clear"></div>
                            <p class="tP"><?php if($texto_1 != ""){echo htmlspecialchars_decode(nl2br($texto_1));}else{if(isset($isAdmin))echo nl2br(C::TEXT_LOREM);} ?></p>
                            <?php } ?>
                            <p class="sF topic legend">Poderemos entrar em contato para maiores informações ou remanejamento caso necessite</p>
                        </div>
                    </div>            
                </div>
                <div class="span6 mgT">
                    <div class="row-fluid"> 
                        <form id="form_reservas">
                             <input type="text" class="span12" placeholder="Seu nome" style="height:40px" name="nome" id="nome_reserva"/>
                             <div class="row-fluid">
                                 <div class="span8">
                                     <input type="email" class="span12" placeholder="Seu e-mail"  style="height:40px" name="email" id="email_reserva"/>
                                 </div>
                                  <div class="span4">
                                    <input type="text" class="span12" placeholder="Celular"  style="height:40px" name="telefone" id="telefone_reserva"/>
                                 </div>
                             </div>

                             <div class="row-fluid">
                                 <div class="span8">
                                 <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array('name'=>'data','id'=>'data', 'language' => 'pt-BR', 'options'=>array('showAnim'=>'fadeIn',"altFormat" => "yyyy-mm-dd"), 'htmlOptions'=>array('style'=>'height:40px!important', 'placeholder' => 'Data', 'class' => 'span12', ),'value'=>  '', )); ?>
                                 </div>
                                 <div class="span4">
                                    <input type="text" class="span12" placeholder="Horário" id="reserva_time"  style="height:40px" name="horario"/>
                                </div>
                             </div>

                             <div class="row-fluid">
                                 <div class="span12">
                                     <div id="output_reservas"></div>
                                 </div>
                             </div>
                            <div class="clear">
                                <input type="button" class="botao mgB2" value="Agendar" id="bt_submit_reserva"/> 
                            </div>
                         </form>
                    </div>
                    
                </div>                
            </div>
            <?php } ?>
          <div class="divider_shadow mgT2"></div>
        </div>
    </div>
    
</div>