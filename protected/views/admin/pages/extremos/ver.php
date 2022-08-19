<script type="text/javascript" src="/js/admin/banners.js"></script>
<div class="container_pan">
    <div class="titleContent">
        <div class="titlePageAdmin">
            <h1>Ver banner</h1>
        </div>
        <div class="bug_tracker iframe"></div>
    </div>
    <input id="helper_mini_site" data-url="<?php if(isset($minisite_url))echo $minisite_url ?>" type="hidden" value=""/>
    <a href="/admin/<?php echo $local ?>/novo">
        <input type="button" class="bt_right" value="<?php echo Yii::t("adminForm", "button_common_new") ?>"/>
    </a>
    <div class="clear"></div>
    <div class="container_devices_options left">
        <div class="picture_container_page"></div>
        <div class="title_devices">Você está editando <span class="title_device_name"><?php echo $session['device']?></span></div>
        <div class="title_empty_texture">
            <input type="button" id="bt_device_desktop" class="icon_desktop_square" title="Escolher Desktop" alt="desktop"/>
            <input type="button" id="bt_device_tablet" class="icon_tablet_square" title="Escolher Tablet" alt="tablet"/>
            <input type="button" id="bt_device_mobile" class="icon_mobile_square" title="Escolher Mobile" alt="mobile"/>
        </div>
    </div>
    
    <div class="clear mgB"></div>
    
    <div class="contentLayouts">

        <?php if($content) { ?> 
            <div class="ctnFullBanner" style="<?php if($content['image'] != ''){if($content['image_type'] == 0){echo "background: url(/media/user/images/original/". $content['image'] .") center center";}else{echo "background: url(/media/images/textures/site/". $content['image'] .") center center";}} ?>">
            <div class="ctnBannerRender transparent Pos_<?php echo $content["tipo"] ?>">     
                

                    <?php if($content["modelo"] != 'render_partial'){ ?>
                    <div class="canvas_stage<?php echo $content["id"] ?>" id="stage"></div>
                    <script type="text/javascript">addBannerHTML('<?php echo json_encode($content["cool2"]) ?>', '<?php echo $content["id"] ?>')</script>
                    <script type="text/javascript">setSizeBanner('<?php echo $content["altura"] ?>', '<?php echo $content["largura"] ?>', '<?php echo $content['id'] ?>');</script>
                    <?php }else{ ?>
                    <?php $this->renderPartial("/site/common/".$type_size. $content["cool"], $content["cool2"]); ?> 
                    <?php } ?>
                   
               
            </div>
            </div>
        <?php }else{ ?>
        <div class="result-message">
            <span><?php echo Yii::t("messageStrings", "message_no_records_found") ?></span>
        </div>
        <?php } ?>
    </div>
     
</div>
<div class="clear"></div>
<?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?>
<div class="clear"></div>
<p>&nbsp;</p>
<div class="buttons_right">
    <input type="button" class="bt_right"  id="bt_top" value="<?php echo Yii::t("adminForm", "button_common_top") ?>"/>
</div>
<div class="clear height_support"></div>
<input id="helper_id_html_action" value="listar" type="hidden"/>
<input id="helper_local" value="<?php echo $local ?>" type="hidden"/>

<script type="text/javascript">initListenerListar();</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>