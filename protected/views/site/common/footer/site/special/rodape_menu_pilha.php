<div id="">
    <div class="ftMenu">
        <div class="footerPan container">
            <div class="mn3_line_html_component"> 
                <div id="mn3_line" class="mn3_line ftMn1">
                    <div class="container_mn2_line center">
                        <?php foreach ($preferences['menu3'] as $valuesr) {?>
                            <a class="link_mn2_line" href="<?php if($valuesr['link_special'] == ''){echo $valuesr['nome'];}else{echo $valuesr['link_special'];} ?>"><?php echo $valuesr['label'] ?></a>
                            <?php if($valuesr != end($preferences['menu3'])){?>
                                <span class="link_mn2_line">|</span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
    
            <div class="divider_shadow"></div>            
            
            <div class="clear height_support"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="ftLine2">
        <div class="footerPan container">
            <div class="legenda_right sF_resp_mini">Todos os direitos reservados ©<?php echo date('Y')?></div>
            <div class="legend_left">
                <div id="mn3_line-branco" class="mn3_line">
                    <div class="container_mn2_line">                
                        <a class="link_mn2_line sF_resp_mini" href="/contato">Entre em contato</a>
                    </div>
                </div>                
            </div> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="ftLineCompany">
        <div class="footerPan container">
            <div class="ft_copyright_line"><?php //echo nl2br($preferences['rodape_copyright']) ?></div> 
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="footer_extra base_black">
    <a href="http://www.purplepier.com.br" target="_blank">
        <div class="logoDev_white right mgT0 mgR"></div>
    </a>
</div>
<?php include Yii::app()->getBasePath() . "/views/site/common/footer/extras/main.php"; ?>