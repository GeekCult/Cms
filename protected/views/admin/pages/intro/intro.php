<div id="pan">
    <div class='content'>
        <div class="welcome_admin">
            <ul class="intro_logged_in">                
                <li>
                    <div class="container_picture_intro">
                        <img title="<?php echo $usuario ?>" src="<?php echo $data['avatar'] ?>" width="50" height="50" class="picture_intro"/>
                    </div>                   
                    <div class="welcome_message">
                        <p>Prezado Sr(a)</p>
                        <p id="admin_user"><b><?php echo $usuario ?></p></b>
                        <p><?php echo $data['frase'] ?></p>
                    </div>
                </li>
                <li><div class="clear"><p>&nbsp;</p></div></li>
                <li>
                    <span></span>
                </li>
                <li>
                    <span>Este é seu acesso nº </span><span id="admin_visits"><?php echo $acessos['admin'] ?></span>
                </li>
                <li class="mgB">
                    <span>Seu site teve </span><span id="site_visits"><b><?php echo $acessos['site'] ?></b></span><span> visitas</span>
                </li>
                <li>
                    <span>Desde, </span><span id="admin_creation"><b><?php echo $data['creation'] ?></b></span><li>
                </li>
            </ul>
            <ul class="intro_logged_off">
                <li>
                    <div class="container_picture_intro">
                        <img title="Admin 2.0" src="/media/images/app/app_icons/purplepier.png" width="50" height="50" class="picture_intro"/>
                    </div>                   
                    <div class="welcome_message">
                        <span>Prezado Sr(a)</span>
                        <p id="admin_user"><b>Faça o login para acessar sua conta</p></b>
                    </div>
                </li>
                
            </ul>
        </div>
        <div class="avisos hide">
            <?php if(Yii::app()->params['ramo'] != "educacao"){ ?>
            <ul class="intro_logged_in">
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <span>Este domínio tem:</span>
                </li>
                
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <div id="admin_visits" class="qtd_intro"><b><?php echo $avisos['pedidos'] ?></b></div><span>Pedidos realizados </span>
                </li>
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['chamados_abertos'] ?></b></div><span>Chamados abertos </span>
                </li>
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['comentarios'] ?></b></div><span>Comentários para aprovar </span>
                </li>
                <li class="<?php if(Yii::app()->params['ramo'] != 'associacao') echo 'hide'?>">
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['associacao_total'] ?></b></div><span>Pedidos de associação</span>
                </li>
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['avaliar'] ?></b></div><span>Clientes para liberar acesso</span>
                </li>
                <li class="<?php if(Yii::app()->params['ramo'] != 'associacao') echo 'hide' ?>">
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['parceria_total'] ?></b></div><span>Pedidos de parceria</span>
                </li>
                <li class="<?php if(Yii::app()->params['ramo'] != 'associacao') echo 'hide' ?>">
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['publicidade_online_total'] ?></b></div><span>Pedidos de publicidade</span>
                </li>
                <li class='<?php if(Yii::app()->params['ramo'] == 'software') echo 'hide' ?>'>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['clientes'] ?></b></div><span>Novos clientes cadastrados</span>
                </li>
                <li>
                    <p>&nbsp;</p>
                    <div class="link_intro_estatisticas"><a href="/admin/estatisticas/listar">Ver todas as estatísticas</a></div>
                </li>
            </ul>   
            <?php }else{ ?>
            <ul class="intro_logged_in hide">
                <li>
                    <span>Este domínio tem:</span>
                </li>
                <li>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['comentarios'] ?></b></div><span>Comentários para aprovar </span>
                </li>
                <li>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['provas_corrigir'] ?></b></div><span>Provas para corrigir</span>
                </li>
                <li>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['publicidade_online_total'] ?></b></div><span>Pedidos de publicidade</span>
                </li>
                <li>
                    <div id="site_visits" class="qtd_intro"><b><?php echo $avisos['clientes'] ?></b></div><span>Novos clientes cadastrados</span>
                </li>
                <li>
                    <p>&nbsp;</p>
                    <div class="link_intro_estatisticas"><a href="/admin/estatisticas/listar">Ver todas as estatísticas</a></div>
                </li>
            </ul> 
            <?php } ?>
            
            <?php if(defined('Settings::PIER_AGENDA') && Settings::PIER_AGENDA){ ?>
            <div id="items_calendar_day" class="mgT2 hide">
                <p>Carregando compromissos...</p>
            </div>
            <?php }  ?>
            
            
        </div>
        <?php if(isset($componente) && $componente){ ?>
        <div class="right hide" style="margin: 0 35px 0 0;">
            <div class="left mgR base_purplestore">
                <div class="right" style="margin: 35px 15px 0 0"><a href="#" class="sF2">ver todos</a></div>
                <div class="clear"></div>
                <div class="right" style="margin: 0px 10px 0 0">
                    <a href="/admin/purplestore/exibe/componente_site" class="fancybox-purplestore">
                        <div class="container-buy-pp"></div>
                    </a>
                </div>                
            </div>
            <a href="/admin/purplestore">
                <img src="https://www.purplepier.com.br/media/images/layout_aplicativo/<?php if(isset($componente) && $componente) echo $componente[0]['thumb'] ?>" alt="Componente" width="300"/>
            </a>           
        </div>
        <?php } ?>
        <div class="clear"></div>
        <div class="intro-banner">
            
            
            <div id="recent_activity">
                <?php if($activity){ foreach($activity as $values){ ?>
                <div class="item_recent_activity">
                    <div class="container_picture_activity"><img src="<?php echo $values['picture'];?>" class="picture_activity"/></div>
                    <div class="label_activity_name"><?php echo $values['nome'];?></div>
                    <div class="label_activity_titulo"><?php echo $values['titulo'];?></div>
                    <div class="label_activity_data"><?php echo $values['data_string'];?></div>
                </div>
                <?php }} ?>
            </div>
            <div class="container_intro_4">
                <?php if($google){ ?>
                <div class="statisticChart mgB0">
                    <div class="txtChart">
                        <div class="txtChartTitle left">Visitantes</div>
                        <div class="txtChartText right" id="analytics_user"><?php echo $google['users']; ?></div>
                        <div class="clear"></div>
                    </div>                    
                    <div class="chart1"></div>
                </div>
                <div class="clear"></div>
                <div class="statisticChart mgB0">
                    <div class="txtChart">
                        <div class="txtChartTitle left">Páginas visitadas</div>
                        <div class="txtChartText right" id="analytics_pageviews"><?php echo $google['pageviews']; ?></div>
                        <div class="clear"></div>
                    </div>                    
                    <div class="chart1"></div>
                </div>
                <div class="clear"></div>
                
                <div class="statisticChart">
                    <div class="txtChart">
                        <div class="txtChartTitle left">Share/Likes</div>
                        <div class="txtChartText right" id="facebook_statistics"><?php if($facebook['share'] != '' || $facebook['likes'] != ''){  echo $facebook['share'] . "/" . $facebook['likes']; } ?></div>
                        <div class="clear"></div>
                    </div>                    
                    <div class="chart2"></div>
                </div>
                <div class="clear"></div>
                
                <div class="logo_analytics right mgT0 pointer" id="bt_analytics" title="Atualizar Google Analytics"></div>
                <?php }else{ ?>
                <p>&nbsp;</p>
                <div class="right sF2">Adquira o aplicativo Google Analytics</div>
                <?php } ?>
                <p>&nbsp;</p><p>&nbsp;</p>
                <div class="mgB2"></div>
            </div>
            <div class="container_intro_5">
                <div class="title"></div>
                <div class="text"></div>
                <!--<input type="button" id="bt_teste" value="teste"/> -->
            </div>
           
            
            <input type="hidden" id="helper_action" data-day="<?php echo date('d') ?>" data-month="<?php echo date('m') ?>"/>
        </div>
        
        <div class="clear"></div>
    </div>
</div>
<input type="hidden" id="apply_terms" value="<?php echo $avisos['user']['concorda_purplepier'] ?>"/>
<input type='hidden' class="iframe" id="concorda2" style='width: 1px; height: 1px;'/>
        
<script type="text/javascript">checkIntroLogin('<?php echo $session["logado_admin"] ?>');</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>