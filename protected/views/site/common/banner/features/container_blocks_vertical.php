<div class="container_advertise">     
<?php if(isset($banners_campanha)){if($banners_campanha && count($banners_campanha)>0){ foreach($banners_campanha as $values){  ?>
    <?php if($values['link'] != "" && Yii::app()->params['tecnologia'] == 0){ ?>
    <a href="#" name="<?php echo $values["link"] ?>" class="bt_link_banner_advertise" id="<?php echo $values['id'] ?>" target="<?php if(isset($values["link_modo"])){if($values["link_modo"] == 1){echo '_self';}else{echo '_blank';}} ?>">
    <?php } ?>
        
    <?php if($values['modelo'] != 'render_partial' && Yii::app()->params['tecnologia'] == 0){ ?>            
    <div class="item_banner_block_advertiser">
        <div class="canvas_stage<?php echo $values['id'] ?>">
            <script type="text/javascript">setTimeout(function(){addBannerHTML('<?php echo json_encode($values["cool2"]) ?>', '<?php echo $values["id"] ?>')}, 1000);</script>
            <script type="text/javascript">setTimeout(function(){setSizeBanner('<?php echo $values["altura"] ?>','<?php echo $values["largura"] ?>','<?php echo $values["id"] ?>')}, 1000);</script>
        </div>
    </div>
    <?php }else{ ?>
            <?php if(Yii::app()->params['tecnologia'] == 0){$cool = $values["cool2"];}else{if(isset($values["cool3"])) $cool = $values["cool3"]; else $cool = array();} ?>
            <?php $this->renderPartial("/site/common/banner/modelos/".$values['tipo']. "/" . $values['cool'], $cool); ?> 
    <?php } ?>
    <?php if($values['link'] != "" && Yii::app()->params['tecnologia'] == 0){ ?>
    </a>
    <?php } ?>
    <div class="clear mgB"></div>   
<?php }}} ?>
  
<?php if(isset($ads)){if(count($ads)>0){ foreach($ads as $values2){ ?>
    <?php if($values2['info']['link'] != ""  && Yii::app()->params['tecnologia'] == 0){ ?>
    <a href="#" name="<?php echo $values2['info']["link"] ?>" class="bt_link_banner_advertise" id="<?php echo $values2['info']['id'] ?>">
    <?php } ?>
        
    <?php if($values2['info']['modelo'] != 'render_partial' && Yii::app()->params['tecnologia'] == 0){ ?>            
    <div class="item_banner_block_advertiser">
        <div class="canvas_stage<?php echo $values2['info']['id'] ?>">
            <script type="text/javascript">setTimeout(function(){addBannerHTML('<?php echo json_encode($values2['info']["cool2"]) ?>', '<?php echo $values2['info']["id"] ?>')}, 1000);</script>
            <script type="text/javascript">setTimeout(function(){setSizeBanner('<?php echo $values2['info']["altura"] ?>','<?php echo $values2['info']["largura"] ?>','<?php echo $values2['info']["id"] ?>')}, 1000);</script>
        </div>
    </div>
    <?php }else{ ?>
            <?php $this->renderPartial("/site/common/banner/modelos/".$values2['info']['tipo']. "/" . $values2['info']['cool'], $values2['info']["cool2"]); ?> 
    <?php } ?>
        
    <?php if($values2['info']['link'] != ""  && Yii::app()->params['tecnologia'] == 0){ ?>
    </a>
    <?php } ?>
    <div class="clear mgB"></div>   
<?php }}} ?>
</div>
<div class="clear"></div>