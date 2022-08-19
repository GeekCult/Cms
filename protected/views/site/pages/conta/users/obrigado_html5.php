<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; ?>
<div class="row-fluid">
    <div class="pan container">
        <div class="mgL mgR">
            <div class="row-fluid">
                <?php if ($editar) { ?> 
                    <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/common/menu_conta.php'; ?>
                <?php } ?>
                <h1>Parabéns!</h1>  
                <div class="clear"></div>
                <div class="divider_horizontal"></div>
                <div class="clear"></div>
                <div class="row-fluid">

                    <p>&nbsp;</p>
                    <p>Olá <b><?php echo $usuario_Nome; ?></b>, seu cadastro foi realizado com sucesso!</p>
                    <p>&nbsp;</p>
                    <h3>Obrigado por se cadastrar!</h3>
                    <p>&nbsp;</p>
                    <p>Enviamos um email para você, por favor confirme sua conta antes de continuar</p>
                    <p>Se você  possuir qualquer dúvida sobre sua conta, por favor nos <a href="/contato">contate</a></p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>                                                                  

                    <div class="bt_voltar_home">
                        <a href="/login">
                            <input type='button' id='bt_home' value='voltar'  class="botao bt_home btn-second" />
                        </a>
                    </div>
                </div>                
            </div>
        </div>        
    </div>
</div>
<input type="hidden" value="obrigado" id="action"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>