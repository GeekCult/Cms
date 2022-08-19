<div class="container_pan">
    <div class="titleContent">
        <div class="support-logo"><h1><?php echo  Yii::t("adminForm", "images_page_title_create") ?></h1></div>
       
        <div class="bug_tracker iframe"></div>
    </div>
    <div class="clear"></div> 
    <a href="/admin/pierplayground/listar">
        <input type="button" class="bt_right" id="bt_clear" value="<?php echo  Yii::t("adminForm", "button_common_list") ?>"/>        
    </a> 
    <div class="textLayout"></div>
    <p>&nbsp;</p>
    <div class="iframe_playground">                 
       <div id="preloader">
            <div class="bg_result_preloader">
                <div class="text_result_preloader"><?php echo Yii::t("messageStrings", "message_loading");?></div>
                <div class="bg_result_preloader_bar" id="preloader_loaderbar"></div>
            </div>
        </div>       
    <iframe width="1060" src="https://www.purplepier.com.br/playground/admin/<?php echo Yii::app()->params['id_user'] ?>" frameborder="0" scrolling="no" id="playgroundIframe" style="height: 820px"></iframe>
    </div>
    <div class="clear"></div>
    <div style="width: 980px; left: 50%; position: relative; margin: 50px 0 20px -490px;">
        <h2>Galeria de artes</h2>
        <p>&nbsp;</p>
        <?php if(count($arts) == 0){ ?><p>Você ainda não tem nenhuma arte!</p><?php } ?>
        <div id="user_arts_admin">
            
        </div>        
    </div>
    <div class="clear"></div>
    <?php  include Yii::app()->getBasePath() . "/views/admin/common/help/helpbox.php"; ?> 
    <div class="clear"></div>
    <p>&nbsp;</p><p>&nbsp;</p>
    
    <input id="file" type="hidden" value="novo"/>
    <input type="hidden" value="260" id="helper_id_user"/>

</div>
<script type="text/javascript">
    initImages2();
    
    <?php if($_SERVER['SERVER_NAME'] != "dev.purplepier.com.br"){ ?> showAlertDimPreloader(false, 'PierPlayground');<?php } ?>
    <?php if($_SERVER['SERVER_NAME'] == "dev.purplepier.com.br"){ ?> $("#playgroundIframe").show();hideAlertDimPreloader(false); id_interval = null; removeAlertDimPreloader(true); <?php } ?>
    
    //PAY ATTENTION: Só funciona ONLINE not local
    
    /* Cross damin Iframe */
    window.addEventListener('message', function(event) {
   
      if(event.origin === 'https://www.purplepier.com.br'){

        //$("#playgroundIframe").show(); removeAlertDimPreloader();
        if(event.data.iframe){
            $('#playgroundIframe').height(event.data.iframe);
        }
        
        if(event.data.iframe_width){
            
            if(event.data.iframe_width >= 960){
                $('#playgroundIframe').width("1230px");
                $(".iframe_playground").css("width", "1230px").css("margin-left", "-615px");
            } 
            if(event.data.iframe_width < 960){
                $('#playgroundIframe').width("1060px");
                $(".iframe_playground").css("width", "1060px").css("margin-left", "-560px");
            } 
            
            
        }
 
        if(event.data.id){
            showAlertDimPreloader(true, 'Finalizando processo');
            $.post("/site/purplecanvas/save_data", {
                data: event.data.dataUrl,
                id_banner: event.data.id,
                action: event.data.action_current,
                image: event.data.image,
                is_user: true
            },function(data){        
                var jsonObject = eval('(' + data + ')');
                hideAlertDimPreloader(false);
                removeAlertDimPreloader(true);
                
                $("#user_arts_admin").append("<div class='img_user_admin' id='slPl_"+ event.data.id +"'><img src='/media/user/images/thumbs_120/"+ jsonObject['file'] + "'/></div>");
                
                $("#helper_image").val(jsonObject['file']);
                $("#helper_id_html_action").val("editar");
                
            }); 
        }
        
        if(event.data.iframe_loaded){
        
            $("#playgroundIframe").show(); 
            hideAlertDimPreloader(false);
            removeAlertDimPreloader(true);
        }
      }

    }, false);
    
    /**
     * This method retrieve the images's size
     *
     */
     function addUserArt(file, id_banner, tipo){ 

        var item = "";
        item += "<div class='img_user_admin' id='slPl_"+ id_banner +"'>";    
        item += "<a href='"+ window.location.protocol+ "//" + window.location.host+ "/media/user/images/original/"+file+"' class='thickbox' title=' ' id='aPl_"+ id_banner +"'>";
        item += "<img src='"+ window.location.protocol+ "//" + window.location.host+ "/media/user/images/thumbs_120/"+file+"' id='imgPl_"+ id_banner +"' rel='image_src' alt='/media/user/images/original/"+file+"'/>";
        item += "</a>";
        item += "<div class='img_opt' id='omP_"+ id_banner +"'>";
        item += "<div class='bt_facebook' id='fbPl_"+id_banner+"' rel='"+file+"' title='Compartilhar no Facebook'></div>";
        item += "<div class='bt_twitter' title='Compartilhar no Twitter'></div>";
        item += "<div class='bt_email_super' id='emPl_"+id_banner+"' title='Enviar por e-mail'></div>";
        item += "<div class='bt_edit_black' id='edPl_"+id_banner+"' title='Editar'></div>";
        item += "<div class='bt_delete_super' id='erPl_"+id_banner+"' title='Excluir'></div>";
        item += "</div>";
        item += "</div>";

        if(tipo == "prepend"){
            $("#user_arts_admin").prepend(item);
        }else if(tipo == "reload"){
            setTimeout(function(){
                $("#aPl_" + id_banner ).empty().append("<img src='/media/user/images/thumbs_120/"+file+"?link="+ Math.floor((Math.random()*100)+1) +"' id='imgPl_"+ id_banner +"'/>");
            }, 5000);
        }else{
            $("#user_arts_admin").prepend(item);
        }
    }
    
    //Shows options images
    $("#user_arts_admin .img_user_admin").live('mouseenter', function(){
        var idP = this.id.split("slPl_");
        $("#omP_" + idP[1]).animate({"top": "70px"});
    }).live('mouseleave', function(){
        var idP = this.id.split("slPl_");
        $("#omP_" + idP[1]).animate({"top": "120px"});          
    });

    <?php foreach($arts as $values){ ?> addUserArt('<?php echo $values['image'] ?>', '<?php echo $values['id'] ?>', "simple"); <?php } ?>

</script>
<?php $this->widget('application.widgets.alertDim.AlertDimWidget'); ?>