<?php if(!isset($page['bd_ecommerce'])){ ?>
<div class="ctn_breadcrumb">
    <a href="/home" class="bCItem arialB">Home</a>
    <span class="arrow_divider"></span>
    <?php if(isset($page['second'])){ ?>
    <?php (isset($page['nome_url'])) ? $url_n_bc = $page['nome_url'] : $url_n_bc = $page['nome']; ?>
    <a href="/<?php echo $url_n_bc ?>" class="bCItem lower_case"><?php echo $page['label'] ?></a>
    <?php }else{ ?>
    <span class="bCItem lower_case"><?php echo $page['label'] ?></span>
    <?php } ?>
    <?php if(isset($page['second'])){ ?>
    <span class="arrow_divider"></span>
    <?php if(isset($page['third'])){ ?>
    <a href="/<?php echo $page['second_link'] ?>" class="bCItem lower_case"><?php echo $page['second'] ?></a>
    <?php }else{ ?>
    <span class="bCItem lower_case"><?php echo $page['second'] ?></span>
    <?php } ?>    
    <?php } ?>
    <?php if(isset($page['third'])){ ?>
    <span class="arrow_divider"></span>
    <span class="bCItem lower_case"><?php echo $page['third'] ?></span>
    <?php } ?>
</div>
<?php } ?>

<?php if(isset($page['bd_ecommerce'])){ ?>
<div class="ctn_breadcrumb">
    <a href="/home" class="bCItem arialB">Home</a>
    <div class="arrow_divider"></div>
    <a href="/loja" class="bCItem arialB">loja</a>
    <div class="arrow_divider"></div>
    <?php if(isset($page['second'])){ ?>
        <a href="<?php echo $page['second_link'] ?>" class="bCItem lower_case"><?php echo $page['second'] ?></a>
    <?php } ?>
    
    <?php if(isset($page['third'])){ ?>
        <div class="arrow_divider"></div>
        <a href="<?php echo $page['third_link'] ?>" class="bCItem lower_case"><?php echo $page['third'] ?></a>
    <?php } ?>
            
    <?php if(isset($page['fourth'])){ ?>
        <div class="arrow_divider"></div>
        <a href="<?php echo $page['fourth_link'] ?>" class=" bCItemlower_case"><?php echo $page['fourth'] ?></a>
    <?php } ?>
    
    <?php if(isset($page['final'])){ ?>
    <div class="arrow_divider"></div>
    <span class="bCItem lower_case"><?php echo $page['final'] ?></span>
    <?php } ?>
    
</div>
<?php } ?>
<div class="clear"></div>