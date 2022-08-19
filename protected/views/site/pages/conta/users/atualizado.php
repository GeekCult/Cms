<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['design_site'] . '.php'; $session = MethodUtils::getSessionData(); ?>
<div class="mainPan">
    <div class="wrap">
        <div class="pan" id="panMain">
            <div class="container_pan"> 
               <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>         
               <div class="clear"></div>
               <div id="loaderMainConta">
                   <div class="cc-main-content">
                       <div class="container_text_obrigado">
                           <h1>Parabéns!</h1>
                           <div class="divider_horizontal"></div>
                            <div class="button_conta_right">
                                <a href="javascript:history.go(-2)">
                                    <div class="bt_conta_ear_down">voltar</div>
                                </a>                    
                            </div>
                            <p>&nbsp;</p>
                           <p>&nbsp;</p>
                           <h2 class="titulo">Cadastro atualizado com sucesso!</h2>
                           <p>&nbsp;</p>
                           <h3 class="titulo"><?php echo $session['usuario_Nome']; ?></h3>
                           <p>&nbsp;</p>
                           <p><b>Seu cadastro foi atualizado com sucesso!</b></p>
                           <p>&nbsp;</p>
                           <p>Sempre que você julgar necessário atualize seus dados.</p>
                           <p>Com o cadastro atualizado fica mais fácil participar de atividades, eventos, promoções e outras novidades.</p>
                           <p>&nbsp;</p>
                           <p>&nbsp;</p>
                           <h3><a href="/conta/home">Voltar para avisos</a></h3>
                       </div>
                       <div class='clear'></div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input name="action" id="action" type="hidden" value="atualizado"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['design_site'] . '.php'; ?>
<script type="text/javascript">update(<?php echo json_encode($preferences) ?>);updatePanMain();</script>