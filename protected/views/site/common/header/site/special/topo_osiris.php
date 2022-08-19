<!-- ################-->
<!-- START TOP MENU -->
<!-- ################-->
<link href="/css/site/components/headers/osiris.css" type="text/css" rel="stylesheet" />
<div id="topo_osiris" class="topo_helper nav-reaction headermainPan">
    <?php if($preferences['topo']['attr']['topo_layout'] == 'common' || $preferences['topo']['attr']['topo_layout'] == ''){ ?>
    <div class="navbar navbar-static-top"> 
        <!-- navbar-fixed-top -->
        <div class="navbar-inner">
            <div class="container">
                
                <a class="brand" href="/home"> 
                    <img src="<?php echo $preferences['logo']?>" alt="Logo">
                </a>
                <div id="main-nav" class="mn_osis_pos">
                    <div class="nav-collapse collapse">
                        <ul id="menuTexture" class="nav">
                            
                            <?php $i = 0; foreach ($menu_principal as $value){?>
                            <li class="dropdown <?php if($value['nome'] == $menu_active) echo 'active' ?>">
                                <?php if(!$value['main_for_group']) { ?>
                                <div class="bgMenuOp"></div>
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
                               
                                <a href="<?php if($value['link_special'] != ''){echo $value['link_special'];}else{ echo '#';}?>" class="dropdown-toggle" data-toggle="dropdown" href="javascript:"><?php echo $value['label']?></a>
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
         
                           
                            <li>
                                <div class="mn_posSame">
                                    <div class="search-header">
                                    <form id="search-header" accept-charset="utf-8">
                                    
                                        <input id="search-form_is" type="button" value="" class="bt_searchCtnSolid">
                                    </form>
                                    </div>
                                </div>                                
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>
                
                
                <div id="bt_menu_resp_retratil" class="cat-title"></div>
                
            </div>
            
        </div>
    </div>
    <?php } ?>
    
    <?php if($preferences['topo']['attr']['topo_layout'] == 'refined'){ ?>
    <div class="navbar navbar-static-top"> 
        <!-- navbar-fixed-top -->
        <div class="navbar-inner">
            <div class="container">
                <div class="row-fluid">
                    <div class="span6">
                        <a class="brand2" href="/home"> 
                            <img src="/media/user/images/original/<?php echo $preferences['logo']?>" alt="Logo">
                        </a>
                    </div>
                    <div class="span6">
                        <div class="right_resp hide_resp txt_right mgT2">
                            <?php if($preferences['telefone_contato']){ ?>
                            <div class="clear mgR">
                                
                                <h4 class="mg0" <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>><i class="fa fa-phone" <?php if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_3']}'"; ?>></i> <?php echo $preferences['telefone_contato'] ?></h4>
                            </div>                    
                            <?php } ?>
                            <?php if($preferences['email_contato']){ ?>
                            <div class="clear">
                                <i class="fa fa-envelope" <?php if(isset($preferences['topo']['attr']['topo_cor_3']) && $preferences['topo']['attr']['topo_cor_3'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_3']}'"; ?>></i>
                                <span <?php if(isset($preferences['topo']['attr']['topo_cor_1']) && $preferences['topo']['attr']['topo_cor_1'] != '') echo "style='color: #{$preferences['topo']['attr']['topo_cor_1']}'"; ?>><?php echo $preferences['email_contato'] ?></span>
                            </div>
                            <?php } ?> 
                        </div>                        
                    </div>
                </div>
                
                <div class="clear"></div>
                <div class="row-fluid">
                    <div class="nav-reaction">
                        <div id="menu-wrap">                        
                            <div class="navbar-inner">                                
                                <div class="nav-collapse collapse center">
                                    <ul class="nav menu" style="margin: 0 auto 0px auto!important; display: table; float: none;">
                                        <?php include Yii::app()->getBasePath() . "/views/site/common/menu/content/menu_loader.php"; ?>                            
                                        <li class="hide">
                                            <div class="mn_posSame">
                                                <div class="search-header">
                                                <form id="search-header" accept-charset="utf-8">

                                                    <input id="search-form_is" type="button" value="" class="bt_searchCtnSolid">
                                                </form>
                                                </div>
                                            </div>                                
                                        </li>
                                    </ul>
                                </div>                                
                            </div>

                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <div id="bt_menu_resp_retratil" class="cat-title"></div>                
            </div>            
        </div>
    </div>
    <?php } ?>
    
    
    <div class="row-fluid bg_bar_white searchCtnSolid">
        <div class="container">
            <div class="right_resp">
                <input data-provide="typeahead" data-items="4"  type="text" class="search_field_input inptRigth2" placeholder="&nbsp;&nbsp;<?php if($preferences['topo']['attr']['frase_searchbox']) echo $preferences['topo']['attr']['frase_searchbox'] ?>" data-status="closed">
                <button class="botao btn-main btn-auto searchbox_button bt_open_searchbox" data-type="interesse"><i class="fa fa-search"></i></button>
            </div>
            
        </div>

    </div>
</div>
<div id="menu_resp_retratil" class="row-fluid">
    <?php if(isset($menu_responsivo)) $menu_principal = $menu_responsivo; ?>
    <?php foreach ($menu_principal as $value){ $actM = ''; ?>
    
        <?php if(!$value['main_for_group']) { ?>
        <a href="
            <?php if($value['action'] != ""){
                
                if($value['action'] == "pedidos" || $value['action'] == "chamados" || $value['action'] == "produtos" || $value['action'] == "materias"){
                    echo $value['controller'];
                }else if($value['action'] == "hotsite"){
                    echo $value['nome'];
                }else{
                    if($value['action'] != "users" || $value['action'] != "noticias"){echo $value['action'];}else{echo $value['action'] . "/" . $value['controller'];}
                } 
                
            }else if($value['link_special'] != ''){
                echo $value['link_special'];

            }else{
              echo $value['nome'];  
            } ?> 
           

        <?php }else{ ?>
            <?php foreach ($value['more'] as $items){ $actM = ''; if($value['id'] !=  $items['id']){ ?>
            <a href="<?php if($value['action'] != ""){
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
            <?php if($items['nome'] == $menu_active) $actM = ' menu_Active '; echo $actM . '"><div class="itMenuResp">' .$items['label'] . '</div></a>'; ?>
            <?php } } ?>
        <?php } ?>                                
            <?php if($value['nome'] == $menu_active) $actM = ' menu_Active '; ?>
            <?php if(!$value['main_for_group']){ echo $actM ?> 
            "><div class="itMenuResp"> <?php echo $value['label'] ?></div></a>
            <?php } ?>

    <?php } ?>
</div>
<div class="clear"></div>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->

