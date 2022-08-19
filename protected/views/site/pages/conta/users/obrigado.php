<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?>
<div class="mainPan">
    <div class="wrap">
        <div class="pan container">
            <div class="container_pan">
                <?php if ($editar) { ?> 
                    <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/' . Yii::app()->params['ramo'] . '/menu_conta.php'; ?>
                <?php } ?>
                <div class="clear"></div>
                <div id="loaderMainConta">
                    <div class="titlePageAdmin">
                        <h1>Parabéns!</h1>  
                    </div>
                    <div class="cc-main-content">
                        <div class="container_text_obrigado">                        
                            <p>&nbsp;</p>
                            <p>Olá <b><?php echo $usuario_Nome; ?></b>, seu cadastro foi realizado com sucesso!</p>
                            <p>&nbsp;</p>
                            <h3>Obrigado por se cadastrar!</h3>
                            <p>&nbsp;</p>
                            <p>Enviamos um email para você, por favor confirme sua conta antes de continuar</p>
                            <p>Se você  possuir qualquer dúvida sobre sua conta, por favor nos <a href="/contato">contate</a></p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>                                                                  
                        </div>
                        <div class='clear'></div>
                        <div class="bt_voltar_home">
                            <a href="javascript:history.go(-2)">
                                <input type='button' id='bt_home' value='voltar'  class="botao bt_home" />
                            </a>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="obrigado" id="action"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>