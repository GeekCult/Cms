<script type="text/javascript" src="/js/lib/keyboardlistener.js"></script>
<script type="text/javascript" src="/js/lib/md5/md5_script.js"></script>
<script type="text/javascript" src="/js/site/intro/login.js"></script>

<!-- home -->
<section id="home" class="container">
    <!-- main -->
    <div id="main">
        <div class="row-fluid">
           <?php if(isset($preferences['logo']) && $preferences['logo'] != ''){ ?>
            <img src="<?php echo $preferences['logo']; ?>" alt="Logo" height="50"/>
            <?php } ?>
        </div>
       
        <hr class="half" />
        <!-- countdown -->
        <div class="row-fluid pp_square transparent_20">
            <?php if($page_prop['gel_fr_initial'] != ""){ ?>
            <div class="center">
                <h4 class='titulo'><?php echo $page_prop['gel_fr_initial'] ?></h4>
            </div>
            <?php } ?>
            
            <ul class="countdown <?php if($preferences['site_release'] == '' || $preferences['site_release'] == "00/00/0000") echo 'hide' ?>">
                <li class="pp_square transparent_20">
                    <span class="days">00</span>
                    <p class="days_ref center">dias</p>
                </li>
                <li class="pp_square transparent_20">
                    <span class="hours">00</span>
                    <p class="hours_ref center">horas</p>
                </li>
                <li class="pp_square transparent_20">
                    <span class="minutes">00</span>
                    <p class="minutes_ref center">minutos</p>
                </li>
                <li class="pp_square transparent_20">
                    <span class="seconds">00</span>
                    <p class="seconds_ref center">segundos</p>
                </li>
            </ul>
        </div>
        <div class="mgB"></div>
        <div class="row-fluid pp_square transparent_20">         
            <div class="span6">
                 <p class="ctn_info_user txt_left"><?php echo nl2br($text['texto_01']) ?></p>
            </div>
            <div class="span6">
                 <h5 class="titulo"><?php echo Yii::t("siteStrings", "label_restrict_area") ?></h5>
                 <div class="row-fluid">
                     <input type="email" class="span12" id="email_login" placeholder="E-mail" name="email"/>
                 </div>
                 <div class="row-fluid">
                     <input type="password" class="span12"  placeholder="Senha" id="loginSenha"/>
                 </div>
                 <div id="message" class='row-fluid'></div>
                 <div class="container_buttons_intro">                                
                     <input type="button" value="logar"  class="botao" id="bt_logar"/>
                 </div>
            </div>
        </div>                                
        
        
        <!-- Social -->
        
        <div class="clear mgT2"></div>
        <a href="http://www.purplepier.com.br" target="_blank">
            <img src="/media/images/logos/logo_purplepier_horizontal.png" alt="PurplePier" height="50" style="height:50px"/>
        </a>        
        <div class="clear"></div>
        <div class="divider_shadow"></div>
        <div class="clear"></div>
        <div class='social'>
          <div class='services'>
            <ul>
              <li id="facebook">
                <a href="https://www.facebook.com/PurplePier" target="_blank"><div class='fa fa-facebook'></div></a>
                <span class='caption'>Facebook</span>
              </li>
              <li id="twitter">
                <a href="https://www.twitter.com/@PurplePier" target="_blank"><div class='fa fa-twitter'></div></a>
                <span class='caption'>Twitter</span>
              </li>
              <li id="google">
                <a href="https://www.plus.google.com/PurplePierBr" target="_blank"><div class='fa fa-google-plus'></div></a>
                <span class='caption'>Google+</span>
              </li>
              <li id="linkedin">
                <a href="https://www.linkedin.com" target="_blank"><div class='fa fa-linkedin'></div></a>
                <span class='caption'>LinkedIn</span>
              </li>
            </ul>
          </div>
        </div><!-- Social -->
        <div class="clear"></div>
        <p class="legend center">Todos os direitos reservados - PurplePier®</p>
    </div><!-- end main -->
</section><!--end home -->

<input type="hidden" value="home" id="helper_next_action"/>
<input type="hidden" id="date_launch" value="<?php echo $info['site_release'] ?> 12:00:00"/>
<?php if($info['layout']['textura_intro'] != ""){ ?>
<script type="text/javascript">updateIntro(<?php echo json_encode($info['layout']) ?>);</script>
<?php } ?>
<script type="text/javascript">initListenerPrecadastro();</script>