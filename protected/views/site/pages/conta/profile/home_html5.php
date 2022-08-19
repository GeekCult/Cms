<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform . "/" . $preferences['topo_tipo'] . '.php'; $session = MethodUtils::getSessionData(); ?>
<?php
    $cache_expire = 60*60*24*365;
    header("Pragma: public");
    header("Cache-Control: max-age=".$cache_expire);
    header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
?>
<div class="row-fluid">
    <?php if(Yii::app()->params['ramo'] == 'software') include Yii::app()->getBasePath() . '/views/site/common/menu/menu_software.php'; ?>
   
    <div class="pan <?php if(Yii::app()->params['ramo'] == 'software'){echo 'container-fluid';}else{echo 'container';} ?>">
        
        <div class="<?php if(Yii::app()->params['ramo'] == 'software'){ echo "content_software";}else{echo "mgL mgR";} ?>">
        

            <?php include Yii::app()->getBasePath() . '/views/site/common/menu/conta/common/menu_conta_html5.php'; ?>

            <div class="container_title_conta">
                <h1><?php echo Yii::t("siteStrings", "label_my_warns") ?></h1>
            </div>
            <?php if($session['associado'] == 1){ ?>
            <div class="container_carrinho_credits">                        
                <div class="value_carrinho_credit"><?php echo $user['credit_User_format'] ?></div>
            </div>
            <?php } ?>


            <div class="pp_square">
                <div class="banner_promo">
                    <?php if($link_avisos != ""){ ?>
                    <a href="<?php echo $link_avisos ?>">
                    <?php } ?>
                        <?php if($banner_avisos['container']['foto'] != ''){ ?>
                        <img src="/media/user/images/original/<?php echo $banner_avisos['container']['foto'] ?>"/>
                        <?php } ?>
                    <?php if($link_avisos != ""){ ?>
                    </a>
                    <?php } ?>
                </div>
                <div class="container_total">
                    <div class="avisos" >
                        <ul>
                            <li class="mgT"> 
                                <?php if($avatar != ""){ ?>
                                <div class="image_avatar">
                                    <img src="<?php echo $avatar ?>" width="50" height="50">
                                </div>
                                <?php } ?>
                                <div class="container_info_user">
                                    <span class="title_user_hello">Olá, <b><?php echo $user_name ?></b></span>
                                    <div class="clear"></div>
                                    <?php if($frase!=""){ ?>
                                    <span class="phrase_user_conta"><?php echo $frase ?></span>
                                    <?php }else{ ?>
                                    <a href="/conta/users/<?php if($tipo_conta == 'admin'){echo "pf";}else{echo $tipo_conta;} ?>/editar" class="link">
                                    <span class="phrase_user_conta"><?php echo Yii::t("siteStrings", "label_phrase_empty"); ?></span>
                                    </a>                                                
                                    <?php } ?>
                                    <div class="clear"></div>
                                    <p class="acesso_user_conta">Acesso n. <b><?php if(isset($acessos[0]['SUM(num)'])){ echo $acessos[0]['SUM(num)'];}else{echo '1';} ?></b></p>
                                </div>
                            </li>
                            <!--<a id="testbutton" href="">oi</a>-->
                            <li class="hide"><div class="clear"></div><p>&nbsp;</p></li>
                            <?php if(($session['funcionario'] == 1 || $session['atendimento'] == 1)){ ?>
                            <li class="hide">                                            
                                <span class="qtd_avisos"><?php echo $avisos['pedidos'] ?></span>
                                <span class="bold"><?php echo $label_message_1 ?></span>
                            </li>
                            <li class="hide">                                            
                                <span class="qtd_avisos"><?php echo $avisos['propostas'] ?></span>
                                <span class="bold"><?php echo $label_message_2 ?></span>
                            </li>
                            <li class="hide">                                            
                                <span class="qtd_avisos"><?php echo $avisos['avaliar'] ?></span>
                                <span class="bold"><?php echo $label_message_3 ?></span>
                            </li>
                            <li class="hide">                                            
                                <span class="qtd_avisos"><?php echo $avisos['posts'] ?></span>
                                <span class="bold"><?php echo $label_message_4 ?></span>
                            </li>
                            <?php if($type_account != 1){ ?>                                        
                            <li class="hide">                                            
                                <span class="qtd_avisos"><?php echo $avisos['eventos'] ?></span>
                                <span class="bold"><?php echo $label_message_5 ?></span>
                            </li>
                            <?php } ?>
                            <?php } ?>
                            <?php if(($type_account == 3 || $type_account == 2) || ($session['funcionario'] == 1 || $session['atendimento'] == 1)){ ?>
                            <li>
                                <div class="birthday">
                                    <p>&nbsp;</p>  <p>&nbsp;</p>  <p>&nbsp;</p>  
                                    <span class="bold"><?php echo Yii::t("siteStrings", "label_birthday") ?></span>
                                    <div class="container_images_birthday">
                                        <?php $qtdE = 0; foreach ($avisos['birthday'] as $values){ ?>
                                        <?php if($values['isEmployee']){ ?>
                                        <div class="container_picture_birthday">
                                            <img src="<?php echo $values['avatar']; ?>" title="<?php echo $values['field1'] . " " . $values['field2']; ?>" width="40" height="40"/>
                                        </div>
                                        <?php $qtdE ++; }?>
                                        <?php } ?>
                                        <?php if($qtdE == 0) echo "Não há aniversariantes este mês"; ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <?php } ?>
                        </ul> 
                        <div class="clear"></div>
                    </div>
                </div> 


                <div class="clear mgFooter"></div>
            </div>                   


            <div class="clear mgB"></div>

            <div class="avisos_owner">
                <div class="icon_information"></div>
                <div class="badge"><?php echo Yii::t("siteStrings", "label_pay_attention_warns") ?></div>
            </div>

            <div class="clear"></div>
            <?php if(defined('Settings::PIER_COMUNICATOR') && Settings::PIER_COMUNICATOR){ ?>
            <input type="button" class="botao btn-main right_resp" value="Comunicador" data-toggle="modal" data-target="#piercommunicator"/>
            <div class="clear"></div>
            <hr class="half2" />                
            <?php } ?>
            <div class="mgFooter"></div>
        </div>
    </div>
</div>
<div class="clear"></div>
<input type="hidden" value="conta" id="helper_local_logout"/>
<input type="hidden" value="conta" id="action"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>
<?php if(defined('Settings::PIER_COMUNICATOR') && Settings::PIER_COMUNICATOR){ ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/inhamer/inhamers_modal.php'; ?>
<?php } ?>