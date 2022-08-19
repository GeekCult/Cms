<?php include Yii::app()->getBasePath() . '/views/site/common/header/site/' . $preferences['topo_tipo'] . '.php'; ?>

<!-- ################-->
<!-- END TOP MENU -->
<!-- ################-->

<!-- PAGE HEADER -->
<div class="container pan">
    <div class="mgL mgR">
        <?php if($text['breadcrumb_exibe']){ ?>
        <div class="row-fluid">        
            <ul class="breadcrumb">
            <?php include Yii::app()->getBasePath() . '/views/site/common/header/site/breadcrumb.php'; ?>
            </ul>
        </div>
        <?php } ?>
        
        <?php if($page_prop['gel_fr_initial'] != ""){ ?>
        <!--TITLE-->
        <div class="row-fluid">   
            <h2 class="center standart-h2title"> 
                <span class="large-text"><?php echo $page_prop['gel_fr_initial'] ?></span>
            </h2>
            <div class="divider_horizontal mgB2"></div>
        </div>
        <?php } ?>
        <!--END: TITLE-->
    </div>
    
    <?php if($rows && count($rows) > 0){foreach($rows as $values){
        if(isset($values['content']) && isset($values['content']['url'])) $this->renderPartial("/site/modulos/" . $values['content']['url'] . $values['info']['modelo'] . "/" .  $values['info']['cool'], $values['content']);
     }} ?>
    
    <!-- CONTENT CONTAINER -->

    <div class="row-fluid">
        <div class="mgL mgR">
            <?php if((isset($contatos['ctt_address']) && ($contatos['ctt_address'] != '' && $contatos['ctt_cidade'] != '')) || Settings::CTT_ENDERECO != ''){ ?>
            <div class="span12">
                <div class="color-bottom-line center">
                    <h2 class="line center"><span><i class="fa-icon-map-marker main-color"></i> Nossa localização</span></h2>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="span12 center">
                        <!-- MAP DIV // !Don't remove this !Important -->
                        <div id="map" style="height: 450px"></div>
                        <!-- MAP DIV // !Don't remove this !Important -->
                    </div>
                    <hr class="half">                
                </div>
            </div>
            <?php } ?>
            <!-- MAP DIV // !Don't remove this !Important -->
            
        </div>
    </div>

    <div class="mgFooter"></div>
</div>
<input type="hidden" id="helper_action" data-js-action="contato"/>
<input type="hidden" value="site" id="helper_local_logout" data-address="<?php if(isset($contatos['ctt_address'])){echo $contatos['ctt_address'] . ' - ' . $contatos['ctt_cidade']; } if(Settings::CTT_ENDERECO != ''){echo Settings::CTT_ENDERECO . ' - ' . Settings::CTT_CIDADE; }  ?>"/>
<?php include Yii::app()->getBasePath() . '/views/site/common/footer/site/' . $preferences['rodape_tipo'] . '.php'; ?>

<!-- gMap PLUGIN -->
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="/js/lib/jquery.gmap.js"></script>
<script type="text/javascript">
		
				jQuery(document).ready(function(){

				jQuery('#map').gMap({ address: $('#helper_local_logout').attr('data-address'),
							   panControl: true,
						   zoomControl: true,
							   zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL
							   },
						   mapTypeControl: true,
						   scaleControl: true,
						   streetViewControl: false,
						   overviewMapControl: true,
							   scrollwheel: true,
							   icon: {
						image: "http://www.google.com/mapfiles/marker.png",
						shadow: "http://www.google.com/mapfiles/shadow50.png",
						iconsize: [20, 34],
						shadowsize: [37, 34],
						iconanchor: [9, 34],
						shadowanchor: [19, 34]
					},
						zoom:14,
							   markers: [
							{ 'address' : $('#helper_local_logout').attr('data-address')}
						]
							   
							   
							   }); 
				});



</script>



