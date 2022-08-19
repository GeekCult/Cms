<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; $session = MethodUtils::getSessionData(); ?>
<div class="row-fluid">
    <div class="container pan">
        
        <div class="row-fluid"> 
           <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/common/menu_conta_html5.php'; ?>        
            <div class="mgL mgR">
                <h1>Parabéns!</h1>
                <div class="divider_horizontal"></div>
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
                <a href="/conta/home">
                    <input type="button" class="botao btn-second" value="voltar"/>
                </a>
                <div class='clear'></div>
                <div class="mgFooter"></div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input name="action" id="action" type="hidden" value="atualizado"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>