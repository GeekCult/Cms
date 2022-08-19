/*
    Document   : main admin
    Created on : 15/12/2010, 09:31:00
    Author     : CarlosGarcia
    Description:
    Purpose of the javascript follows.
*/
var tt_fancy = 0;
$(document).ready(function(){
    

    initAdminListeners();
    openBugTracker();

    getDimensions();
    footerPosition();

    //$(window).bind("resize", getDimensions);
});

function applyImageTexture(nome_id, url_img){
    $('#imgTT_' + nome_id).css("background-image",'url(/media/images/textures/' + url_img + ')');
}

function getDimensions(){
    windowH = $(window).height();
    windowW = $(window).width();
}

function footerPosition(){
    if($("#pan").height() < windowH - 130){
        $(".footerPanAdmin").css("position", "absolute");
    }else{
        $(".footerPanAdmin").css("position", "relative");
    }
    $("#pan").css("min-height", (windowH - 130 )+"px");
}

//Flash  notice
function initAdminListeners(){
    
    //PurpleStore
    $(".fancybox-purplestore").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': true, 'width': 890,'height': 460,'overlayShow': true, 'titleShow' : false,'type' : 'iframe'
    });
    
    //Wiki
    $(".fancybox-wiki").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': false, 'width': 980,'height': 540,'overlayShow': true, 'titleShow' : true,'type' : 'iframe'
    });
    
    $('.flash_notice_button_close').click(function(){
         $('.flash_notice').fadeOut("slow");
    });
    
    $('.bt_refresh').click(function(){
         $.post("/admin/configurar/clear_cache",{},function(data){showAlertDim(data);});
    });
    
    $('#bt_top, .bt_to_top').click(function(){window.scrollTo(0, 0);});    
    
    $('#bt_device_desktop, #bt_device_tablet, #bt_device_mobile').click(function(){
        var pagetype = $("#admin_local").val();
        var device = this.alt;
        $.post("/admin/configurar/device",{
            type_device: device,
            type_content: pagetype
        },function(data){
            var jsonObject = eval('(' + data + ')');
            switch(pagetype){
                case "paginas":
                    window.location = "/admin/paginas/listar";
                    break;
                default:
                    showAlertDim(jsonObject['message']);
                    $(".title_device_name").text(device);
                    break;
            }
            
        });
    });
    
    //List listene 
    $(".filter_date").change(function(){
        
        var value = $(this).val();
        var type = $(this).attr('rel');
        var page = $('#helper_page_name').val();
        
        $.post("/site/relatar/set_session_data",{
            id_user: 0,
            label: type + '_' + page,
            value: value
            
        },function(data){
            window.location.reload();
        });
    });
    
    $("a[href$='.jpg'],a[href$='.png'],a[href$='.gif']").fancybox({
        'transitionIn'  :'elastic', 'transitionOut':'elastic','centerOnScroll': true, 'autoScale': true, 'speedIn': 300,'speedOut': 200, 'autoDimensions': false, 'overlayShow': true, 'titleShow' : false,'type' : 'image',
        'onStart':function(){
            $.fancybox.removeBackground();
	}
    });
    
    //Paginacao
    $(".item_paginador").live('click', function(){
       if(this.id != 'proximo' && this.id != 'anterior') window.location = this.id; 
    });
    
    //Tooltips
    $(".tip_trigger").hover(function(){
        tip = $(this).find('.tip');
        tip.show(); //Show tooltip
    }, function() {
        tip.hide(); //Hide tooltip
    }).mousemove(function(e) { /* Nothing*/ });
    
    initCanalComunicacaoListeners();
    
}

/*
 * Bug fix produtos controller
 * Só é chamada de for dentro da area restrita Admin.
 * Se não houver este fix o rodape fica com a posiçao zuada!
 * 
 */
function updatePanMain(){ 
    
    var screenW = 640, screenH = 480;
    if(parseInt(navigator.appVersion)>3){
        screenW = screen.width;
        screenH = screen.height;
    }else if (navigator.appName == "Netscape" && parseInt(navigator.appVersion)==3 && navigator.javaEnabled()){
        var jToolkit = java.awt.Toolkit.getDefaultToolkit();
        var jScreenSize = jToolkit.getScreenSize();
        screenW = jScreenSize.width;
        screenH = jScreenSize.height;
    }
    
    var newHeight = screenH - 395;
   
    if(screenH < newHeight) $(".container_pan").css("height", newHeight + "px");    
}

/*
 * Bug tracker launcher
 * It launches a bugtracker prepared to submit
 * all bugs 
 * 
 */
function openBugTracker(){
   //Bugs
   $('.bug_tracker').unbind('click');
   $('.bug_tracker').fancybox({
        'transitionIn'          :'elastic',
        'transitionOut'         :'elastic',
        'speedIn'	        : 300,
        'speedOut'	        : 200,
        'autoDimensions'	: false,
        'width'         	: 720,
        'height'        	: 450,
        'overlayShow'           : false,
        'href'                  : '/admin/documentacao/bugs/adicionar',
        'type'                  : 'iframe'
    });
    //Não tirar, variavél dentro de fancybox/fancybox...js
    tt_fancy = 1;
}

/*
 * Dispatch routine to check if there are some live chat dialog
 * 
 */
