<div class="row-fluid">
    <div class="ctnNewsletter squarebox">
        <?php if(isset($image1['src']) && $image1['src'] != ''){ ?>
        <div class="row-fluid">
            <div class='padding_2'>
                <img src='/media/user/images/original/<?php echo $image1['src'] ?>' alt='<?php echo $image1['src'] ?>'/>
            </div>
        </div>                    
        <?php } ?>
        <div class="content">
            <div id="bn_newsletter_cp" class="padding_10">
                <form>
                    <?php if(isset($image1['src']) && $image1['src'] == ''){ ?>
                    <div class="row-fluid">
                        <h3>Newsletter</h3>
                        <p class="lead">Inscreva-se agora</p>
                    </div>
                    <?php } ?>                  
                    <input type="text" value="" placeholder="Nome" class="span12" id="name_newsletter" name="nome"/>
                    <input type="email" value="" placeholder="E-mail" class="span12" id="email_newsletter" name="email"/>
                    <hr class="half2" />
                    <div class="row-fluid">
                        <div class="message_newsletter_input"></div>
                    </div>
                    <input type="button" class="botao btn-main right_resp bt_continue_newsletter" value="<?php if(isset($link1['src']) && $link1['src'] != ''){echo $link1['src']; }else{ echo 'enviar';} ?>" data-reference="bn_newsletter_cp"/>
                    <div class="clear mgB"></div>
                </form>
            </div>
        </div>                
    </div>
</div>