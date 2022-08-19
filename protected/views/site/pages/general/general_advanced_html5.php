<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<!--START MAIN-WRAPPER--> 
<div class="main-wrapper">
    
     <!--TITLE-->
    <?php if($page_prop['gel_fr_initial'] != ''){ ?>
    <div class="row-fluid">   
        <h1 class="center standart-h2title"> 
            <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
        </h1>
        <p class="standart-ptitle bold"><?php echo $text['titulo'] ?></p>
        <hr class="half"/>
    </div>
     <?php } else{ ?>
     <h1 class="hidden"><?php if(defined('Settings::SITE_DESCRIPTION') && Settings::SITE_DESCRIPTION != '') echo Settings::SITE_DESCRIPTION ?></h1>
     <?php } ?>
    <!--END: TITLE-->

    <?php foreach($rows as $values){
        if(isset($values['content']) && isset($values['content']['url'])) $this->renderPartial("/site/modulos/" . $values['content']['url'] . $values['info']['modelo'] . "/" .  $values['info']['cool'], $values['content']);
     } ?>

    <!--[END] MAIN WRAPPER-->
    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
</div>


<div class="mgFooter"></div>
<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>