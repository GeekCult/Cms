<?php $i = 0; foreach ($menu_principal as $value){ ?>
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