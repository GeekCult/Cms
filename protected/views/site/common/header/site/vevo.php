<!-- ################-->
<!-- START TOP MENU -->
<!-- ################-->
<div class="nav-reaction topo_helper">
    <div class="headermainPan"></div>
    <div class="navbar navbar-static-top"> 
        <!-- navbar-fixed-top -->
        <div class="navbar-inner">
            <div class="container"> 
                <a class="brand" href="/home"> 
                    <img src="/media/user/images/original/<?php echo $preferences['logo']?>" alt="Logo">
                </a>
                <div id="main-nav">
                    <div class="nav-collapse collapse <?php if($preferences['menu_align'] == 'center') echo 'center'; ?>">
                        <ul id="menuTexture" class="nav <?php if($preferences['menu_align'] == 'center') echo 'mnCenter'; ?> <?php if($preferences['menu_align'] == 'right') echo 'right'; ?>">
                            
                            <?php $i = 0; foreach ($menu_principal as $value){?>
                            
                            <li class="dropdown <?php if($value['nome'] == $menu_active) echo 'active' ?>">
                                <div class="bgMenuOp"></div>
                                <?php if(!$value['main_for_group']) { ?>
                                <a href="/<?php if($value['action'] != ""){
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
                                "><?php echo $value['label']?></a>
                                
                                
                                <?php } else { ?>
                               
                                <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:"><?php echo $value['label']?></a>
                                <ul class="dropdown-menu">
                                    
                                    <?php foreach ($value['more'] as $items){ if($value['id'] !=  $items['id']){ ?>
                                    <li><a href="/<?php if($value['action'] != ""){
                                        if($items['action'] == "pedidos" || $items['action'] == "chamados" || $items['action'] == "produtos" || $items['action'] == "materias"){
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
                                    "><?php echo $items['label']?></a></li>
                                    <?php } } ?>

                                    <?php if(isset($value['products'])){foreach ($value['products'] as $items){  ?>
                                    <li><a href="/produtos/detalhes/<?php echo $items['id'] ?>"><?php echo $items['nome'] ?></a></li>
                                    <?php }} ?>

                                </ul>
                                <?php } ?>
                            </li>
                            <?php $i++; } ?>
         
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Logar</a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="ctMnLogar padding_10">
                                            <form method="post" action="logar" accept-charset="UTF-8">
                                                <input class="mgB" type="text" placeholder="Username" id="username" name="username">
                                                <input class="mgB" type="password" placeholder="Password" id="password" name="password">
                                                <div class="clear"></div>
                                                <input class="left mgR2" type="checkbox" name="remember-me" id="remember-me" value="1">
                                                <label class="string optional mgL" for="sign-in"> Remember me</label>
                                                <input class="btn btn-info btn-block" type="submit" id="sign-in" value="Sign In">
                                                <label class="center mgT0">or</label>
                                                <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                                                <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->

<!-- START HEADER headertop -->
<div class="headertop needhead" id="<?php echo $menu_active ?>">

    <!-- BLURED BACKGROUND-->
    <div class="action-banner-bg"></div>
    <!-- END BLURED BACKGROUND-->

    <!-- PIXEL BG DOTTS UNDER BLURED BACKGROUND-->
    <div class="action-banner-bg-top"></div>
    <!-- END PIXEL BG DOTTS UNDER BLURED BACKGROUND-->

    <?php if(defined('Settings::BARRA_SOCIAL') &&  Settings::BARRA_SOCIAL){ ?>
    <?php include Yii::app()->getBasePath() . "/views/site/modulos/topos/extra/barra_social.php"; ?>
    <?php } ?>
    
    <?php if($menu_active != 'home'){ ?>
    <!-- PAGE HEADER -->
    <div class="page-header">
        <div class="shine">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12">

                        <div class="row-fluid">
                            <div class="span12">
                                <h1><?php if(isset($text['titulo'])) echo $text['titulo'] ?></h1>
                                <!-- BREADCRUMB -->
                                <ul class="breadcrumb">
                                    <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
                                </ul>
                                <!--END: BREADCRUMB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE HEADER -->
    <?php } else{ ?>
    
    <div class="row-fluid">
        <div class="span12">
            <div id="banner_main" class="thumbnails center">    
               <?php include Yii::app()->getBasePath() . "/views/site/common/banner/banner.php"; ?>
            </div>
        </div>
    </div>
   
    
    <?php } ?>
</div>
<div id="menu-select-mobile">
    <div class="row-fluid">
        <div class="span12">
            <div class="mgT padding_l_10">
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
<!-- END HEADER headertop -->