function initLiveChatVerification(){

    $.post("/admin/livechat/check_dialog",{
        
    },function(data){
        if(data) {
            $('.livechat_bagde').css('background', 'url(/media/images/layout/livechat/profile_admin_enabled.png)').css('cursor', 'pointer');
            $('.livechat_bagde').bind('click', function(){window.location = '/admin/livechat/atender'});
            if($('#helper_livechat_location').val() == 1 && !$('.ctnTextLiveChatAnswer').is(':visible')) window.location.reload();
        }else{
            $('.livechat_bagde').css('background', 'url(/media/images/layout/livechat/profile_admin_disabled.png)').css('cursor', 'default');
            $('.livechat_bagde').unbind('click');
        }
        
        
        
        setTimeout('initLiveChatVerification()', 20000);
    });
}

/*
 * Fake
 */
function verifyShoppingCartItems(){}

/*
 * Fake
 */
function initCanalComunicacaoListeners(){
    //Tab
    $(".ft_tab, .bt_bubbles").live('click', function(){
       $('.ctn_tab, .ft_tab_close').fadeIn('300'); 
       $(".ft_tab").hide();
       //$.post("/admin/canal_comunicacao/load_messages",{tipo: 2},function(data){});
        
    });
    
    $(".ft_tab_close").live('click', function(){
       $('.ctn_tab, .ft_tab_close').fadeOut('300'); 
       $(".ft_tab").show();
    });
    
    $("#bt_tab_mensagem").live('click', function(){
       $("#bt_tab_novidade, #bt_tab_atualizacao, #bt_tab_termos, #bt_tab_chamados").removeClass('active');
       $('#tbTipo_2, #tbTipo_3, #tbTipo_6, #tbTipo_4').hide(); 
       $("#tbTipo_1").fadeIn('300');
       $("#bt_tab_mensagem").addClass('active');
    });
    
    $("#bt_tab_novidade").live('click', function(){
       $("#bt_tab_mensagem, #bt_tab_atualizacao, #bt_tab_termos, #bt_tab_chamados").removeClass('active');
       $('#tbTipo_1, #tbTipo_3, #tbTipo_6, #tbTipo_4').hide(); 
       $("#tbTipo_2").fadeIn('300');
       $("#bt_tab_novidade").addClass('active');
    });
    
    $("#bt_tab_atualizacao").live('click', function(){
       $("#bt_tab_mensagem, #bt_tab_novidade, #bt_tab_termos, #bt_tab_chamados").removeClass('active');
       $('#tbTipo_1, #tbTipo_2, #tbTipo_6, #tbTipo_4').hide(); 
       $("#tbTipo_3").fadeIn('300');
       $("#bt_tab_atualizacao").addClass('active');
    });
    
    $("#bt_tab_chamados").live('click', function(){
       $("#bt_tab_mensagem, #bt_tab_novidade, #bt_tab_termos, #bt_tab_atualizacao").removeClass('active');
       $('#tbTipo_1, #tbTipo_2, #tbTipo_3, #tbTipo_4').hide(); 
       $("#tbTipo_6").fadeIn('300');
       $("#bt_tab_chamados").addClass('active');
    });
    
    $("#bt_tab_terms").live('click', function(){
       $("#bt_tab_mensagem, #bt_tab_novidade, #bt_tab_termos, #bt_tab_atualizacao").removeClass('active');
       $('#tbTipo_1, #tbTipo_2, #tbTipo_3, #tbTipo_6').hide(); 
       $("#tbTipo_4").fadeIn('300');
       $("#bt_tab_termos").addClass('active');
    });
    
    $("body").on('click', '.bt_close_canal', function(){
        
        var tipo = $(this).attr('data-type');
        
        $.post("/admin/canal_comunicacao/load_message",{
            tipo: tipo,
            id: $(this).attr('data-id')
        },function(data){
            var jsonObject = eval('(' + data + ')');
            if(jsonObject['total']['qtd'] > 0) $("#cnC_" + tipo).text(jsonObject['total']['qtd']);
            if(jsonObject['total']['qtd'] <= 0) $("#bubC_" + tipo).hide();
            
            //Total
            if(jsonObject['total']['qtd_total'] > 0) $("#bbMain p").text(jsonObject['total']['qtd_total']);
            if(jsonObject['total']['qtd_total'] <= 0) $("#bbMain").hide();
            
            if(jsonObject['view']){                
               $("#tbCTipo_" + tipo).empty().append(jsonObject['view']);             
                
            }else{
                $("#tbTipo_" + tipo).empty().append('<div class="title_canal_message">Não há mais itens a serem exibidos desta categoria</div>');
            }
        });
        
    });
    
    $("#bt_pier_chamados").live('click', function(){submitFormPierChamados();});
    
    //Check manager for new messages
    //setTimeout(function(){$.post("/admin/canal_comunicacao/check_messages",{},function(data){});}, 3600); //36000
}

/*
 * It sends the values from the textfield
 *
 */
function submitFormPierChamados(){
    
    var title = $("#titulo_servico").val();
    var desc = $("#descricao_servico").val();
    
    if(title == '' || desc == ''){
        $("#message_error_canal_footer").empty().append("<div class='bg-danger mgB'>Todos os campos devem ser preenchidos</div>");
    }else{
        //Put a preloader on stage
        showAlertDimPreloader(true, 'Salvando...');
        $.post("/admin/publicidade/salvar",{            
            titulo: $('#titulo_servico').val(),
            descricao: $('#descricao_servico').val(),
            tipo: 'tarefa', action: 'novo', id: 0, quantidade: 1, valor: 0

        },function(data){        
            var jsonObject = eval('(' + data + ')');
            showAlertDim(jsonObject['message']);
            $('#titulo_servico').val(''); $('#descricao_servico').val('');
            //if(type == "cadastrar") clearForm();
        });
    }
    
}
    