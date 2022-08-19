<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>
<?php Yii::import('application.extensions.utils.StringUtils'); ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container">
    <!--TITLE-->
    <?php if($page_prop['gel_fr_initial'] != ""){ ?>
    <div class="row-fluid">
        <div class="mgR mgL">
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>

            <hr class="half"/>
        </div>
    </div>
    <?php } ?>
    
    <div class="row-fluid">
        <div class="mgR mgL">
            <div class="container_pan_buscar">
                <h2>Busca</h2>
                <div class="divider_horizontal"></div>
                
                <div class="busca_subtitle left">Veja os resultados da sua busca por:&nbsp;</div>
                <div class="palavra_chave"><strong><?php echo $search ?></strong></div>
                <div class="clear"></div>
                <p>&nbsp;</p>
                <p>Resultados encontrados: <?php echo $count ?></p>
                <?php if(count($busca_paginas) > 0 || count($busca_materias) > 0){?><p>&nbsp;</p> <h4>Informações no nosso site</h4><?php } ?>
                <?php foreach ($busca_paginas as $values) {$stub = StringUtils::StringToUrl($values['titulo']); ?>
                <p>&nbsp;</p>
                <div class="busca_content_item">
                    <div class="busca_content_container_desc">
                        <div class="busca_title">
                            <a href="/<?php echo $values['nome'] ?>"><h3><?php echo $values['titulo'] ?></h3></a>
                        </div>
                        <div class="busca_descricao_item">
                            <p class="lead"><?php echo nl2br($values['texto_01']) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php foreach ($busca_materias as $values) {$stub = StringUtils::StringToUrl($values['titulo']); ?>
                <p>&nbsp;</p>
                <div class="busca_content_item">
                    <div class="busca_content_container_desc">
                        <div class="busca_title">
                            <a href="/<?php echo $values['tipo'] ?>/listar/<?php echo $values['id'] ?>"><h4><?php echo $values['titulo'] ?></h4></a>
                        </div>
                        <div class="busca_descricao_item">
                            <p class="lead"><?php echo nl2br($values['subtitulo']) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php foreach ($produtos as $values) {$stub = StringUtils::StringToUrl($values['nome']); ?>
                <p>&nbsp;</p>
                <div class="busca_content_item">
                    <div class="busca_content_container_desc">
                        <div class="busca_title">
                            <?php if(Yii::app()->params['ramo'] == "educacao" || Yii::app()->params['ramo'] == "ecommerce") { ?>
                            <a href="/loja/detalhes/<?php echo $values['id'] ?>"><h4><?php echo $values['nome'] ?></h4></a>
                            <?php }else{ ?>
                            <a href="/produtos/<?php echo $values['url'] ?>"><h4><?php echo $values['nome'] ?></h4></a>
                            <?php } ?>
                        </div>
                        <div class="busca_descricao_item">
                            <p class="lead"><?php echo nl2br($values['descricao']) ?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>


                <div class="clear"></div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div class="divider_horizontal"></div>
                <div class="right">
                    <a href="<?php echo Yii::app()->homeUrl; ?>">
                        <input type="button" class="botao_trans_back" alt="voltar" value="voltar" title="Voltar"/> 
                    </a>
                </div>
                <div class="clear"></div>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    
    
</div>

<!-- ################ -->
<!--END: CONTENT CONTAINER-->
<!-- ################ -->

<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>