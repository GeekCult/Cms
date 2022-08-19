
/*
 * Produtos
 * 
 * Helper class for list products
 * Author: CarlosGarcia
 * Date: 30/05/2001
 * 
 */  

//Init
$(document).ready(function(){

    if($('#helper').attr('data-js-action') == 'main') initButtonProductMain();
    if($('#helper').attr('data-js-action') == 'details') initListenerDetails();
    
    initAdvertisingListeners();
           

});//Close Document Ready

function initButtonProductMain(){
    
    initBlurFieldsAction();
    
    $(".bt_comment").click(function(){
        var item = this.id;
        var id_item = item.split("_");
        $("#content_comment_message_"+id_item[1]).animate({height: "toggle", opacity: "toggle"});
    });
    
    $(".bt_see_details").click(function(){
        window.location = "/produtos/detalhes/" + $(this).attr('data-id-produto');        
    });
    
    $(".bt_delete_transparent").click(function(){
        var item = this.id;
        var id_item = item.split("_");;
        $("#content_comment_message_"+id_item[1]).animate({height: "hide", opacity: "hide"});             
    });
    
    $(".bt_see_comments").click(function(){
       loadCommentsMultiple(this.id, "produto");             
    });
    
    //Botão sets style block.
    $(".bt_style_blocks").click(function(){
        $(".container_produtos_ecommerce").attr("id", "blocks"); 
        $.post("/loja/setting_order_by",{style: "blocks"});
        $(".divider_ecommerce").hide();
    });
    
    //Botão sets style inline
    $(".bt_style_lines").click(function(){
        $(".container_produtos_ecommerce").attr("id", "inline");
        $.post("/loja/setting_order_by",{style: "inline"}); 
        $(".divider_ecommerce").show();
    });
    
    //Botão search produtos
    $(".bt_search_produto").click(function(){
        triggerSearchProdutos(this);
    });
    
    $("#marca").change(function(){
        $.post("/autos/load_modelos", {
            id: $(this).val()       
        },function(data){
            var jsonObject = eval('(' + data + ')');
            $("#modelo_loader").empty().append(jsonObject['view']); 
        });
    });
}


/*
 * Apply listeners focus and blur.
 * It improves the UX.
 *
 */
function initBlurFieldsAction(){
    
    $('.cnt_name').focus(function(){        
        if($(this).val() == "Nome"){
            $(this).val('');
        }
    });

    $('.cnt_name').blur(function(){
        if($(this).val() == ''){
           $(this).val('Nome');
        }
    });
    
    $('.cnt_message').focus(function(){        
        if($(this).val() == "Opinião"){
            $(this).val('');
        }
    });

    $('.cnt_message').blur(function(){
        if($(this).val() == ''){
           $(this).val('Opinião');
        }
    });
}

/*
 * Sets listeners for Details product only
 * 
 * 
 */
function initListenerDetails(){
    //$('#tabs').tab();
     //Buy the product
    $(".bt_produto_comprar").click(function(){

        $.post("/conta/produtos/compra_realizada", {
            id_produto: this.id,
            action: "compra_realizada"
        },

        function(data){
            //$('#loader').hide();
            $('#loader').empty().append(data);
        });
    });
    
    $('.thumbnail_foto_produto').click(function(){
       updateSlotProdutoPicture('/media/user/images/original/' + $(this).children('img').attr('rel'), "0", 490, 500, "main_picture_detail", "main");
    });
    
    $('.thumbnail_foto_produto_html5').click(function(){
       $('#slot_picture0').attr('src', '/media/user/images/original/' + $(this).attr('rel'));
    });
    
    $('.tab_properties').click(function(){
       if($(this).attr('data-type') == 'descricao'){
           $('#ctnDescricao').toggle();
           $('#ctnVideo').hide();
       }
       
       if($(this).attr('data-type') == 'videos'){
           $('#ctnVideo').toggle();
           $('#ctnDescricao').hide();
       }
       
    });
}

/*
 * 
 * 
 */
function triggerSearchProdutos(item){    
    $("#" + $(item).attr('data-form')).submit();    
}