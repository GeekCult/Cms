<div class="menu_detail_support menu_wrap_mb_bg">
    <div class="container">
        <div class="mgL_resp mgR_resp">
            <form action="/conta/home" id="barra_austin">
                <div class="row-fluid mgT">
                    <div class="span3">
                        <input type="email" placeholder="Email" name="email" class="span12 txt_plus0_resp login_conta_user"/>
                    </div>
                    <div class="span3">
                        <div class="row-fluid">
                            <div class="span7">
                                <input type="password" placeholder="Senha" name="password" class="span12 txt_plus0_resp login_conta_senha"/>
                            </div>
                            <div class="span5">
                                <input type="button" value="logar" class="botao btn-main btn-auto btn-block-resp mgB bt_login_logar" data-id-form="barra_austin"/>
                            </div>
                        </div>                   
                    </div>
                    <div class="span3">
                        <div class="left mgR mgT mgB"><span class="badge main-bg-color uppercase pointer" data-toggle="modal" data-target="#esqueci_senha">Esqueci senha</span></div>
                        <div class="left mgB"><a href="/cadastrar" class=""><div class="botao btn-success btn-auto">Cadastre-se</div></a></div>
                        <div class="clear"></div>
                    </div>
                    <div class="span3">
                        <a href="/produtos/cotacao">
                            <div class="botao btn-main right_resp amount_shopping_cart mgB"><i class="fa fa-shopping-cart mgR"></i><?php if(isset($carrinho_amount) && $carrinho_amount != ''){echo $carrinho_amount . " item(s)";}else{echo "0 item(s)";} ?></div>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>