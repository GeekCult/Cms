<?php if(Yii::app()->params['livechat'] == 1){ ?>
<div class="liveChat">
    <div class="baseLiveChat"></div>
    <div class="badge_status_lv <?php if($preferences['livechat']['settings']['live']){echo 'on'; }else{echo 'off';}?>"></div>
    <div class="titlechat"></div>
    <input type="button" class="bt_maximize" data-type="closed" value="&nbsp;"/>
    <?php if($preferences['livechat']['settings']['live']){ ?>
    <div class="ctnLiveChat">
        <div class="ctnTextLiveChatAnswer">
            <?php if(isset($preferences['livechat']['conversation'])){ foreach($preferences['livechat']['conversation'] as $values){ ?>
                        
                <?php if($values['tipo'] == 1){?>
                <div class='tLcP'><span class="tLcS">Usuário: </span><?php echo $values['message'] ?></div>
                <?php } else { ?>
                <div class='tLcA titulo no-bold'><span class="tLcS"><?php echo $values['nome'] ?>: </span><?php echo $values['message'] ?></div>
                <?php } ?>

            <?php }} ?>
        </div>
        <div class="ctnTextLiveChat">
            <textarea class="textLiveChat textarea_small"></textarea>
            <input type="button" class="botao btnLiveChat" value="enviar"/>
        </div>
    </div>
    <input type="hidden" id="helper_status_on_off_livechat" value="1"/>
    <input type="hidden" id="helper_tipo_livechat" value="2"/>
    <?php } else { ?>
    <div class="ctnLiveChat">
        <div class="ctnTextLiveOffMessage">
            <p><?php echo $preferences['livechat']['settings']['message3'] ?></p>
        </div>
        <div class="ctnTextLiveChatOff">
            <input class="textLiveChat input_small2 mgb_10" placeholder="Nome" type="text" name="nome" id="nome_livechat_off"/>
            <input class="textLiveChat input_small2 mgb_10" placeholder="E-mail" type="text" name="email" id="email_livechat_off"/>
            <input class="textLiveChat input_small2 mgb_10" placeholder="Telefone" type="text" name="telefone" id="telefone_livechat_off"/>
            <textarea class="textLiveChat textarea_small" placeholder="Mensagem" name="mensagem" id="mensagem_livechat_off"></textarea>
            <div id="output_livechat_off" class="mgL0"></div>
            <input id="btnLiveChatOffStatus" type="button" class="botao btnLiveChatOff mgT mgL0" value="enviar"/>
        </div>
    </div>
    
    <input type="hidden" id="helper_status_on_off_livechat" value="0"/>
    <?php } ?>
</div>
<?php } ?>