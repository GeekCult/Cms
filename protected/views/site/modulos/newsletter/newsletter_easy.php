<div id="newsletter_easy_<?php echo $id ?>" class="fullCP">
    <div class="container fullCT">
       <div class="row-fluid">
            <div class="span12">
                <div class="well well_simple">                    
                    <p class="land">
                        <span class="tNwl"><?php if($titulo_1 != ""){echo $titulo_1; }else{echo Yii::t('siteStrings', 'newsletter_title');} ?></span> 
                        <span class="stNwl"> &nbsp;<?php if($subtitulo_1 != ""){echo $subtitulo_1; }else{echo Yii::t('siteStrings', 'newsletter_text');} ?></span>                        
                    </p>
                    <p class="tP"><?php if($texto_1 != ""){echo $texto_1; }else{echo Yii::t('siteStrings', 'newsletter_description');} ?></p>
                    <div>
                        <form>
                            <div class="row-fluid">
                                <div class="span6">
                                    <input type="text" value="" placeholder="Nome" class="span12" id="name_newsletter" name="nome"/>
                                </div>
                                <div class="span6">
                                    <input type="email" value="" placeholder="E-mail" class="span12" id="email_newsletter" name="email"/>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="message_newsletter_input"></div>
                            </div>
                            <div class="row-fluid">
                                <div class="span7">
                                    <div class="right terms_nw">
                                        <div class="left mgR2 hide">
                                            <i class="fa fa-lock"></i>
                                            <a href="/termos">Termos e condições</a>
                                        </div>
                                        <div class="left hide">
                                            <i class="fa fa-lock"></i>
                                            <a href="/politicaprivacidade">Política de Privacidade</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="right ctn_btnw mgT2">                                
                                        <input type="button" value="limpar" class="botao left mgR2 mgB"/>
                                        <input type="button" value="enviar" class="botao bt_continue_newsletter mgB"/>
                                    </div>                                
                                </div>
                            </div>
                        </form>
                        <div class="clear"></div>
                    </div>                    
                </div>
            </div>
        </div>        
    </div>
</div>

