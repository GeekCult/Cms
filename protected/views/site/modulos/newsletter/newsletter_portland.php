<div id="newsletter_portland_<?php echo $id ?>" class="fullCP">
    <div class="container fullCT">
        <div class="row-fluid">
           <div class="container">
                <div class="span12">                   
                    <div class="center">
                        <h2><?php if($titulo_1 != ""){echo $titulo_1; }else{echo Yii::t('siteStrings', 'newsletter_title');} ?> <span <?php if(isset($cor_2) && $cor_2)echo "style='color: $cor_2'"?> <?php if(isset($alinhamento_2) && $alinhamento_2 != ""){echo "class='t_$alinhamento_2'";}else{echo "class='t_center'";} ?>> &nbsp;</h2> 
                        <p class="tP"><?php if($texto_1 != ""){echo $texto_1; }else{echo Yii::t('siteStrings', 'newsletter_description');} ?></p>
                    </div>              
                </div>
           </div>
        </div>
        <div class="row-fluid">
            <div class="container">
                <div class="span12">              
                    <form>
                        <div class="span2"></div>
                        <div class="span4">
                            <input type="text" value="" placeholder="Nome" class="span12" id="name_newsletter" name="nome"/>
                        </div>
                        <div class="span4">
                            <input type="email" value="" placeholder="E-mail" class="span12" id="email_newsletter" name="email"/>
                        </div>
                        <div class="span2"></div>                    
                    </form>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="message_newsletter_input"></div>
        </div>
        <div class="row-fluid">
            <div class="container">
                 <div class="span6">                                               
                    <input type="button" value="limpar" class="botao btn-second right_resp"/>
                 </div>
                <div class="span6">
                    <input type="button" value="enviar" class="botao btn-main bt_continue_newsletter" data-reference="newsletter_portland_<?php echo $id ?>"/>                  
                </div>
            </div>      
        </div>
        <hr class="half"/>
        <div class="row-fluid mgT2">
            <div class="container">
                 <div class="span6">
                    <div class="right_resp terms_nw hide">
                        <div>
                            <i class="fa fa-lock"></i>
                            <a href="/termos">Termos e condições</a>
                        </div>
                    </div>
                 </div>
                <div class="span6">
                    <div class="hide">
                        <i class="fa fa-lock"></i>
                        <a href="/politicaprivacidade">Política de Privacidade</a>
                    </div>
                </div>               
            </div>      
        </div>
    </div>
</div>