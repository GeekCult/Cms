<?php if($preferences['facebook_likebox']['exibe']){ ?>
<div id="facebookLikeBox" class="facebookLikeboxNW <?php echo $preferences['combo_share']['color'] . ' ' . $preferences['facebook_likebox']['position'] ?>" style="top:<?php echo $preferences['facebook_likebox']['p_y'] ?>px">
    <div id="bt_facebooklikebox"></div>
    <div class="container_vertical_likebox">
        <div id="fb-root"></div>
        <script>

          window.fbAsyncInit = function() {
            FB.init({
              appId      : '<?php echo $preferences['facebook_id'] ?>', // App ID
              channelUrl : '//www.purplepier.com.br', // Channel File
              status     : true, // check login status
              cookie     : true, // enable cookies to allow the server to access the session
              xfbml      : true  // parse XFBML
            });

            // Additional initialization code here
          };

          // Load the SDK Asynchronously
          (function(d){
             var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement('script'); js.id = id; js.async = true;
             js.src = "//connect.facebook.net/en_US/all.js";
             ref.parentNode.insertBefore(js, ref);
           }(document)); 
        </script>

        <div class="container_plugin_likebox mgb_10">
            <div class="fb-like-box" data-href="http://www.facebook.com/<?php echo $preferences['facebook'] ?>" data-width="300" data-height="350" data-show-faces="true" data-stream="false" data-header="false"></div>
        </div>
    </div>
</div>
<?php } ?>