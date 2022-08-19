<?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/" . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->


<!-- ################ -->
<!-- CONTENT CONTAINER-->
<!-- ################ -->
<div class="container pan" data-template="vertical_banner_likebox_html5">
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/' . $plataform. "/breadcrumb.php"; ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if($page_prop['gel_fr_initial'] != ""){ ?>
        <!--TITLE-->
        <div class="row-fluid">   
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>
            <hr class="half"/>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>

    <!-- ################ -->
    <!-- CONTAINER  FEATURE -->
    <!-- ################ -->
    <?php if ($text['titulo_01'] != '' || $text['texto_01'] != '') { ?>
    <div class="mgL mgR">
        <div class="row-fluid">
        
            <!-- FEATURE -->
            <div class="span3">
                <div class="row-fluid">                    
                    <div id="fb-root"></div>
                        <script>
                          window.fbAsyncInit = function() {
                            FB.init({
                              appId      : '<?php //echo $preferences['facebook_id'] ?>', // App ID
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

                    <div class="container_plugin_likebox fb_center mgb_10">
                        <div class="fb-like-box" data-href="http://www.facebook.com/<?php //echo $preferences['facebook'] ?>" data-width="260" data-height="320" data-show-faces="true" data-stream="false" data-header="false"></div>
                    </div>                    
                </div>
                
                <?php if($preferences['twitter'] != ''){ ?>
                <div class="row-fluid mgT2">
                    <div class="fb_center">
                        <a class="twitter-timeline"  href="https://twitter.com/<?php echo $preferences['twitter'] ?>"  data-widget-id="465926874476978176" data-theme="light" data-link-color="#cc0000"  data-related="twitterapi,twitter" data-aria-polite="assertive" width="260" height="320" >Tweets de @Purplepier</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
                <?php } ?>
                
                
                <?php if ($graphics['container_1'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_1']['foto'] ?>"/>
                    </div>
                <?php  }} ?>
                
                <?php if ($graphics['container_2'] ) { if($graphics['container_2']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_2']['foto'] ?>"/>
                    </div>
                <?php  }} ?>
                
                <?php if ($graphics['container_3'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_3']['foto'] ?>"/>
                    </div>
                <?php  }} ?>
                
                <?php if ($graphics['container_4'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_4']['foto'] ?>"/>
                    </div>
                <?php  }} ?>
                
                <?php if ($graphics['container_5'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_5']['foto'] ?>"/>
                    </div>
                <?php  }} ?>
                
                <?php if ($graphics['container_6'] ) { if($graphics['container_1']['slot_type'] == "f"){ ?>                       
                    <div class='center mgT2 pp_square'>
                        <img src="/media/user/images/original/<?php echo $graphics['container_6']['foto'] ?>"/>
                    </div>
                <?php  }} ?>

            </div>
            <!--END:  FEATURE -->
            <!--IMAGE -->
            <div class="span9">
                <div class="row-fluid">
                    
                        <h2 class="titulo tit_size"><?php echo $text['titulo_01'] ?></h2>
                        <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_01'] ?></h4>
                        
                        <p class="lead"><?php echo nl2br($text['texto_01']) ?></p>
                    
                        <?php if($text['titulo_01'] != '' || $text['texto_01'] != ''){ ?>
                        <!-- END IMAGE -->                    
                        <hr class="half">                    
                        <?php } ?>
                </div>  
                
                <div class="row-fluid">
                    
                        <h2><?php echo $text['titulo_02'] ?></h2>
                        <h4><?php echo $text['subtitulo_02'] ?></h4>
                        
                        <p class="lead"><?php echo nl2br($text['texto_02']) ?></p>
                    
                    <?php if($text['titulo_02'] != '' || $text['texto_02'] != ''){ ?>
                    <!-- END IMAGE -->
                    
                        <hr class="half"/>
                   
                    <?php } ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">                        
                        <h2 class="titulo tit_size"><?php echo $text['titulo_03'] ?></h2>
                        <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_03'] ?></h4>
                        
                        <p class="lead"><?php echo nl2br($text['texto_03']) ?></p>
                    </div>
                    <?php if($text['titulo_03'] != '' || $text['texto_03'] != ''){ ?>
                    <!-- END IMAGE -->
                    <div class="span12">
                        <hr class="half"/>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">                        
                        <h2 class="titulo tit_size"><?php echo $text['titulo_04'] ?></h2>
                        <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_04'] ?></h4>
                        <hr class="half"/>
                        <p class="lead"><?php echo nl2br($text['texto_04']) ?></p>
                    </div>
                    <?php if($text['titulo_04'] != '' || $text['texto_04'] != ''){ ?>
                    <!-- END IMAGE -->
                    <div class="span12">
                        <hr class="half"/>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">                        
                        <h2 class="titulo tit_size"><?php echo $text['titulo_05'] ?></h2>
                        <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_05'] ?></h4>
                        
                        <p class="lead"><?php echo nl2br($text['texto_05']) ?></p>
                    </div>
                    <?php if($text['titulo_05'] != '' || $text['texto_05'] != ''){ ?>
                    <!-- END IMAGE -->
                    <div class="span12">
                        <hr class="half"/>
                    </div>
                    <?php } ?>
                </div>
                
                <div class="row-fluid">
                    <div class="span12">                        
                        <h2 class="titulo tit_size"><?php echo $text['titulo_06'] ?></h2>
                        <h4 class="subtitulo subt_size"><?php echo $text['subtitulo_06'] ?></h4>
                        
                        <p class="lead"><?php echo nl2br($text['texto_06']) ?></p>
                    </div>
                    <?php if($text['titulo_06'] != '' || $text['texto_06'] != ''){ ?>
                    <!-- END IMAGE -->
                    <div class="span12">
                        <hr class="half"/>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
            
        </div>
    </div>
    <?php } ?>
    <!-- ################ -->
    <!-- END: CONTAINER  FEATURE -->
    <!-- ################ -->
    
    
    <?php if($text['network_exibe']){ include Yii::app()->getBasePath() . '/views/site/common/share/redes_sociais.php'; } ?>
    
    <div class="mgFooter"></div>
    
</div>
<!-- ################ -->
<!--END: CONTENT CONTAINER-->
<!-- ################ -->

<input type="hidden" value="site" id="helper_local_logout"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/' . $plataform . "/" . $preferences['rodape_tipo'] . '.php'; ?>



