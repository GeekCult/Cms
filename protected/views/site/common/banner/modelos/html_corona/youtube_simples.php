<div class='row-fluid'>
    <?php if(isset($link2['src']) && $link2['src'] != ''){ ?>
    <div class="row-fluid"> 
        <div class='video-container'>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $link2['src'] ?>" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <?php } ?>
    <?php if(isset($link1['src']) &&  $link1['src'] != ''){ ?>
    <div class="row-fluid mgT"> 
        <div class="left">
            <script src="https://apis.google.com/js/platform.js"></script>
            <div class="g-ytsubscribe" data-channelid="<?php echo $link1['src'] ?>" data-layout="default" data-count="default"></div> 
        </div>
        <div class="left mgL">
            <span>Assine nosso canal</span>
        </div>
        <div class="clear"></div>         
    </div>
    <?php } ?>
</div>

