<div class="ctnLogin">
    <form id="formLoginAdmin" action="/admin/intro/logar" method="POST">
        <div class="ctnLoginFields">
            <input type="email" name="email" id="user" placeholder="E-mail" class="login_input" value="<?php if(isset($email)) echo $email ?>"/>
            <div class="clear"></div>
            <input type="password" name="password" id="password" placeholder="Senha" class="login_input"/>
            <div class="clear"></div>
            <div class="left">
                <input type="checkbox" class="checkbox left mgR" name="checkbox" id="permitir" checked="true"/>
                <span class="legend">Permanecer logado</span>
            </div>
            <div class="right">
                <span id="bt_esqueci_senha" class="badge3 pointer">Esqueci minha senha</span>
            </div>
            <div class="clear mgB"></div>
            <?php if(isset($message)){ ?>
            <div id="output">
                <div class='message_result error' style="display: block">
                    <i class='icon_p'></i>
                    <div class='content white'><?php if(isset($message)) echo $message ?></div>
                </div>
            </div>
            <?php } ?>
            <div id="output2"></div>
            <div class="clear mgB"></div>
            <input type="button" class="botao" value="Logar" id="bt_logar"/>
            <div class="clear mgB"></div>            
            <div style="margin: 0px 0 0 9px; position: absolute; bottom: 15px;">
                <a href="https://www.purplepier.com.br/media/images/layout_aplicativo/<?php if(isset($componente) && $componente)echo $componente[0]['thumb'] ?>" class="fancybox">
                    <img src="https://www.purplepier.com.br/media/images/layout_aplicativo/<?php if(isset($componente) && $componente) echo $componente[0]['thumb'] ?>" alt="Componente" width="360"/>
                </a>
            </div> 
            <div class="clear"></div>
            <a href="http://www.purplepier.com.br/termos" target="_blank" class="link sF hide">Termos de uso</a>
        </div>        
    </form>
</div>