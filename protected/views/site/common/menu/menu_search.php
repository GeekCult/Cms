<!-- ################-->
<!-- START TOP MENU -->
<!-- ################-->

<?php if(isset($preferences['menu_total']) && $preferences['menu_total'] == 'false'){?>
<div class="container">
<?php } ?>
    <div class="nav-reaction">
        <div id="menu-wrap">
            <div class="navbar navbar-static-top"> 
                <!-- navbar-fixed-top -->
                <div class="navbar-inner2">
                    <div class="container">
                        <div id="main-nav" >
                            <div class="nav-collapse collapse">
                                <div class="span8">
                                   <ul id="menuTexture" class="nav">
                                        <?php foreach ($preferences['menu'] as $values){   ?>
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
                                <div class="span4">                                   
                                    <div class="mn_posSame bg-black">
                                        <div class="support-search_menu">
                                            <input type="text" placeholder="Buscar produto:" class="mg0 search_field_input"/>
                                            <div class="right mgR mgT0"><i class="fa fa-search bF searchbox_button pointer" data-type="interesse"></i></div>
                                        </div> 
                                    </div>                                                                                                                                              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if(isset($preferences['menu_total']) && $preferences['menu_total'] == 'false'){ ?>
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
<?php if(isset($preferences['menu_fonte']) && $preferences['menu_fonte'] != ""){ ?>
<style type="text/css">@font-face { font-family: purple_main; src: url('/media/fonts/<?php echo $preferences['menu_fonte'] ?>'); }</style>
<?php } ?>
<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->