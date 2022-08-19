<div class="row-fluid">
    <div class="container">
        <hr class="half"/>
        <div class="mgL mgR">
            <div class="span11">
                <div class="share_facebook relative">
                    <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo Yii::app()->request->getHostInfo().Yii::app()->request->getUrl(); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=21&amp;appId=<?php echo $id_app ?>" class="iframeFace"></iframe>
                </div>
                <div class="share_twitter relative">
                    <a class="twitter-share-button" href="https://twitter.com/share" data-via="twitterdev">Tweet</a>
                    <script type="text/javascript">window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));</script>
                </div>
                
                <div class="share_facebook relative">
                    <!-- Posicione esta tag no cabeçalho ou imediatamente antes da tag de fechamento do corpo. -->
                    <script src="https://apis.google.com/js/platform.js" async defer></script>
                    <!-- Posicione esta tag onde você deseja que o botão compartilhar apareça. -->
                    <div class="g-plus" data-action="share"></div>
                </div>
                <p>&nbsp;</p>
                <?php if($preferences['facebook'] != ''){ ?>
                <div class="mgB">
                    <a href="http://facebook.com/<?php echo $preferences['facebook'] ?>" target="_blank">
                        <img src="/media/images/icons/icon_visit_facebook.jpg" alt="Facebook" title="Visite-nos no Facebook"/>
                    </a> 
                </div>
                <?php } ?>
                <?php if($preferences['google_plus'] != ''){ ?>
                <div>
                    <a href="http://google.com/<?php echo $preferences['google_plus'] ?>" rel="publisher" target="_blank">
                        <img src="/media/images/icons/icon_visit_googleplus.jpg" alt="GooglePlus" title="Visite-nos no Google+"/>
                    </a> 
                </div>
                <?php } ?>
            </div>
        </div>
        
    </div>
</div>