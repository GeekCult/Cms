<div id="topoMain" class="headermainPan">
    <link rel="stylesheet" href="/css/site/modulos/topos/blacklight.css" type="text/css" media="screen" />
    <div class="headerPan">
        <div class="row-fluid">
            <div class="container">
                <div class="left_resp center_resp_apply">
                    <a href="/home" class="brand hide_resp">                            
                        <?php if(isset($preferences['logo']) && $preferences['logo'] != ""){ ?>
                        <img src="<?php echo $preferences['logo'] ?>" alt="Logo"/>
                        <?php } ?>                            
                    </a>                                       
                </div>
                <div class="right_resp hide_resp">
                    <div class="left">
                        <a href="/a_empresa" class="link_header">Sobre a HostMais</a>
                    </div>
                    <div class="left ">
                        <div class="search_base">
                            <input type="text" placeholder="Buscar na HostMais" class="search_box search_field_input search_input"/>
                            <input type="button" value="buscar" class="searchbar_button"/>
                        </div>                        
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row-fluid">
            <div class="container">
                <div class="right mgT2 mgT_resp mgB_resp">
                    <input type="button" class="bt_suporte left mgR2" data-toggle="modal" data-target="#suporte_cobranca"/>
                    <a href="http://www.financeiro.hostmais.com.br/clientarea.php" target="_blank">
                        <input type="button" class="bt_central_client left"/>
                    </a>
                    <input type="button" class="bt_webmail_client left hide_resp" data-toggle="modal" data-target="#webmail"/>
                </div>
                                
            </div>
            <div class="clear"></div>
        </div>               
    </div>
    
</div>
<div class="row-fluid ">
    <div class="nav-reaction">
        <div id="menu-wrap">
            <div class="navbar navbar-static-top"> 
                <!-- navbar-fixed-top -->
                <div class="navbar-inner2">
                    <div class="container">
                        <div id="main-nav" >
                            <div class="nav-collapse collapse">
                                <ul id="menuTexture" class="nav">
                                    <?php foreach ($preferences['menu'] as $values) {   ?>
                                    <li class="dropdown">
                                        <div class="bgMenuOp"></div>
                                        <?php if (!$values['main_for_group']) { ?>
                                            <?php if($values['link_special'] == ""){ ?>
                                            <a href="/<?php echo $values['nome'] ?>"><?php echo $values['label'] ?></a>
                                            <?php }else{ ?>
                                            <a href="<?php echo $values['link_special'] ?>"><?php echo $values['label'] ?></a>
                                            <?php } ?>
                                        <?php }else{ ?>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:"><?php echo $values['label']?></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($values['more'] as $items){ if($values['id'] !=  $items['id']){ ?>
                                            <?php if($items['link_special'] != ""){ ?>
                                            <li><a href="<?php echo $items['link_special']?>" target="_blank"><?php echo $items['label']?></a></li>
                                            <?php } else { ?>
                                            <li><a href="/<?php echo $items['nome']?>"><?php echo $items['label']?></a></li>
                                            <?php } ?>
                                            <?php }} ?>
                                        </ul>
                                        <?php } ?>
                                    </li>
                                    <?php } ?>                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<?php if($_SERVER['SERVER_NAME'] == 'dev.minisite.com.br' || $_SERVER['SERVER_NAME'] == 'localhost') $local_place = true; else $local_place = false;  ?>
<?php if($local_place){$path_banner = 'http://dev.purplepier.com.br/media/user/images/clients/';}else{$path_banner = '/media/user/images/original/';} ?>
<?php if($menu_active != 'home'){ ?>
<!-- PAGE HEADER -->
<div class="headertop needhead">
    <!-- BLURED BACKGROUND-->
    <div class="action-banner-bg"></div>
    <!-- END BLURED BACKGROUND-->
    <!-- PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
    <div class="action-banner-bg-top"></div>
    <!-- END PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
    <div class="page-header">
        <div class="shine">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <!--IMAGE -->            
                            <?php if (isset($graphics['banner']) && $graphics['banner'] ) { if($graphics['banner']['slot_type'] == "f"){ ?>
                            <div class="row-fluid">
                                <div class="span12 center">
                                    <div class='image_vertical_layout'>
                                        <img src="<?php echo "//" . $_SERVER['SERVER_NAME'] ?>/media/user/images/original/<?php echo $graphics['banner']['foto'] ?>" alt="<?php echo $graphics['banner']['titulo'] ?>" title="<?php echo $graphics['banner']['foto'] ?>"/>
                                    </div>
                                <?php  } ?>
                                </div>
                            </div>
                            <?php } ?>            
                            <!-- END IMAGE -->
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <h1><?php if(isset($text['titulo'])) echo $text['titulo'] ?></h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGE HEADER -->
 
<?php }else{ ?>
<div class="row-fluid">
    <div class="headertop needhead">
        <!-- BLURED BACKGROUND-->
        <div class="action-banner-bg"></div>
        <!-- END BLURED BACKGROUND-->
        <!-- PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
        <div class="action-banner-bg-top"></div>
        <!-- END PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
        <div class="container">
            <div id="banner_main">
                <?php include Yii::app()->getBasePath() . "/views/site/common/banner/banner.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div id="menu-select-mobile">
    <div class="row-fluid">
        <div class="span12 mgT">
            <div class="padding_top_10 padding_l_10">
                <select name="menu-mobile" id="menu-mobile" class="span8">
                    <?php foreach ($menu_principal as $value){ $actM = ''; ?>
                        <?php if(!$value['main_for_group']) { ?>
                        <option value="<?php if($value['action'] != ""){
                                if($value['action'] == "pedidos" || $value['action'] == "chamados" || $value['action'] == "produtos" || $value['action'] == "materias"){
                                        echo $value['controller'];
                                    }else if($value['action'] == "hotsite"){
                                        echo $value['nome'];
                                    }else{
                                        if($value['action'] != "users" || $value['action'] != "noticias"){
                                            echo $value['action'];
                                        }else{
                                            echo $value['action'] . "/" . $value['controller'];
                                        }
                                    }        
                                }else if($value['link_special'] != ''){
                                    echo $value['link_special'];

                                }else{
                                  echo $value['nome'];  
                                } ?>        
                            
                        <?php } else{ ?>
                            <?php foreach ($value['more'] as $items){ $actM = ''; if($value['id'] !=  $items['id']){ ?>
                            <option value="<?php if($value['action'] != ""){
                                if($items['action'] == "pedidos" || $items['action'] == "chamados" || $items['action'] == "produtos" || $items['action'] == "materias" || $items['action'] == "contato"){
                                    echo $items['controller'];
                                }else if($items['action'] == "hotsite"){
                                    echo $items['nome'];
                                }else if($items['link_special'] != ""){
                                    echo $items['link_special'];
                                }else{
                                    if($items['action'] != "users" || $items['action'] != "noticias"){
                                        echo $items['action'];
                                    }else{
                                        echo $items['action'] . "/" . $items['controller'];
                                    }
                                }        
                            }else if($items['link_special'] != ''){
                                echo $items['link_special'];
                            }else{
                                echo $items['nome'];
                            } ?>
                            <?php if($items['nome'] == $menu_active) $actM = ' selected '; echo '"' . $actM . '>' .$items['label']; ?>
                            <?php } } ?>
                        <?php } ?>                                
                            <?php if($value['nome'] == $menu_active) $actM = ' selected '; if(!$value['main_for_group']){echo '"' . $actM . '>' .$value['label'];} ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/modal/suporte.php'; ?>
<?php include Yii::app()->getBasePath() . '/views/site/modulos/modal/webmail.php'; ?>