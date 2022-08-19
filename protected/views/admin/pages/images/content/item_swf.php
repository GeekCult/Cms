<?php $urlFlash = $content["cor"]."&block=".$content["modelo"]."&isAdmin=fancy" .$content["cool"]."&local=".$content["tipo"]."&path_customize=/media/swf/banners/";?>
<div class="container_item_banner" style="<?php echo $content['margin'] ?>">
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            codebase="http://download.adobe.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"
            width="<?php echo $content["largura"] ?>" height="<?php echo $content["altura"] ?>">
            <param name="movie" value="/media/swf/banners/<?php echo $base ?>">
            <param name="quality" value="high">
            <param name="wmode" value="transparent"/>
            <param name="FlashVars" value="<?php echo $urlFlash ?>"/>
            <embed src="/media/swf/banners/<?php echo $base ?>"
               flashvars="<?php echo $urlFlash ?>" quality="high"
               pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" type="application/x-shockwave-flash"
               width="<?php echo $content["largura"] ?>" height="<?php echo $content["altura"] ?>">
            </embed>
    </object>
</div>