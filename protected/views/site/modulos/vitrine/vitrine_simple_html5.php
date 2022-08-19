<?php if(count($vitrine) > 0) { ?>

    <div class="produtos_container_vitrine" style="display:none">
      <?php $i = 0; foreach($vitrine as $values){ ?>
      <div class="center <?php if(count($vitrine)>1){ ?>
          <?php if($i <= 3){echo "span3";}else{$i = 0;}} if(count($vitrine)==3){if($i <= 2){echo "span4";}else{$i = 0;}}?>">
          <div class="pp_square mgB">
              <div class="produtos_vitrine_titulo">
                  <span class="titulo"><?php echo $values['nome'] ?></span>
              </div>
              <div id="ctnSlotPict<?php echo $values['id'] ?>" class="produtos_vitrine_image_container">
                  <img src="/media/user/images/thumbs_120/<?php echo $values['image_0'] ?>" alt="<?php echo $values['nome'] ?>" id="slot_picture<?php echo $values['id'] ?>" class="img_vitrine_slot" width="150"/>
                  <?php if($values['lancamento']){ ?>
                  <div class="badge_lancamento"></div>
                  <?php }?>            
              </div>
              <div class="produtos_vitrine_valor_container">
                    <?php if($values['promocao'] != "0" && $values['promocao'] != "Grátis" && $values['promocao'] != ""){ ?>
                    <div class="valor_vitrine_promocao subtitulo">De <?php echo $values['preco_real_string'] ?> por:</div>
                    <span class="produtos_vitrine_valor"><?php echo $values['promocao'] ?></span>
                    <?php } else { ?>
                    <div class="parcelado_vitrine">
                        <?php if($values['preco_real_string'] != 'Grátis' && $values['preco_real_string'] != 'Sob Consulta' && $values['preco_real_string'] != '' && $values['parcelas'] > 1) { ?>
                        <span>Até <b><?php echo $values['parcelas'] ?></b> x</span>
                        <span class="valor bold"><?php echo $values['valores']['parcel'] ?></span>
                        <?php } ?>
                    </div>
                    <span class="produtos_vitrine_valor"><?php echo $values['preco_real_string'] ?></span>
                    <?php } ?>
              </div>
              <div class="produtos_vitrine_comprar">
                <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
                <input type="button" class="bt_detalhes_produto botao btn-main" id="<?php echo $values['id'] ?>" value="ver detalhes" alt="<?php echo $values['url'] ?>" data-variante="<?php echo $values['id_variante'] ?>"/> 
                <?php } else { ?>
                <input type="button" class="bt_detalhes_produto botao btn-main" id="<?php echo $values['id'] ?>" value="ver detalhes" alt="<?php echo $values['url'] ?>"/>
                <?php } ?>
              </div>
          </div>
      </div>
      
      <?php $i++; } ?>

      <?php if(Yii::app()->params['ramo'] == 'ecommerce'){ ?>
      <script type="text/javascript">setTimeout(function(){$(".bt_detalhes_produto").click(function(){window.location = "/loja/"+ this.alt + "?it=" + $(this).attr('data-variante')+ "&v=" + $(this).attr('data-variante');});},1000);</script>
      <?php }else{ ?>
        <?php if(Yii::app()->params['ramo'] == 'educacao'){ ?>
            <script type="text/javascript">setTimeout(function(){$(".bt_detalhes_produto").click(function(){window.location = "/loja/"+ this.alt;});},1000);</script>
        <?php }else{ ?>
            <script type="text/javascript">setTimeout(function(){$(".bt_detalhes_produto").click(function(){window.location = "/produtos/"+ this.alt;});},1000);</script>
        <?php } ?>
      <?php } ?>

    </div>

<link rel="stylesheet" type="text/css" href="/css/site/modulos/vitrine/vitrine_simple_html5.css" />
<?php } ?>